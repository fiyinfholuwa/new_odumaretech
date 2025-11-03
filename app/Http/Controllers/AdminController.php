<?php

namespace App\Http\Controllers;

use App\Mail\ApplicantNotification;
use App\Mail\CorporateMail;
use App\Mail\InstructorApply;
use App\Mail\RegisterationEmail;
use App\Models\AdminRole;
use App\Models\AppliedCourse;
use App\Models\ApprovedInstructor;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\CompanyTraining;
use App\Models\Contact;
use App\Models\ContentCreator;
use App\Models\CookieConsent;
use App\Models\Course;
use App\Models\DollarRate;
use App\Models\Innovation;
use App\Models\Instructor;
use App\Models\InstructorChat;
use App\Models\InstructorTC;
use App\Models\MasterClass;
use App\Models\PayoutRequest;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function admin_dashboard(): View
    {
        return view('admin.dashboard');
    }

    public function testimonial_view(): View
    {
        return view('admin.testimonial_view');
    }

    public function testimonial_add(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'body_content' => 'required',
            'title' => 'required',
            'image' => 'nullable|image', // optional but recommended
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $directory = 'uploads/testimonial/images/';

            // Create directory if not exists
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            // Move file to the directory
            $image->move(public_path($directory), $filename);
            $imageUrl = $directory . $filename;
        }

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->content = $request->body_content;
        $testimonial->title = $request->title;
        $testimonial->image = $imageUrl;  // null if no image uploaded
        $testimonial->save();

        return redirect()->back()->with([
            'message' => 'Testimonial successfully added',
            'alert-type' => 'success'
        ]);
    }

    public function testimonial_all(): View
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial_all', compact('testimonials'));
    }

    public function testimonial_delete($id): RedirectResponse
    {
        $testimonial =  Testimonial::findOrFail($id);
        $filePath = $testimonial->image;
        File::delete(public_path($filePath));
        $testimonial->delete();
        $notification = array(
            'message' => 'Testimonial Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function testimonial_edit($id): View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial_edit', compact('testimonial'));
    }

    public function testimonial_update(Request $request, $id): RedirectResponse
    {
        $testimonial_update = Testimonial::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'body_content' => 'required',
            'title' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $directory = 'uploads/testimonial/images/';
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            // Move file to the directory
            $image->move(public_path($directory), $filename);
            $path = $directory . $filename;
        } else {
            $path = $testimonial_update->image;
        }
        $testimonial_update->name = $request->name;
        $testimonial_update->content = $request->body_content;
        $testimonial_update->title = $request->title;
        $testimonial_update->image = $path;
        $testimonial_update->save();
        $notification = array(
            'message' => 'Testimonial Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('testimonial.all')->with($notification);
    }

    public function company_view()
    {
        $courses = Course::where('corporate_display', '=', 'yes')->paginate(6);
        return view('frontend.company', compact('courses'));
    }


    public function company_view_detail($id)
    {
        $course = Course::findOrFail($id);
        return view('frontend.company_d', compact('course'));
    }

    public function admin_user_view()
    {
        $courses = Course::all();
        $cohorts = Cohort::all();
        return view('admin.user_admin_view', compact('courses', 'cohorts'));
    }

    public function admin_user_add(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required']
        ]);
        $prefix = 'odumaretech';
        $studentID = $this->generateStudentID($prefix);
        $newUser = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'student_id' => $studentID,
            'password' => Hash::make($request->password),
        ]);

        $applied_course = new AppliedCourse;
        $applied_course->user_id = $newUser->id;
        $applied_course->course_id = $request->course_id;
        $applied_course->status = "pending";
        $applied_course->payment_type = "full";
        $applied_course->admission_status = "accepted";
        $applied_course->cohort_id = $request->cohort_id;
        $applied_course->payment_id = "none";
        $applied_course->save();
        $notification = array(
            'message' => 'User successfully registered',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function company_add(Request $request)
    {
        $training = new CompanyTraining;
        $training->name = $request->name;
        $training->email = $request->email;
        $training->phone = $request->phone;
        $training->intrested_in = $request->intrested_in;
        $training->career = $request->career;
        $training->location = $request->location;
        $training->save();
        $mailData = [
            'company' => $request->name
        ];
        Mail::to($request->email)->send(new CorporateMail($mailData));
        $notification = array(
            'message' => 'Your Request Successfully saved, we will get back to you shortly',
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with($notification);
    }

    public function company_all()
    {
        $company_requests = CompanyTraining::all();
        return view('admin.company_all', compact('company_requests'));
    }

    public function instructor_view()
    {
        $courses = Course::all();
        return view('frontend.instructor', compact('courses'));
    }

    public function instructor_add(Request $request)
    {
        $instructor = new Instructor;
        $check_email_exist = Instructor::where('email', '=', $request->email)->first();
        if ($check_email_exist) {
            $notification = array(
                'message' => 'You have intially sent application, thank you',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $resume = $request->file('resume');
        $extension = $resume->getClientOriginalName();
        $filename = $extension;
        $resume->storeAs('/resume', "/" . $request->first_name . "_odumare" . "." . $filename, 'public');
        $path = "storage/resume/" . $request->first_name . "_odumare" . "." . $filename;

        $instructor->first_name = $request->first_name;
        $instructor->last_name = $request->last_name;
        $instructor->gender = $request->gender;
        $instructor->email = $request->email;
        $instructor->career = $request->career;
        $instructor->resume = $path;
        $instructor->course_ids = $request->course_ids;
        $instructor->save();
        $notification = array(
            'message' => 'Application Successfully sent, we will get back to you shortly',
            'alert-type' => 'success'
        );

        $mailData = [
            'name' => $request->last_name
        ];
        Mail::to($request->email)->send(new InstructorApply($mailData));

        return redirect()->route('home')->with($notification);
    }

    public function instructor_application_all()
    {
        $applicants = Instructor::all();
        return view('admin.instructor_application_all', compact('applicants'));
    }
    public function external_instructor_application_all()
    {
        $applicants = ContentCreator::all();
        return view('admin.external_instructor_application_all', compact('applicants'));
    }

    public function applicant_delete(Request $request, $id)
    {
        $applicant =  Instructor::findOrFail($id);
        $filePath = $applicant->resume;
        File::delete(public_path($filePath));
        $applicant->delete();
        $notification = array(
            'message' => 'Applicant Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function external_applicant_delete(Request $request, $id)
    {
        $applicant =  ContentCreator::findOrFail($id);
        $applicant->delete();
        $notification = array(
            'message' => 'External Applicant Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function applicant_edit($id)
    {
        $courses = Course::all();
        $applicant = Instructor::findOrFail($id);
        return view('admin.applicant_edit', compact('courses', 'applicant'));
    }
    public function external_applicant_edit($id)
    {
        $applicant = ContentCreator::findOrFail($id);
        return view('admin.external_applicant_edit', compact('applicant'));
    }
    public function applicant_update(Request $request, $id)
    {
        // Check if email already exists
        $check_email = User::where('email', '=', $request->email)->first();
        if ($check_email) {
            $notification = [
                'message' => 'Email Already Exist',
                'alert-type' => 'error'
            ];
            return redirect()->route('instructor.application.all')->with($notification);
        }

        // Ensure a course is selected if approving
        if ($request->status == "approved" && $request->course_ids == NULL) {
            $notification = [
                'message' => 'Please Select at least a course for the Instructor',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }

        // ✅ APPROVED CASE
        if ($request->status == "approved") {
            $applicant = Instructor::findOrFail($id);
            $applicant->status = $request->status;
            $applicant->save();

            // Generate user credentials
            $prefix = 'Instructor';
            $studentID = $this->generateStudentID($prefix);
            $password = $this->generateStudentID($request->first_name);

            // Create user account
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'student_id' => $studentID,
                'password'   => Hash::make($password),
                'user_type'  => "instructor"
            ]);

            // Save approved instructor record
            $approved_instructor = new ApprovedInstructor;
            $approved_instructor->user_id = $user->id;
            $approved_instructor->course_ids = json_encode($request->course_ids);
            $approved_instructor->save();

            // Email message
            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
                'I am thrilled to inform you that you have been selected for the position of an Instructor at OdumareTech. Congratulations!' . PHP_EOL . PHP_EOL .
                'We were highly impressed by your skills, experience, and passion for education.' . PHP_EOL . PHP_EOL .
                'We believe that your expertise and teaching abilities will be invaluable in creating an exceptional learning experience for our students.' . PHP_EOL . PHP_EOL .
                'Below are your login details:' . PHP_EOL .
                'Email: ' . $request->email . PHP_EOL .
                'Password: ' . $password . PHP_EOL . PHP_EOL .
                'Welcome aboard!' . PHP_EOL . PHP_EOL .
                'Best regards,' . PHP_EOL .
                'OdumareTech Team';

            // Send plain text email
            try {
                Mail::raw($message, function ($mail) use ($request) {
                    $mail->to($request->email)
                        ->subject('Congratulations! Instructor Application Approved');
                });
            } catch (\Throwable $e) {
            }

            // Notification feedback
            $notification = [
                'message' => 'Applicant Successfully updated',
                'alert-type' => 'success'
            ];

            return redirect()->route('instructor.application.all')->with($notification);
        }

        // ❌ REJECTED CASE
        else {
            $applicant = Instructor::findOrFail($id);
            $applicant->status = $request->status;
            $applicant->save();

            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
                'Thank you for your application and your interest in joining our team at OdumareTech. We appreciate the time and effort you put into the process.' . PHP_EOL . PHP_EOL .
                'After careful consideration, we regret to inform you that we have decided not to move forward with your application at this time.' . PHP_EOL . PHP_EOL .
                'While your qualifications and experience are commendable, we had to make a difficult decision based on our specific requirements and current circumstances.' . PHP_EOL . PHP_EOL .
                'We sincerely appreciate your interest and wish you the very best in your future endeavors.' . PHP_EOL . PHP_EOL .
                'Best regards,' . PHP_EOL .
                'OdumareTech Team';

            // Send plain text email
            try {
                Mail::raw($message, function ($mail) use ($request) {
                    $mail->to($request->email)
                        ->subject('Application Update - OdumareTech');
                });
            } catch (\Throwable $e) {
            }

            $notification = [
                'message' => 'Applicant Successfully updated',
                'alert-type' => 'success'
            ];

            return redirect()->route('instructor.application.all')->with($notification);
        }
    }



    public function external_applicant_update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);

        $check_email = User::where('email', '=', $request->email)->first();
        if ($check_email) {
            return redirect()->route('external.instructor.application.all')
                ->with([
                    'message' => 'Email already exists in the system.',
                    'alert-type' => 'error'
                ]);
        }


        // ✅ APPROVED CASE
        if ($request->status === "approved") {
            $applicant = ContentCreator::findOrFail($id);
            $applicant->status = $request->status;
            $applicant->save();

            $prefix = 'ExtInstructor';
            $instructorID = $this->generateStudentID($prefix);
            $password = $this->generateStudentID($request->first_name);

            // Create user record
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'student_id' => $instructorID,
                'password'   => Hash::make($password),
                'user_type'  => "external_instructor",
            ]);

            // Send approval email
            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
                'Congratulations! You have been selected as an **External Instructor** at OdumareTech.' . PHP_EOL . PHP_EOL .
                'Your skills and expertise will play a key role in delivering a rich learning experience.' . PHP_EOL . PHP_EOL .
                'Below are your login details:' . PHP_EOL .
                'Email: ' . $request->email . PHP_EOL .
                'Password: ' . $password . PHP_EOL . PHP_EOL .
                'Welcome aboard!' . PHP_EOL . PHP_EOL .
                'Best regards,' . PHP_EOL .
                'OdumareTech Team';

            try {
                Mail::raw($message, function ($mail) use ($request) {
                    $mail->to($request->email)
                        ->subject('Congratulations! External Instructor Application Approved');
                });
            } catch (\Throwable $e) {
            }

            return redirect()->route('external.instructor.application.all')
                ->with([
                    'message' => 'External Instructor successfully approved and notified.',
                    'alert-type' => 'success'
                ]);
        }

        // ❌ REJECTED CASE
        else {
            $applicant = ContentCreator::findOrFail($id);
            $applicant->status = $request->status;
            $applicant->save();

            // Rejection message
            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
                'Thank you for your application to become an External Instructor at OdumareTech.' . PHP_EOL . PHP_EOL .
                'After careful review, we regret to inform you that we will not be moving forward at this time.' . PHP_EOL . PHP_EOL .
                'We appreciate your effort and wish you success in your future endeavors.' . PHP_EOL . PHP_EOL .
                'Best regards,' . PHP_EOL .
                'OdumareTech Team';

            try {
                Mail::raw($message, function ($mail) use ($request) {
                    $mail->to($request->email)
                        ->subject('Application Update - OdumareTech');
                });
            } catch (\Throwable $e) {
            }

            return redirect()->route('external.instructor.application.all')
                ->with([
                    'message' => 'External Instructor status updated and email sent.',
                    'alert-type' => 'success'
                ]);
        }
    }

    public function admin_chat_all()
    {
        $chats = InstructorChat::all();
        return view('admin.chat_all', compact('chats'));
    }

    public function admin_chat_reply($id)
    {
        $chat = InstructorChat::findOrFail($id);
        return view('admin.chat_reply', compact('chat'));
    }

    public function admin_chat_replied(Request $request, $id)
    {
        $chat = InstructorChat::findOrFail($id);
        $chat->admin_message = $request->message;
        $chat->admin_status = "replied";
        $chat->instructor_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message replied',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.chat.all')->with($notification);
    }


    public function innovation_view(): View
    {
        return view('admin.innovation_view');
    }

    public function innovation_add(Request $request): RedirectResponse
    {
        $image = $request->file('image');

        $folderPath = public_path('custom_innovation_images');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move($folderPath, $filename);
        $path = 'custom_innovation_images/' . $filename;

        $new_inno = new Innovation;
        $new_inno->name = $request->name;
        $new_inno->github = $request->github;
        $new_inno->link = $request->link;
        $new_inno->status = $request->status;
        $new_inno->image = $path;  // Save the relative path to DB
        $new_inno->start_date = $request->start_date;
        $new_inno->end_date = $request->end_date;
        $new_inno->duration = $request->duration;
        $new_inno->description = $request->description;
        $new_inno->requirement = $request->requirement;
        $new_inno->save();

        $notification = [
            'message' => 'Innovation Successfully added',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function innovation_all(): View
    {
        $innovations = Innovation::all();
        return view('admin.innovation_all', compact('innovations'));
    }

    public function innovation_delete($id): RedirectResponse
    {
        $innovation =  Innovation::findOrFail($id);
        $filePath = $innovation->image;
        File::delete(public_path($filePath));
        $innovation->delete();
        $notification = array(
            'message' => 'Innovation Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function innovation_edit($id): View
    {
        $innovation = Innovation::findOrFail($id);
        return view('admin.innovation_edit', compact('innovation'));
    }

    public function innovation_update(Request $request, $id): RedirectResponse
    {
        $innovation = Innovation::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $folderPath = public_path('custom_innovation_images');

            // Create folder if not exists
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Move uploaded file to folder
            $image->move($folderPath, $filename);

            // Delete old image file if exists
            if ($innovation->image && file_exists(public_path($innovation->image))) {
                unlink(public_path($innovation->image));
            }

            // Save new image path
            $innovation->image = 'custom_innovation_images/' . $filename;
        }

        // Update other fields
        $innovation->name = $request->name;
        $innovation->github = $request->github;
        $innovation->link = $request->link;
        $innovation->status = $request->status;
        $innovation->start_date = $request->start_date;
        $innovation->end_date = $request->end_date;
        $innovation->duration = $request->duration;
        $innovation->description = $request->description;
        $innovation->requirement = $request->requirement;

        $innovation->save();

        $notification = [
            'message' => 'Innovation Successfully updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('innovation.all')->with($notification);
    }



    public function blog_view(): View
    {
        return view('admin.blog_view');
    }

    public function blog_add(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'link' => 'required|url',
            'image' => 'required|image|max:2048', // validate image type and max size
        ]);

        $image = $request->file('image');
        $customPath = public_path('uploads/blog');  // Customize your folder here

        // Create directory if not exists
        if (!file_exists($customPath)) {
            mkdir($customPath, 0755, true);
        }

        // Generate unique filename with extension
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Move the uploaded file to the custom folder
        $image->move($customPath, $filename);

        // Save relative path for database (relative to public folder)
        $path = 'uploads/blog/' . $filename;

        $new_bg = new Blog;
        $new_bg->name = $request->name;
        $new_bg->desc = $request->desc;
        $new_bg->link = $request->link;
        $new_bg->image = $path;
        $new_bg->save();

        $notification = [
            'message' => 'Post Successfully added',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function blog_all()
    {
        $posts = Blog::all();
        return view('admin.blog_all', compact('posts'));
    }


    public function blog_edit($id): View
    {
        $post = Blog::findOrFail($id);
        return view('admin.blog_edit', compact('post'));
    }

    public function blog_delete($id): RedirectResponse
    {
        $post =  Blog::findOrFail($id);
        $filePath = $post->image;
        File::delete(public_path($filePath));
        $post->delete();
        $notification = array(
            'message' => 'Post Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function blog_update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'link' => 'required|url',
            'image' => 'nullable|image|max:2048', // optional image validation
        ]);

        $bg_update = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $customPath = public_path('uploads/blog');  // Customize your folder here

            // Create directory if not exists
            if (!file_exists($customPath)) {
                mkdir($customPath, 0755, true);
            }

            // Generate unique filename with extension
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded file to the custom folder
            $image->move($customPath, $filename);

            // Save relative path for database (relative to public folder)
            $path = 'uploads/blog/' . $filename;

            // Optionally delete old image file
            if ($bg_update->image && file_exists(public_path($bg_update->image))) {
                unlink(public_path($bg_update->image));
            }
        } else {
            $path = $bg_update->image;
        }

        $bg_update->name = $request->name;
        $bg_update->desc = $request->desc;
        $bg_update->link = $request->link;
        $bg_update->image = $path;
        $bg_update->save();

        $notification = [
            'message' => 'Post Successfully updated',
            'alert-type' => 'success',
        ];

        return redirect()->route('blog.all')->with($notification);
    }


    public function admin_password_view()
    {
        return view('admin.change_password');
    }

    public function admin_password_change(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $notification = array(
                'message' => 'Password Changed Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Incorrect Password, Please try again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function applied_view()
    {
        $cohorts = Cohort::all();
        $courses = Course::all();
        $applied = User::leftJoin('applied_courses', 'users.id', '=', 'applied_courses.user_id')
            ->leftJoin('cohorts', 'cohorts.id', '=', 'applied_courses.cohort_id')
            ->leftJoin('courses', 'courses.id', '=', 'applied_courses.course_id')
            ->whereNotNull('applied_courses.user_id') // Filter only users with records in applied_courses
            ->select(
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.student_id',
                'cohorts.name as cohort_name',
                \DB::raw("IFNULL(cohorts.name, 'not set') as cohort_name_default"),
                'courses.title as course_title',
                'applied_courses.*' // Select all columns from applied_courses
            )
            ->get();
        return view('admin.applied_student_all', compact('applied', 'cohorts', 'courses'));
    }

    public function applied_users_update(Request $request, $id)
    {
        $applied_course = AppliedCourse::findOrFail($id);
        $applied_course->cohort_id = $request->cohort_id;
        $applied_course->course_id = $request->course_id;
        $applied_course->save();
        $notification = array(
            'message' => 'User Info successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function generateStudentID($prefix, $length = 6)
    {
        $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
        $studentID = $prefix . $randomNumber;
        return $studentID;
    }

    public function platform_configure()
    {
        $dollar_rate = DollarRate::first();
        return view('admin.platform_configure', compact('dollar_rate'));
    }

    public function dollar_save(Request $request, $id = null)
    {
        if ($request->id == null || $request->id == "") {
            $dollar_rate = new DollarRate;
            $dollar_rate->price = $request->dollar_rate;
            $dollar_rate->save();
            $notification = array(
                'message' => 'Dollar Rate Successfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $update_dollar =  DollarRate::findOrFail($request->id);
            $update_dollar->price = $request->dollar_rate;
            $update_dollar->save();
            $notification = array(
                'message' => 'Dollar Rate Successfully updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function user_lock_lock(Request $request, $id)
    {
        if (request()->has('lock')) {
            $status = 'rejected';
        } else {
            $status = 'accepted';
        }
        $message = $status == 'rejected' ? 'deactivated' : 'activated';
        $applied = AppliedCourse::findOrFail($id);
        $applied->admission_status = $status;
        $applied->save();
        $notification = array(
            'message' => 'User Account Successfully ' . $message,
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function platform_message_delete()
    {
        Contact::truncate();
        $notification = array(
            'message' => 'All messages deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function platform_masterclass_delete()
    {
        MasterClass::truncate();
        $notification = array(
            'message' => 'All master class feedback deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function platform_corporate_delete()
    {
        CompanyTraining::truncate();
        $notification = array(
            'message' => 'All corporate feedback deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function role_view(): View
    {
        $roles = AdminRole::all();
        return view('admin.role_view', compact('roles'));
    }
    public function admin_user_all(): View
    {
        $users = User::all();
        return view('admin.student_all', compact('users'));
    }

    public function role_add(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);
        $add_role = new AdminRole;
        $add_role->name = $request->name;
        $add_role->save();
        $notification = array(
            'message' => 'role Successfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function role_delete($id)
    {

        $delete_role = AdminRole::findOrFail($id);
        $delete_role->delete();
        $notification = array(
            'message' => 'Role Successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function role_permission($id)
    {
        $role = AdminRole::findOrFail($id);
        return view('admin.permission', compact('role'));
    }

    public function role_permission_set(Request $request, $id)
    {
        $role = AdminRole::findOrFail($id);
        $role->permission = $request->permission;
        $role->save();
        $notification = array(
            'message' => 'Permission Successfully Set',
            'alert-type' => 'success'
        );
        return redirect()->route('role.view')->with($notification);
    }

    public function role_edit($id)
    {

        $role = AdminRole::findOrFail($id);
        $roles = AdminRole::all();
        return view('backend.role_edit', compact('roles', 'role'));
    }

    public function role_update(Request $request, $id)
    {
        $update_role = AdminRole::findOrFail($id);
        $update_role->name = $request->name;
        $update_role->save();
        $notification = array(
            'message' => 'Role Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('role.view')->with($notification);
    }


    public function admin_manager_view()
    {
        $roles = AdminRole::all()->keyBy('id'); // key roles by ID for easy lookup
        $users = User::whereNotNull('user_role')->where('user_type', 'admin_manager')->get();
        return view('admin.admin_manager_view', compact('roles', 'users'));
    }

    public function admin_admin_manager_save(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => 'required',
            'user_roles' => 'required|array',
            'user_roles.*' => 'exists:admin_roles,id',
        ]);

        // Generate random password
        $min = 100000;
        $max = 999999;
        $randomNumber = rand($min, $max);
        $password = "admin_manager" . $randomNumber;

        // Create the user
        $add_user = new User;
        $add_user->first_name = $request->first_name;
        $add_user->last_name = $request->last_name;
        $add_user->email = $request->email;
        $add_user->phone = $request->phone;
        $add_user->user_role = json_encode($request->user_roles);
        $add_user->user_type = 'admin_manager';
        $add_user->password = Hash::make($password);
        $add_user->save();

        // Prepare plain text email
        $message = "Dear {$request->first_name} {$request->last_name},\n\n" .
            "Your admin manager account has been created successfully.\n\n" .
            "Login details:\n" .
            "Email: {$request->email}\n" .
            "Password: {$password}\n\n" .
            "Please login and change your password after first login.\n\n" .
            "Regards,\n" .
            "Admin Team";

        // Send plain text email
        try {
            Mail::raw($message, function ($mail) use ($request) {
                $mail->to($request->email)
                    ->subject('Your Admin Manager Account Details');
            });
        } catch (\Throwable $e) {
        }

        $notification = [
            'message' => 'Admin Manager Successfully saved and email sent',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function admin_manager_update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'user_roles' => 'required|array',
            'user_roles.*' => 'exists:admin_roles,id',
        ]);

        $update_user = User::findOrFail($id);
        $update_user->first_name = $request->first_name;
        $update_user->last_name = $request->last_name;
        $update_user->email = $request->email;
        $update_user->phone = $request->phone;
        $update_user->user_type = 2;
        $update_user->user_role = json_encode($request->user_roles); // Store as JSON array
        $update_user->save();

        $notification = [
            'message' => 'Admin Manager Successfully updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin_manager.view')->with($notification);
    }

    public function admin_admin_manager_block(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->block = $request->status;
        $user->save();
        $notification = array(
            'message' => 'Admin Manager Successfully blocked',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function admin_admin_manager_delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' => 'Admin Manager Successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function admin_manager_edit($id)
    {
        $user = User::findOrFail($id);
        $roles = AdminRole::all();
        $users = User::whereNotNull('user_role')->where('user_type', 2)->get();
        return view('backend.admin_manager_edit', compact('user', 'users', 'roles'));
    }

    public function admin_manager_all()
    {
        $users = User::where('user_type', '=', 1)->get();
        return view('backend.admin_manager_all', compact('users'));
    }


    public function viewResume($id)
    {
        $applicant = Instructor::findOrFail($id);
        $filePath = public_path($applicant->resume);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath, [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ]);
    }

    public function allPayoutRequests()
    {
        $payouts = PayoutRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.payout', compact('payouts'));
    }

    public function update_payout(Request $request)
{
    $request->validate([
        'payout_id' => 'required|exists:payout_requests,id',
        'action' => 'required|in:approve,decline',
    ]);

    $payout = PayoutRequest::with('user')->find($request->payout_id);

    if ($payout) {
        $payout->status = $request->action === 'approve' ? 'approved' : 'rejected';
        $payout->save();

        if ($request->action === 'approve') {
            $user = $payout->user; 
            if ($user) {
                $user->decrement('referral_bonus', $payout->amount);
            }
        }
        
        // Prepare email content
        $subject = $request->action === 'approve'
            ? 'Payout Approved'
            : 'Payout Declined';

        $messageBody = $request->action === 'approve'
            ? "Dear {$payout->user->first_name},\n\nWe’re pleased to inform you that your payout request of $"
                . number_format($payout->amount, 2) . " has been approved.\n\nThe funds will be processed to your registered bank account shortly.\n\nThank you for your patience.\n\nBest regards,\nOdumareTech Finance Team"
            : "Dear {$payout->user->first_name},\n\nWe regret to inform you that your payout request of $"
                . number_format($payout->amount, 2) . " has been declined.\n\nIf you believe this is an error, please contact our support team for clarification.\n\nBest regards,\nOdumareTech Finance Team";

                try{
                    Mail::raw($messageBody, function ($message) use ($payout, $subject) {
                        $message->to($payout->user->email)
                                ->subject($subject);
                    });
                }catch(\Throwable $e){

                }
        
    }
    $notification = [
        'message' => 'Payout ' . ucfirst($request->action) . ' successfully and user notified.',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);

}

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file     = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path     = public_path('uploads/');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);

            // CKEditor expects { "url": "http://..." }
            return response()->json([
                'default' => asset('uploads/' . $filename)
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }


    public function instructor_t_c_save(Request $request)
    {
        $request->validate([
            'desc' => 'required|string',
        ]);

        // Fetch first row or create/update
        $tc = InstructorTC::first();

        if ($tc) {
            // Update existing
            $tc->update([
                'desc' => $request->desc,
            ]);
        } else {
            // Create new
            InstructorTC::create([
                'desc' => $request->desc,
            ]);
        }
        $notification = [
            'message' => 'Term and condition saved successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function instructor_t_c()
    {
        $tc = InstructorTC::first();
        return view('admin.instructor_t_c', compact('tc'));
    }


    public function manage_cookies()
    {
        $visitors = CookieConsent::all();
        return view('admin.manage_cookies', compact('visitors'));
    }

    public function manage_external_courses():View{
        $courses = Course::where('course_type', '=', 'external')->get();
        return view('admin.manage_external_courses', compact('courses'));
    }


    public function admin_external_course_view($id){
        $categories = Category::all();
        $course = Course::findOrFail($id);
        return view('admin.course_external_edit', compact('categories', 'course'));
    }

    public function external_in_curriculum($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.admin_external_curriculum', compact('course'));
    }


    public function updateStatusExternalCourse(Request $request, $id)
{
    $request->validate([
        'admin_status' => 'required|string|in:under_review,approved,declined,make_changes',
        'reason' => 'nullable|string',
    ]);

    $course = DB::table('courses')->where('id', $id)->first();
    if (!$course) {
        return back()->with('error', 'Course not found.');
    }

    $status = $request->admin_status;
    $reason = $request->reason ?? null;
    $logs = json_decode($course->approval_logs ?? '[]', true);

    $logs[] = [
        'status' => $status,
        'reason' => $reason,
        'time' => now()->toDateTimeString(),
    ];

    DB::table('courses')->where('id', $id)->update([
        'admin_status' => $status,
        'approval_logs' => json_encode($logs),
        'updated_at' => now(),
    ]);

    try{
// Send notification to instructor
$instructorEmail = optional($course->instructor_name)->email ?? null;
$instructorfirstName = optional($course->instructor_name)->first_name ?? null;

if ($instructorEmail) {
    $message = "Hello {$instructorfirstName},\n\n".
               "Your course titled '{$course->title}' has been updated to status: '".ucfirst($status)."'.\n\n";

    if ($reason) {
        $message .= "Reason: {$reason}\n\n";
    }

    $message .= "Login to your dashboard to view more details.\n\nRegards,\nAdmin Team";

    Mail::raw($message, function ($msg) use ($instructorEmail) {
        $msg->to($instructorEmail)
            ->subject('Course Status Updated');
    });
}

    }catch(\Throwable){

    }
    $notification = [
        'message' => 'Course status updated successfully.',
        'alert-type' => 'success'
    ];
    return redirect()->back()->with($notification);
    
}
}
