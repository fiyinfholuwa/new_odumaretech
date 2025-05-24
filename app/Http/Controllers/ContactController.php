<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(){
        return view('frontend.contact');
    }
    public function contact_save(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $add_message = new Contact;
        $add_message->name = $request->name;
        $add_message->email = $request->email;
        $add_message->phone = $request->phone;
        $add_message->subject = $request->subject;
        $add_message->message= $request->message;
        $add_message->save();
        $notification = array(
            'message' => 'Message sent Successfully, we will get back to you shortly',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function get_all_message(){
        $all_messages = Contact::all();
        return view('admin.contact', compact('all_messages'));
    }

    public function message_delete($id){
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Message Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
