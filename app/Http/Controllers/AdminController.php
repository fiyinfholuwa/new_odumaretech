<?php

namespace App\Http\Controllers;

use App\Mail\ApplicantNotification;
use App\Mail\CorporateMail;
use App\Mail\InstructorApply;
use App\Models\AppliedCourse;
use App\Models\ApprovedInstructor;
use App\Models\Blog;
use App\Models\Cohort;
use App\Models\CompanyTraining;
use App\Models\Contact;
use App\Models\Course;
use App\Models\DollarRate;
use App\Models\Innovation;
use App\Models\Instructor;
use App\Models\InstructorChat;
use App\Models\MasterClass;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function admin_dashboard():View{
        return view('admin.dashboard');
    }

    public function testimonial_view():View
    {
        return view('admin.testimonial_view');
    }

    public function testimonial_add(Request $request):RedirectResponse
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
            $imageUrl =$directory . $filename;
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

    public function testimonial_all():View{
        $testimonials = Testimonial::all();
        return view('admin.testimonial_all', compact('testimonials'));
    }

    public function testimonial_delete($id):RedirectResponse
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

    public function testimonial_edit($id):View{
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial_edit', compact('testimonial'));
    }

    public function testimonial_update(Request $request, $id):RedirectResponse{
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
            $path =$directory . $filename;
        }
        else{
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

    public function company_view(){
        $courses= Course::where('corporate_display', '=', 'yes')->paginate(6);
        return view('frontend.company', compact('courses'));
    }


    public function company_view_detail($id){
        $course= Course::findOrFail($id);
        return view('frontend.company_d', compact('course'));
    }

    public function admin_user_view(){
        $courses = Course::all();
        $cohorts = Cohort::all();
        return view('admin.user_admin_view', compact('courses','cohorts'));
    }

    public function admin_user_add(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
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

    public function company_add(Request $request){
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

    public function company_all(){
        $company_requests = CompanyTraining::all();
        return view('admin.company_all', compact('company_requests'));
    }

    public function instructor_view(){
        $courses = Course::all();
        return view('frontend.instructor', compact('courses'));
    }

    public function instructor_add(Request $request){
        $instructor= new Instructor;
        $check_email_exist = Instructor::where('email', '=', $request->email)->first();
        if($check_email_exist){
            $notification = array(
                'message' => 'You have intially sent application, thank you',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $resume = $request->file('resume');
        $extension = $resume->getClientOriginalName();
        $filename = $extension;
        $resume->storeAs( '/resume' , "/" . $request->first_name . "_odumare" . "." .$filename, 'public');
        $path = "storage/resume/" . $request->first_name . "_odumare" . "." .$filename;

        $instructor->first_name = $request->first_name;
        $instructor->last_name= $request->last_name;
        $instructor->gender = $request->gender;
        $instructor->email = $request->email;
        $instructor->career = $request->career;
        $instructor->resume= $path;
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

    public function instructor_application_all(){
        $applicants = Instructor::all();
        return view('admin.instructor_application_all', compact('applicants'));
    }

    public function applicant_delete(Request $request, $id){
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

    public function applicant_edit($id){
        $courses = Course::all();
        $applicant = Instructor::findOrFail($id);
        return view('admin.applicant_edit', compact('courses', 'applicant'));
    }
    public function applicant_update(Request $request, $id){


        $check_email = User::where('email', '=', $request->email)->first();
        if($check_email){
            $notification = array(
                'message' => 'Email Already Exist',
                'alert-type' => 'error'
            );
            return redirect()->route('instructor.application.all')->with($notification);
        }
        if($request->status == "approved" && $request->course_ids == NULL){
            $notification = array(
                'message' => 'Please Select at least a course for the Instructor',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if($request->status == "approved"){
            $applicant =  Instructor::findOrFail($id);
            $applicant->status = $request->status;
            $applicant->save();
            $prefix = 'Instructor'; // Prefix or school code
            $studentID = $this->generateStudentID($prefix);
            $password = $this->generateStudentID($request->first_name);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'student_id' => $studentID,
                'password' => Hash::make($password),
                'user_type' => "1"
            ]);
            $user_id = $user->id;
            $approved_instructor = new ApprovedInstructor;
            $approved_instructor->user_id = $user_id;
            $approved_instructor->course_ids = $request->course_ids;
            $approved_instructor->save();

            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
                'I am thrilled to inform you that you have been selected for the position of an Instructor at OdumareTech. Congratulations on securing the job! We were highly impressed by your skills, experience, and passion for education.' . PHP_EOL . PHP_EOL .
                'We believe that your expertise and teaching abilities will be invaluable in creating an exceptional learning experience for our students. We are excited to have you join our team and contribute to our mission of transforming education.' . PHP_EOL . PHP_EOL .
                'Welcome aboard, and we look forward to working with you to make a positive impact in the lives of learners around the world!' . PHP_EOL . PHP_EOL .
                'Below is your login details';


            $mailData = [
                'status' => $request->status,
                'password' => $password,
                'message' => $message,
                'email' => $request->email
            ];
            Mail::to($request->email)->send(new ApplicantNotification($mailData));
            $notification = array(
                'message' => 'Applicant Successfully updated',
                'alert-type' => 'success'
            );
            return redirect()->route('instructor.application.all')->with($notification);

        }else{

            $applicant =  Instructor::findOrFail($id);
            $applicant->status = $request->status;
            $applicant->save();
            $message = 'Dear ' . $request->last_name . ',' . PHP_EOL . PHP_EOL .
                'Thank you for your application and your interest in joining our team at OdumareTech. We appreciate the time and effort you put into the application process.' . PHP_EOL . PHP_EOL .
                'After careful consideration, we regret to inform you that we have decided not to move forward with your application at this time. While your qualifications and experience are commendable, we had to make a difficult decision based on our specific requirements and current circumstances.' . PHP_EOL . PHP_EOL .
                'We sincerely appreciate your interest in our organization and the dedication you have shown to the field of education. We encourage you to continue pursuing your passion for teaching and wish you the very best in your future endeavors.' . PHP_EOL . PHP_EOL .
                'Thank you once again for considering us as a potential employer, and we extend our best wishes for your continued professional success.';

            $mailData = [
                'status' => $request->status,
                'password' => "",
                'message' => $message,
                'email' => $request->email
            ];
            Mail::to($request->email)->send(new ApplicantNotification($mailData));
            $notification = array(
                'message' => 'Applicant Successfully updated',
                'alert-type' => 'success'
            );
            return redirect()->route('instructor.application.all')->with($notification);
        }

    }

    public function admin_chat_all(){
        $chats = InstructorChat::all();
        return view('admin.chat_all', compact('chats'));
    }

    public function admin_chat_reply($id){
        $chat = InstructorChat::findOrFail($id);
        return view('admin.chat_reply', compact('chat'));
    }

    public function admin_chat_replied(Request $request, $id){
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


    public function innovation_view():View{
        return view('admin.innovation_view');
    }

    public function innovation_add(Request $request):RedirectResponse {
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

    public function innovation_all():View{
        $innovations = Innovation::all();
        return view('admin.innovation_all', compact('innovations'));
    }

    public function innovation_delete($id):RedirectResponse{
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

    public function innovation_edit($id):View{
        $innovation = Innovation::findOrFail($id);
        return view('admin.innovation_edit', compact('innovation'));
    }

    public function innovation_update(Request $request, $id):RedirectResponse {
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



    public function blog_view():View{
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

    public function blog_all(){
        $posts = Blog::all();
        return view('admin.blog_all', compact('posts'));
    }


    public function blog_edit($id):View{
        $post = Blog::findOrFail($id);
        return view('admin.blog_edit', compact('post'));
    }

    public function blog_delete($id):RedirectResponse{
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


    public function admin_password_view(){
        return view('admin.change_password');
    }

    public function admin_password_change(Request $request){
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
        }else{
            $notification = array(
                'message' => 'Incorrect Password, Please try again.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    public function applied_view(){
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

    public function applied_users_update(Request $request, $id){
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

    public function generateStudentID($prefix, $length = 6) {
        $randomNumber = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
        $studentID = $prefix . $randomNumber;
        return $studentID;
    }

    public function platform_configure(){
        $dollar_rate = DollarRate::first();
        return view('admin.platform_configure', compact('dollar_rate'));
    }

    public function dollar_save(Request $request, $id=null){
        if($request->id ==null || $request->id ==""){
            $dollar_rate = new DollarRate;
            $dollar_rate->price = $request->dollar_rate;
            $dollar_rate->save();
            $notification = array(
                'message' => 'Dollar Rate Successfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
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

    public function user_lock_lock(Request $request,$id){
        if (request()->has('lock')){
            $status = 'rejected';
        }else{
            $status = 'accepted';
        }
        $message = $status == 'rejected' ? 'deactivated' : 'activated';
        $applied = AppliedCourse::findOrFail($id);
        $applied->admission_status = $status;
        $applied->save();
        $notification = array(
            'message' => 'User Account Successfully '.$message,
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function platform_message_delete(){
        Contact::truncate();
        $notification = array(
            'message' => 'All messages deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function platform_masterclass_delete(){
        MasterClass::truncate();
        $notification = array(
            'message' => 'All master class feedback deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function platform_corporate_delete(){
        CompanyTraining::truncate();
        $notification = array(
            'message' => 'All corporate feedback deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
