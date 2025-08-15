<?php

namespace App\Http\Controllers;

use App\Mail\InstructorApply;
use App\Models\AppliedCourse;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\Coupon;
use App\Models\CouponUsed;
use App\Models\Course;
use App\Models\Innovation;
use App\Models\Instructor;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home():View{

        $popular_courses = Course::with('cat')->paginate(3);
        $testimonials= Testimonial::paginate(8);
        $innovations= Innovation::paginate(3);
        return view('frontend.home',['popular_courses'=> $popular_courses,'testimonials' => $testimonials,'innovations'=>$innovations]);
    }

    public function courses():View{
        $popular_courses = Course::with('cat')->paginate(4);
        $testimonials= Testimonial::paginate(8);
        return view('frontend.courses', ['courses'=> $popular_courses,'testimonials' => $testimonials]);
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

        $blogs = $query->paginate(6)->withQueryString();
        return view('frontend.blog', ['blogs' => $blogs]);
    }


    public function about():View{
        return view('frontend.about');
    }
    public function faq():View{
        return view('frontend.faq');
    }
    public function contact():View{
        return view('frontend.contact');
    }
    public function career():View{
        $courses = Course::all();
        return view('frontend.career', ['courses' => $courses]);
    }
    public function course_detail($name):View{
        $popular_courses = Course::with('cat')->paginate(3);

        $course = Course::with('cat')->where('course_url', $name)->first();

        if(Auth::check()){
            $check_user_has_coupon = CouponUsed::where('user_id', '=', Auth::user()->id)->where('course_id','=', $course->id)->first();
            $has_pending = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)
                ->where('status' , '=' , "pending")->first();
        }else{
            $check_user_has_coupon = NULL;
            $has_pending = NULL;
        }
        $cohort_name = Cohort::where('id', $course->cohort)->first();
        $coupon_check = Coupon::where('course_id', '=', $course->id)->first();
        return view('frontend.course_detail', ['course' => $course, 'courses' => $popular_courses, 'check_user_has_coupon' => $check_user_has_coupon, 'has_pending' => $has_pending, 'cohort_name' => $cohort_name]);
    }
    public function innovation():View{
        return view('frontend.innovation');
    }
    public function masterclass():View{
        return view('frontend.masterclass');
    }
    public function hire_grad():View{
        return view('frontend.hire_grad');
    }
    public function privacy():View{
        return view('frontend.privacy');
    }
    public function terms():View{
        return view('frontend.terms');
    }
    public function community():View{
        return view('frontend.community');
    }
    public function hire():View{
        return view('frontend.hire');
    }
    public function consultation():View{
        return view('frontend.consultation');
    }
    public function corporate_training():View{
        return view('frontend.corporate_training');
    }
    public function marketplace():View{

        $ext_courses  = Course::where('course_type', 'external')->count();
        $ext_instructor = User::where('user_type', 'external_instructor')->count();
        $student = User::where('user_type', 'user')->count();
        $best_selling = Course::with('cat')
        ->where('course_type', 'external')
        ->orderBy('student_count', 'desc')
        ->take(8)
        ->get();
            $featured_courses  = Course::with('cat')->where('course_type', 'external')->get();
        $external_instructor = User::where('user_type', 'external_instructor')
    ->orderBy('student_count', 'desc')
    ->limit(8)
    ->get();

            $categories = Category::withCount('courses')->get();
        $formatted = $categories->map(function ($cat) {
            return [
                'name' => $cat->name,
                'courses' => $cat->courses_count
            ];
        })->toArray();
        
        
        return view('frontend.marketplace',[
            'ext_courses' => $ext_courses,
            'ext_instructor' => $ext_instructor,
            'student' =>$student,
            'featured_courses' => $featured_courses,
            'instructors' => $external_instructor,
            'best_selling' => $best_selling,
            'categories' => $formatted
        ]);
    }
    public function course_list():View{
        $courses  = Course::with('cat')->where('course_type', 'external')->get();

        return view('frontend.course_list', ['courses' => $courses]);
    }
    public function course_external_detail($name):View{
        $popular_courses = Course::with('cat')->where('course_type', 'external')->paginate(4);

        $course = Course::with('cat')->where('course_url', $name)->first();

        if(Auth::check()){
            $check_user_has_coupon = CouponUsed::where('user_id', '=', Auth::user()->id)->where('course_id','=', $course->id)->first();
            $has_pending = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)
                ->where('status' , '=' , "pending")->first();
        }else{
            $check_user_has_coupon = NULL;
            $has_pending = NULL;
        }
        return view('frontend.course_external_detail', ['course' => $course, 'popular_courses' => $popular_courses, 'check_user_has_coupon' => $check_user_has_coupon, 'has_pending' => $has_pending]);
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


}
