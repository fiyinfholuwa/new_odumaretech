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
}
