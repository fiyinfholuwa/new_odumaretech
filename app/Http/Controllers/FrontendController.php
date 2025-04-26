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
}
