<?php

namespace App\Http\Controllers;

use App\Mail\InstructorApply;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Innovation;
use App\Models\Instructor;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return view('frontend.courses');
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
        return view('frontend.course_detail');
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
        return view('frontend.marketplace');
    }
    public function course_list():View{
        return view('frontend.course_list');
    }
    public function course_external_detail():View{
        return view('frontend.course_external_detail');
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
