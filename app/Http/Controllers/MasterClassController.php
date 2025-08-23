<?php

namespace App\Http\Controllers;

use App\Mail\MasterClassMail;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\GitHubLink;
use App\Models\MasterClass;
use App\Models\MasterClassLink;
use App\Models\MeetingLink;
use App\Models\RecordLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MasterClassController extends Controller
{
    public function masterclass(){
        return view('frontend.masterclass');
    }
    public function masterclass_link():View{
        $masterclass_link = MasterClassLink::first();
        return view('admin.masterclass_link', compact('masterclass_link'));
    }


    public function github_link():View{
        $github_link = GitHubLink::first();
        return view('admin.github', compact('github_link'));
    }

    public function meeting_link(){
        $courses = Course::all();
        $cohorts = Cohort::all();
        $meeting_link =  DB::table('meeting_links')
            ->join('courses', 'meeting_links.course_id', '=', 'courses.id')
            ->select('meeting_links.*', 'courses.title')
            ->get();
        return view('admin.meeting_link', compact('meeting_link','courses'));
    }


    public function record_link(){
        $courses = Course::all();
        $record_link = DB::table('record_links')
            ->join('courses', 'record_links.course_id', '=', 'courses.id')
            ->leftJoin('cohorts', 'record_links.cohort_id', '=', 'cohorts.id')
            ->select('record_links.*', 'courses.title', 'cohorts.name')
            ->get();
        $cohorts = Cohort::all();
        return view('admin.record_link', compact('record_link', 'courses', 'cohorts'));

    }

    public function record_link_edit($id){
        $courses = Course::all();
        $cohorts = Cohort::all();
        $record = RecordLink::findOrFail($id);
        $record_link = DB::table('record_links')
            ->join('courses', 'record_links.course_id', '=', 'courses.id')
            ->leftJoin('cohorts', 'record_links.cohort_id', '=', 'cohorts.id')
            ->select('record_links.*', 'courses.title', 'cohorts.name')
            ->get();
        return view('admin.record_link_edit', compact('record_link', 'courses', 'record', 'cohorts'));

    }


    public function meeting_link_edit($id){
        $courses = Course::all();
        $meeting = MeetingLink::findOrFail($id);
        $meeting_link = DB::table('meeting_links')
            ->join('courses', 'meeting_links.course_id', '=', 'courses.id')
            ->select('meeting_links.*', 'courses.title')
            ->get();
        return view('admin.meeting_link_edit', compact('meeting_link', 'courses', 'meeting'));

    }



    public function record_link_delete($id){
        RecordLink::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Record Link Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function meeting_link_delete($id){
        MeetingLink::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Meeting Link Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function masterclass_link_add(Request $request, $id=null): RedirectResponse
{
    // ✅ Validation
    $request->validate([
        'link'    => 'required|string',
        'date'    => 'required|date',
        'time'    => 'required',
        'title'   => 'required|string',
        'visible' => 'required',
        'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional
    ]);

    if ($request->id == null || $request->id == "") {
        $masterclass_link = new MasterClassLink;
    } else {
        $masterclass_link = MasterClassLink::findOrFail($request->id);
    }

    $masterclass_link->link = $request->link;
    $masterclass_link->date = $request->date;
    $masterclass_link->time = $request->time;
    $masterclass_link->title = $request->title;
    $masterclass_link->visible = $request->visible;
    $masterclass_link->text_body = $request->text_body;

    // ✅ File upload handling
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $destinationPath = public_path('uploads/masterclass');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $filename);
        $masterclass_link->image = 'uploads/masterclass/'.$filename;
    }

    $masterclass_link->save();

    $notification = [
        'message' => $request->id ? 'MasterClass Link Successfully updated' : 'MasterClass Link Successfully saved',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);
}

    public function github_link_add(Request $request, $id=null):RedirectResponse{
        if($request->id ==null || $request->id ==""){
            $github_link = new GitHubLink;
            $github_link->link = $request->link;
            $github_link->save();
            $notification = array(
                'message' => 'GitHub Link Sucessfully saved',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $update_link =  GitHubLink::findOrFail($request->id);
            $update_link->link = $request->link;
            $update_link->save();
            $notification = array(
                'message' => 'Github Link Sucessfully updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function masterclass_manage(Request $request, $id):RedirectResponse{

        $update_link =  MasterClassLink::findOrFail($id);
        $update_link->visible = $request->status;
        $update_link->save();
        $notification = array(
            'message' => 'Master Class Sucessfully updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function meeting_link_add(Request $request){
        $meeting_link = new MeetingLink;
        $meeting_link->link = $request->link;
        $meeting_link->meeting_title = $request->meeting_title;
        $meeting_link->course_id = $request->course_id;
        $meeting_link->save();
        $notification = array(
            'message' => 'Meeting Link Sucessfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function record_link_add(Request $request, $id=null){
        $record_link = new RecordLink;
        $record_link->link = $request->link;
        $record_link->record_title = "record";
        $record_link->course_id = $request->course_id;
        $record_link->cohort_id = $request->cohort_id;
        $record_link->save();
        $notification = array(
            'message' => 'Record Link Sucessfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }


    public function record_link_update(Request $request, $id){
        $record_link =  RecordLink::findOrFail($id);
        $record_link->link = $request->link;
        $record_link->record_title = "record";
        $record_link->course_id = $request->course_id;
        $record_link->cohort_id = $request->cohort_id;
        $record_link->save();
        $notification = array(
            'message' => 'Record Link Sucessfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('record.link')->with($notification);

    }

    public function meeting_link_update(Request $request, $id){
        $meeting_link =  MeetingLink::findOrFail($id);
        $meeting_link->link = $request->link;
        $meeting_link->course_id = $request->course_id;
        $meeting_link->meeting_title = $request->meeting_title;
        $meeting_link->save();
        $notification = array(
            'message' => 'Meeting Link Sucessfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('meeting.link')->with($notification);

    }



    public function masterclass_add(Request $request){
        $masterclass = new MasterClass;

        $check_if_email_exist = MasterClass::where('email', '=', $request->email)->first();
        if($check_if_email_exist){
            $notification = array(
                'message' => 'This email has been previously registered',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        $masterclass->first_name = $request->first_name;
        $masterclass->last_name = $request->last_name;
        $masterclass->intrested_in = $request->intrested_in;
        $masterclass->gender = $request->gender;
        $masterclass->phone = $request->phone;
        $masterclass->career = $request->career;
        $masterclass->location = $request->location;
        $masterclass->email = $request->email;
        $masterclass->save();

        $masterclass_link = MasterClassLink::first();
        $mailData = [
            'meeting_link' => $masterclass_link->link,
            'date' => $masterclass_link->date,
            'time' => $masterclass_link->time,
            'title' => $masterclass_link->title
        ];
        Mail::to($request->email)->send(new MasterClassMail($mailData));
        $notification = array(
            'message' => 'registeration successful, please check your email for the masterclass link',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);
    }

    public function masterclass_all(){
        $attendees = MasterClass::all();
        return view('admin.masterclass_all', compact('attendees'));
    }
}
