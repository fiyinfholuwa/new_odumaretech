<?php

namespace App\Http\Controllers;

use App\Mail\InnovationMail;
use App\Models\Blog;
use App\Models\Innovation;
use App\Models\InnovationApply;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InnovationController extends Controller
{
    public function innovation():View{
        $innovations = Innovation::paginate(6);
        return view('frontend.innovation', compact('innovations'));
    }

    public function innovation_apply_view(){
        $innovation_apply= InnovationApply::all();
        return view('admin.innovation_apply', compact('innovation_apply'));
    }
    public function innovation_detail($id){
        $innovation = Innovation::findOrFail($id);
        return view('frontend.innovation_d', compact('innovation'));
    }

    public function blog(){
        $posts = Blog::paginate(6);
        return view('frontend.blog', compact('posts'));
    }

    public function innovation_add(Request $request){
        $check_if_already_apply = InnovationApply::where('topic', '=', $request->topic)->where('email', '=', $request->email)->first();
        if($check_if_already_apply){
            $notification = array(
                'message' => 'you have already applied for this.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $add_inno = new InnovationApply;
        $add_inno->name = $request->name;
        $add_inno->topic = $request->topic;
        $add_inno->email = $request->email;
        $add_inno->gender = $request->github;
        $add_inno->save();

        $mailData = [
            'name' => $request->name
        ];
        Mail::to($request->email)->send(new InnovationMail($mailData));
        $notification = array(
            'message' => 'Application sent Successfully, we will get back to you shortly',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    public function innovation_delete($id)
    {
        $innovation = InnovationApply::findOrFail($id);
        $innovation->delete();
        $notification = array(
            'message' => 'innovation collaborator successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
