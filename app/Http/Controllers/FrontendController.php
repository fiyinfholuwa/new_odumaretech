<?php

namespace App\Http\Controllers;

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
}
