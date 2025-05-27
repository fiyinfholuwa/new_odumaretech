<?php

namespace App\Http\Controllers;

use App\Mail\InstructorApply;
use App\Models\Instructor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home():View{
        return view('frontend.home');
    }

    public function courses():View{
        return view('frontend.courses');
    }
    public function blog():View{
        return view('frontend.blog');
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
        return view('frontend.career');
    }
    public function course_detail():View{
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


    public function instructor_add(Request $request):RedirectResponse
    {
        $instructor= new Instructor;
        $check_email_exist = Instructor::where('email', '=', $request->email)->first();
        if($check_email_exist){
            $notification = array(
                'message' => 'You have initially sent application, thank you',
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
//        Mail::to($request->email)->send(new InstructorApply($mailData));

        return redirect()->route('home')->with($notification);

    }

}
