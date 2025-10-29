<?php

namespace App\Http\Controllers;

use App\Mail\InstructorApply;
use App\Models\AppliedCourse;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\CompanyTraining;
use App\Models\ContentCreator;
use App\Models\CookieConsent;
use App\Models\Coupon;
use App\Models\CouponUsed;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\Innovation;
use App\Models\Instructor;
use App\Models\InstructorTC;
use App\Models\MasterClass;
use App\Models\MasterClassLink;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;


class FrontendController extends Controller
{
    public function home(): View
    {
        $popular_courses = Course::with('cat')->where('course_type', 'internal')->paginate(3);
        $testimonials = Testimonial::paginate(8);
        $innovations = Innovation::paginate(3);
        return view('frontend.home', ['popular_courses' => $popular_courses, 'testimonials' => $testimonials, 'innovations' => $innovations]);
    }

    public function courses(): View
    {
        $popular_courses = Course::with('cat')->where('course_type', 'internal')->paginate(4);
        $testimonials = Testimonial::paginate(8);
        return view('frontend.courses', ['courses' => $popular_courses, 'testimonials' => $testimonials]);
    }
    public function blog(Request $request): View
{
    $query = Blog::query();

    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function ($q) use ($keyword) {
            $q->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('desc', 'LIKE', '%' . $keyword . '%');
        });
    }

    // Order by most recent
    $query->orderBy('created_at', 'desc');

    $blogs = $query->paginate(6)->withQueryString();

    return view('frontend.blog', ['blogs' => $blogs]);
}


    public function about(): View
    {
        return view('frontend.about');
    }
    public function recommender(): View
    {
        $popular_courses = Course::with('cat')->where('course_type', 'internal')->get();

        return view('auth.recommender', compact('popular_courses'));
    }
    public function faq(): View
    {
        return view('frontend.faq');
    }
    public function contact(): View
    {
        return view('frontend.contact');
    }
    public function career(): View
    {
        $courses = Course::all();
        return view('frontend.career', ['courses' => $courses]);
    }
    public function course_detail($name): View
    {
        $popular_courses = Course::with('cat')->paginate(3);

        $course = Course::with('cat')->where('course_url', $name)->first();

        if (Auth::check()) {
            $check_user_has_coupon = CouponUsed::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)->first();
            $has_pending = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)
                ->where('status', '=', "pending")->first();
        } else {
            $check_user_has_coupon = NULL;
            $has_pending = NULL;
        }
        $cohort_name = Cohort::where('id', $course->cohort)->first();
        $coupon_check = Coupon::where('course_id', '=', $course->id)->first();
        return view('frontend.course_detail', ['course' => $course, 'courses' => $popular_courses, 'check_user_has_coupon' => $check_user_has_coupon, 'has_pending' => $has_pending, 'cohort_name' => $cohort_name]);
    }
    public function innovation(): View
    {
        $innovations = Innovation::paginate(3);
        return view('frontend.innovation', ['innovations' => $innovations]);
    }
    public function masterclass(): View
    {
        $master_class = MasterClassLink::first();
        return view('frontend.masterclass', compact('master_class'));
    }
    public function hire_grad(): View
    {
        return view('frontend.hire_grad');
    }
    public function sell_a_course(): View
    {

        $external_instructor = User::where('user_type', 'external_instructor')
            ->orderBy('student_count', 'desc')
            ->limit(8)
            ->get();
        return view('frontend.sell_a_course', [
            'instructors' => $external_instructor,
        ]);
    }
    public function privacy(): View
    {
        return view('frontend.privacy');
    }
    public function terms(): View
    {
        return view('frontend.terms');
    }
    public function sell_course(): View
    {
        $external_t_c = InstructorTC::first();
        if($external_t_c){
            $tc = $external_t_c->desc;
        }else{
            $tc = "Not Available";
        }
        return view('frontend.sell_course',compact('tc'));
    }
    public function community(): View
    {
        return view('frontend.community');
    }
    public function hire(): View
    {
        return view('frontend.hire');
    }
    public function consultation(): View
    {
        $popular_courses = Course::with('cat')->where('course_type', 'internal')->get();
        return view('frontend.consultation', ['courses' => $popular_courses]);
    }
    public function corporate_training(): View
    {
        $popular_courses = Course::with('cat')->where('course_type', 'internal')->paginate(6);
        return view('frontend.corporate_training', ['courses' => $popular_courses]);
    }
    public function marketplace(): View
    {

        $ext_courses  = Course::where('course_type', 'external')->count();
        $ext_instructor = User::where('user_type', 'external_instructor')->count();
        $student = User::where('user_type', 'user')->count();
        $best_selling = Course::with('cat')
            ->where('course_type', 'external')
            ->orderBy('student_count', 'desc')
            ->take(8)
            ->get();
        $featured_courses  = Course::with('cat')->where('course_type', 'external')->get();

        $categories = Category::withCount('courses')->get();
        $formatted = $categories->map(function ($cat) {
            return [
                'name' => $cat->name,
                'courses' => $cat->courses_count
            ];
        })->toArray();


        return view('frontend.marketplace', [
            'ext_courses' => $ext_courses,
            'ext_instructor' => $ext_instructor,
            'student' => $student,
            'featured_courses' => $featured_courses,
            'best_selling' => $best_selling,
            'categories' => $formatted
        ]);
    }
    public function course_list(Request $request): View
    {
        $categories = Category::all();
        $query = Course::with('cat')
            ->where('course_type', 'external');

        // 🔍 Search by title
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // 🎯 Filter
        if ($request->filled('filter')) {
            if ($request->filter === 'free') {
                $query->where('price', 0);
            } elseif ($request->filter === 'paid') {
                $query->where('price', '>', 0);
            } elseif ($request->filter === 'beginner') {
                $query->where('level', 'beginner');
            }
        }

        // 🔄 Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('student_count', 'desc');
                    break;
                case 'top_rated':
                    // you’d need a rating column to make this meaningful
                    $query->orderBy('id', 'desc');
                    break;
                case 'trending':
                default:
                    $query->orderBy('student_count', 'desc');
                    break;
            }
        }

        $courses = $query->paginate(6);

        return view('frontend.course_list', [
            'courses' => $courses,
            'search'  => $request->search,
            'filter'  => $request->filter,
            'sort'    => $request->sort,
            'categories' => $categories
        ]);
    }

    public function store_review(Request $request, $courseId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        CourseReview::create([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        $notification = [
            'message' => 'Review successfully submitted!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }


    public function course_external_detail($name): View
    {
        $popular_courses = Course::with('cat')->where('course_type', 'external')->paginate(4);

        $course = Course::with('cat')->where('course_url', $name)->first();
        $reviews = CourseReview::with('user')
            ->where('course_id', $course->id)
            ->latest()
            ->get();

        if (Auth::check()) {

            $check_user_has_coupon = CouponUsed::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)->first();
            $has_pending = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)
                ->where('status', '=', "pending")->first();
        } else {
            $check_user_has_coupon = NULL;
            $has_pending = NULL;
        }
        return view('frontend.course_external_detail', ['course' => $course, 'popular_courses' => $popular_courses, 'check_user_has_coupon' => $check_user_has_coupon, 'has_pending' => $has_pending, 'reviews' => $reviews]);
    }


    //     public function instructor_add(Request $request):RedirectResponse
    //     {
    //         $instructor= new Instructor;
    //         $check_email_exist = Instructor::where('email', '=', $request->email)->first();
    //         if($check_email_exist){
    //             $notification = array(
    //                 'message' => 'You have initially sent application, thank you',
    //                 'alert-type' => 'error'
    //             );
    //             return redirect()->back()->with($notification);
    //         }
    //         $resume = $request->file('resume');
    //         $extension = $resume->getClientOriginalName();
    //         $filename = $extension;
    //         $resume->storeAs( '/resume' , "/" . $request->first_name . "_odumare" . "." .$filename, 'public');
    //         $path = "storage/resume/" . $request->first_name . "_odumare" . "." .$filename;

    //         $instructor->first_name = $request->first_name;
    //         $instructor->last_name= $request->last_name;
    //         $instructor->gender = $request->gender;
    //         $instructor->email = $request->email;
    //         $instructor->career = $request->career;
    //         $instructor->resume= $path;
    //         $instructor->course_ids = $request->course_ids;
    //         $instructor->save();
    //         $notification = array(
    //             'message' => 'Application Successfully sent, we will get back to you shortly',
    //             'alert-type' => 'success'
    //         );

    //         $mailData = [
    //             'name' => $request->last_name
    //         ];
    // //        Mail::to($request->email)->send(new InstructorApply($mailData));

    //         return redirect()->route('home')->with($notification);

    //     }


    public function instructor_add(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:instructors,email',
            'gender' => 'required|string',
            'career_level' => 'required|string',
            'courses' => 'required|array',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle resume upload
        $resume = $request->file('resume');
        $folder = public_path('storage/custom_resumes');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = $request->first_name . "_odumare_" . time() . '.' . $resume->getClientOriginalExtension();
        $resume->move($folder, $filename);
        $resumePath = "storage/custom_resumes/" . $filename;

        // Save instructor
        $instructor = new Instructor();
        $instructor->first_name = $request->first_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->gender = $request->gender;
        $instructor->career = $request->career_level;
        $instructor->course_ids = json_encode($request->courses);
        $instructor->resume = $resumePath;
        $instructor->save();

        $notification = [
            'message' => 'Application successfully submitted!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function corporate_training_store(Request $request)
    {
        $validated = $request->validate([
            'full_name'       => 'required|string|max:100',
            'email'           => 'required|email|max:100',
            'company_name'    => 'required|string|max:100',
            'phone_number'    => 'required|string|max:20',
            'team_size'       => 'required|integer',
            'course_name'     => 'nullable|string|max:100',
            'engagement_type' => 'required|string|max:50',
            'message'         => 'required|string|max:500',
        ]);

        CompanyTraining::create([
            'name'          => $validated['full_name'],
            'email'         => $validated['email'],
            'phone'         => $validated['phone_number'],
            'company_name'  => $validated['company_name'],
            'team_size'     => $validated['team_size'],
            'course_name'   => $validated['course_name'] ?? null,
            'intrested_in'  => $validated['engagement_type'],
            'message'       => $validated['message'],
        ]);

        $notification = [
            'message' => 'Your request has been submitted successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function sell_course_store(Request $request)
{
    try {
        // ✅ Validation
        $validated = $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'required|email|max:150',
            'phone_number' => 'required|string|regex:/^\d{7,15}$/',
            'about'        => 'required|string|max:2000',
            'linkedin'     => 'required|url',
            'course_name'  => 'required|string|max:200',
            'message'      => 'required|string|max:5000',
            'twitter'      => 'nullable|url',
            'instagram'    => 'nullable|url',
            'youtube'      => 'nullable|url',
            'tiktok'       => 'nullable|url',
            'portfolio'    => 'nullable|url',
            'github'       => 'nullable|url',
            'other_work'   => 'nullable|url',
            'sample_link'  => 'nullable|url',
        ]);

        // ✅ Generate Reference ID
        $reference = strtoupper(Str::random(10));

        // ✅ Insert into DB
        DB::table('content_creators')->insert([
            'reference'     => $reference,
            'first_name'    => $validated['first_name'],
            'last_name'     => $validated['last_name'],
            'email'         => $validated['email'],
            'phone_number'  => $validated['phone_number'],
            'about'         => $validated['about'],
            'linkedin'      => $validated['linkedin'],
            'twitter'       => $request->twitter,
            'instagram'     => $request->instagram,
            'youtube'       => $request->youtube,
            'tiktok'        => $request->tiktok,
            'portfolio'     => $request->portfolio,
            'github'        => $request->github,
            'other_work'    => $request->other_work,
            'course_name'   => $validated['course_name'],
            'description'   => $validated['message'],
            'sample_link'   => $request->sample_link,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // ✅ Send confirmation email
        $toEmail = $validated['email'];
        $subject = "We’ve received your course submission";
        $messageBody = "Hello {$validated['first_name']},\n\n"
            . "Thank you for your interest in joining our instructor program. "
            . "We’ve successfully received your course proposal titled \"{$validated['course_name']}\".\n\n"
            . "Our team will review your submission and reach out soon.\n\n"
            . "Your reference ID is: {$reference}\n\n"
            . "Best regards,\n"
            . "OdumareTech Team";

        try{
            Mail::raw($messageBody, function ($message) use ($toEmail, $subject) {
                $message->to($toEmail)
                        ->subject($subject)
                        ->from('noreply@yourdomain.com', 'OdumareTech Team');
            });
    
        }catch(\Throwable $e){


        }
        // ✅ Notification
        $notification = [
            'message' => 'Application successfully submitted! Reference: ' . $reference,
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        $notification = [
            'message' => 'Something went wrong, please try again later.',
            'alert-type' => 'error'
        ];
        return redirect()->back()->with($notification);
    }
}


    public function cookie_store(Request $request)
    {
        // Basic validation
        $data = $request->validate([
            'accepted' => 'required|boolean',
            'page' => 'nullable|string|max:2048',
            'referrer' => 'nullable|string|max:2048',
            'device_info' => 'nullable|array',
        ]);

        // Capture server-side details
        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $consent = CookieConsent::create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'accepted' => (bool) $data['accepted'],
            'page' => $data['page'] ?? null,
            'referrer' => $data['referrer'] ?? null,
            'device_info' => $data['device_info'] ?? null,
            'session_id' => session()->getId() ?? Str::random(16),
        ]);

        return response()->json([
            'success' => true,
            'id' => $consent->id
        ]);
    }


    public function store_master(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone_number' => 'required|string|max:50',
            'interested_skill' => 'required|string|max:50',
            'gender' => 'required|string|max:50',
            'career_level' => 'required|string|max:50',
            'location' => 'required|string|max:50',
        ]);

        // Save to database
        MasterClass::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone'        => $request->phone_number,
            'intrested_in' => $request->interested_skill,
            'gender'       => $request->gender,
            'career'       => $request->career_level,
            'location'     => $request->location,
        ]);


        $masterclass_link = MasterClassLink::first();

        $htmlContent = '
<div  style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border-radius:20px; background-color:#EDE9E8; box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 48px; color:black; ">
    <div style="text-align:center">
    <img style="width:200px; height:80px; border-radius:10px;" src="https://odumaretech.com/logo.png"/>
    </div>
    
    <p>Congratulations! You have been exclusively selected to join our upcoming webinar at OdumareTech. We\'re excited to have you on board for this special event!</p>
    <p>The webinar will take place on <span style="font-weight:700;">' . $masterclass_link->date . '</span> at <span style="font-weight:700;">' . $masterclass_link->time . ' WAT</span>. We have prepared an insightful session on <span style="font-weight:700;">' . $masterclass_link->title . '</span> that will empower you with valuable knowledge and practical insights.</p>
    <p>
        To access the webinar, simply click on the personalized link provided below:<br>
        ' . $masterclass_link->link . '
    </p>
    
    <p>
        We encourage you to mark your calendar and join us promptly to make the most of this unique learning opportunity.<br><br>

        Should you have any questions or require assistance, please don\'t hesitate to reach out to us. We are here to support you.<br><br>

        Thank you for being a valued part of our community, and we look forward to your active participation in the webinar!
    </p>
    <p>Best regards,<br>OdumareTech</p>
</div>
';

        Mail::send([], [], function ($message) use ($request, $htmlContent) {
            $message->to($request->email)
                ->subject('Your Masterclass Access')
                ->html($htmlContent);
        });

        $notification = [
            'message' => 'Registration successful, please check your email for the masterclass link',
            'alert-type' => 'success'
        ];



        return redirect()->back()->with($notification);
    }
}
