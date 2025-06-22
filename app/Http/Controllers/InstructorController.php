<?php

namespace App\Http\Controllers;

use App\Mail\CourseCompletionMail;
use App\Models\AppliedCourse;
use App\Models\ApprovedInstructor;
use App\Models\Assignment;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\FinalProject;
use App\Models\GitHubLink;
use App\Models\InstructorChat;
use App\Models\InstructorNotification;
use App\Models\LiveSession;
use App\Models\MeetingLink;
use App\Models\RecordLink;
use App\Models\Slide;
use App\Models\SubmitAssignment;
use App\Models\SubmitProject;
use App\Models\User;
use App\Models\UserChat;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Mail;

class InstructorController extends Controller
{
    public function slide_view(){
        $courses = $this->get_instructor_courses();
        $cohorts= Cohort::all();
        return view('instructor.slide_view', compact('courses', 'cohorts'));
    }

    public function slide_add(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'course_id' => 'required|exists:courses,id',
        'image' => 'required|file|mimes:pdf,ppt,pptx,docx',
        'cohort_id' => 'required|array',
    ]);

    $slide = new Slide;

    $file = $request->file('image');
    $extension = $file->getClientOriginalExtension();
    $file_unique_name = uniqid() . "_odumaretech." . $extension;

    $destinationPath = public_path('slide');

    // ✅ Create folder if it doesn't exist
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // ✅ Move file to /public/slide
    $file->move($destinationPath, $file_unique_name);

    $slide->course_id = $request->course_id;
    $slide->title = $request->title;
    $slide->status = "pending";
    $slide->image = "slide/" . $file_unique_name; // relative path from public/
    $slide->cohort_id = json_encode($request->cohort_id); // assuming column is text or json

    $slide->save();

    return redirect()->back()->with([
        'message' => 'Slide saved to draft',
        'alert-type' => 'success'
    ]);
}

    public function slide_all(){
        $slides = Slide::all();
        return view('instructor.slide_all', compact('slides'));
    }

    public function slide_delete(Request $request, $id){
        $slide =  Slide::findOrFail($id);
        $filePath = $slide->image;
        File::delete(public_path($filePath));
        $slide->delete();
         $notification = array(
             'message' => 'Slide Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function slide_edit($id){
        $courses = $this->get_instructor_courses();
        $cohorts= Cohort::all();
        $slide = Slide::findOrFail($id);
        return view('instructor.slide_edit', compact('slide', 'courses', 'cohorts'));
    }

    public function slide_update(Request $request, $id)
{
    $slide_update = Slide::findOrFail($id);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $file_unique_name = uniqid();
        $extension = $image->getClientOriginalExtension();
        $filename = $file_unique_name . "_odumaretech." . $extension;

        // Make directory if not exists
        $folder = public_path('storage/slide');
        if (File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $image->move($folder, $filename);
        $path = "storage/slide/" . $filename;
    } else {
        $path = $slide_update->image;
    }

    $slide_update->course_id = $request->course_id;
    $slide_update->title = $request->title;
    $slide_update->status = $request->status;
    $slide_update->image = $path;
    $slide_update->cohort_id = $request->cohort_id;
    $slide_update->save();

    $notification = [
        'message' => 'Slide Successfully updated',
        'alert-type' => 'success'
    ];

    return redirect()->route('slide.all')->with($notification);
}


    public function assignment_view(){
        $cohorts= Cohort::all();
        $courses = $this->get_instructor_courses();
        return view('instructor.assignment_view', compact('courses', 'cohorts'));
    }

    public function assignment_add(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'course_id' => 'required|exists:courses,id',
        'description' => 'nullable|string',
        'cohort_id' => 'required|array',
        'image' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:5120',
    ]);

    $path = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $uniqueName = uniqid() . "_odumaretech." . $extension;

        $destinationPath = public_path('assignment');

        // Create folder if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Move file to /public/assignment
        $file->move($destinationPath, $uniqueName);

        $path = 'assignment/' . $uniqueName; // Relative to public
    }

    $new_assignment = new Assignment;
    $new_assignment->course_id = $request->course_id;
    $new_assignment->title = $request->title;
    $new_assignment->image = $path;
    $new_assignment->status = 'pending';
    $new_assignment->description = $request->description;

    $new_assignment->cohort_id = json_encode($request->cohort_id);

    $new_assignment->save();

    return redirect()->back()->with([
        'message' => 'Assignment saved to draft',
        'alert-type' => 'success'
    ]);
}

    public function assignment_all(){
        $assignments = Assignment::all();
        return view('instructor.assignment_all', compact('assignments'));
    }

    public function assignment_delete(Request $request, $id){
        $assignment =  Assignment::findOrFail($id);
        $assignment->delete();
         $notification = array(
             'message' => 'Assignment Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function assignment_edit($id){
        $courses = $this->get_instructor_courses();
        $cohorts= Cohort::all();
        $assignment = Assignment::findOrFail($id);
        return view('instructor.assignment_edit', compact('assignment', 'courses','cohorts'));
    }

    public function assignment_update(Request $request, $id)
    {
        $ass_update = Assignment::findOrFail($id);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $file_unique_name = uniqid();
            $filename = $file_unique_name . "_odumaretech_" . $originalName;
    
            $destination = public_path('assignment');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
    
            $image->move($destination, $filename);
            $path = 'assignment/' . $filename;
        } else {
            $path = $ass_update->image;
        }
    
        $ass_update->course_id = $request->course_id;
        $ass_update->title = $request->title;
        $ass_update->status = $request->status;
        $ass_update->cohort_id = json_encode($request->cohort_id); // ✅ store array safely
        $ass_update->image = $path;
        $ass_update->description = $request->description;
        $ass_update->save();
    
        return redirect()->route('assignment.all')->with([
            'message' => 'Assignment Successfully updated',
            'alert-type' => 'success'
        ]);
    }
    

    public function session_view(){
        $cohorts= Cohort::all();
        $courses = $this->get_instructor_courses();
        return view('instructor.session_view', compact('courses', 'cohorts'));
    }

    public function session_add(Request $request)
{
    // Validate input (optional but recommended)
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'cohort_ids' => 'required|array|min:1',
        'cohort_ids.*' => 'exists:cohorts,id'
    ]);

    $new_session = new LiveSession();
    $new_session->course_id = $request->course_id;
    $new_session->title = $request->title;
    $new_session->status = 'pending';
    $new_session->description = $request->description;
    $new_session->time = $request->date;

    // Save the cohort IDs as JSON
    $new_session->cohort_id = json_encode($request->cohort_ids);

    $new_session->save();

    $notification = [
        'message' => 'Session saved to draft',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);
}

    public function session_all(){
        $cohorts = Cohort::all()->keyBy('id'); // Now accessible like $cohorts[123]
        $sessions = LiveSession::all();
        return view('instructor.session_all', compact('sessions', 'cohorts'));
    }

    public function session_delete(Request $request, $id){
        $session =  LiveSession::findOrFail($id);
        $session->delete();
         $notification = array(
             'message' => 'Session Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function session_edit($id){
        $courses = $this->get_instructor_courses();
        $session = LiveSession::findOrFail($id);
        $cohorts= Cohort::all();
        return view('instructor.session_edit', compact('session', 'courses', 'cohorts'));
    }

    public function session_update(Request $request, $id){
        $ss_update = LiveSession::findOrFail($id);

        $ss_update->course_id = $request->course_id;
        $ss_update->title = $request->title;
        $ss_update->status = $request->status;
        $ss_update->description = $request->description;
        $ss_update->time = $request->date;
        $ss_update->cohort_id = $request->cohort_id;
        $ss_update->save();
        $notification = array(
            'message' => 'Session Successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('session.all.instructor')->with($notification);
    }

    public function notification_view(){
        $courses = $this->get_instructor_courses();
        $cohorts= Cohort::all();
        return view('instructor.notification_view', compact('courses', 'cohorts'));
    }

    public function notification_add(Request $request)
{
    $request->validate([
        'course_id'   => 'required|integer',
        'title'       => 'required|string|max:255',
        'cohort_id'   => 'required|array',
        'description' => 'nullable|string',
    ]);

    $new_not = new InstructorNotification;
    $new_not->course_id   = $request->course_id;
    $new_not->title       = $request->title;
    $new_not->status      = "pending";
    $new_not->cohort_id   = json_encode($request->cohort_id); // Store as JSON array
    $new_not->description = $request->description;
    $new_not->save();

    return redirect()->back()->with([
        'message'     => 'Notification saved to draft for selected cohorts.',
        'alert-type'  => 'success',
    ]);
}


public function notification_all()
{
    $notifications = InstructorNotification::with('course_name')->latest()->get(); // optional eager loading
    $cohorts = \App\Models\Cohort::pluck('name', 'id')->toArray(); // [id => name]

    return view('instructor.notification_all', compact('notifications', 'cohorts'));
}


    public function notification_delete(Request $request, $id){
        $notify =  InstructorNotification::findOrFail($id);
        $notify->delete();
         $notification = array(
             'message' => 'Notification Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

    public function notification_edit($id){
        $courses = $this->get_instructor_courses();
        $notification = InstructorNotification::findOrFail($id);
        $cohorts= Cohort::all();
        return view('instructor.notification_edit', compact('notification', 'courses', 'cohorts'));
    }

    public function notification_update(Request $request, $id)
{
    $request->validate([
        'course_id'   => 'required|integer',
        'title'       => 'required|string|max:255',
        'status'      => 'required|in:pending,active',
        'cohort_id'   => 'required|array',
        'description' => 'nullable|string',
    ]);

    $not_update = InstructorNotification::findOrFail($id);
    $not_update->course_id   = $request->course_id;
    $not_update->title       = $request->title;
    $not_update->status      = $request->status;
    $not_update->cohort_id   = json_encode($request->cohort_id); // ✅ Store as JSON
    $not_update->description = $request->description;
    $not_update->save();

    $notification = [
        'message' => 'Notification successfully updated',
        'alert-type' => 'success'
    ];

    return redirect()->route('notification.all.instructor')->with($notification);
}

    public function assignment_instructor_grade(Request $request, $id){
        $assignment = SubmitAssignment::findOrFail($id);
        $assignment->status_in = $request->score;
        $assignment->review = $request->review;
        $assignment->status = "graded";
        $assignment->save();
        $notification = array(
            'message' => 'Assignment Successfully graded',
            'alert-type' => 'success'
        );
        return redirect()->route('assignment.submitted.review')->with($notification);
    }


    public function project_instructor_grade(Request $request, $id){
        $assignment = SubmitProject::findOrFail($id);
        $assignment->status_in = $request->score;
        $assignment->status = "graded";
        $assignment->save();

        $course_detail = Course::where('id', '=', $assignment->course_id)->first();
        $course_name = $course_detail->title;
        $user_detail = User::where('id', '=', $assignment->user_id)->first();
        $user_name = $user_detail->first_name;
        $user_email = $user_detail->email;
        $update_user =  AppliedCourse::where('user_id', '=', $assignment->user_id)->where('course_id','=', $assignment->course_id)->first();

        $update_user->update(['status' => "completed"]);

        $mailData = [
            'name' => $user_name,
            'course' => $course_name,
        ];
        Mail::to($user_email)->send(new CourseCompletionMail($mailData));
        $notification = array(
            'message' => 'Project Successfully graded',
            'alert-type' => 'success'
        );
        return redirect()->route('project.submitted.review')->with($notification);
    }


    public function assess_submitted_assignment(){
            $courseIds = $this->get_instructor_courses_id();
            $assignments = SubmitAssignment::whereIn('course_id', $courseIds)->get();
            return view('instructor.submitted_assignment', compact('assignments'));
    }


    public function assess_submitted_project(){
        $courseIds = $this->get_instructor_courses_id();
        $assignments = SubmitProject::whereIn('course_id', $courseIds)->get();
        return view('instructor.submitted_project', compact('assignments'));
}

public function view_submitted_project($id){
    $assignment = SubmitProject::findOrFail($id);
    return view('instructor.project_review', compact('assignment'));
}

    public function view_submitted_assignment($id){
        $assignment = SubmitAssignment::findOrFail($id);
        return view('instructor.assignment_review', compact('assignment'));
    }



    public function get_instructor_courses(){
        $fetch_instructor_detail = ApprovedInstructor::where('user_id', '=', Auth::user()->id)->first();
        $course_ids = json_decode($fetch_instructor_detail->course_ids,true);
        $courses = Course::whereIn('id', array_map('intval', $course_ids))
        ->select('id', 'title')
        ->get();
        return $courses;
    }

    public function get_instructor_courses_id(){
        $fetch_instructor_detail = ApprovedInstructor::where('user_id', '=', Auth::user()->id)->first();
        $course_ids = json_decode($fetch_instructor_detail->course_ids,true);
        $courses = Course::whereIn('id', array_map('intval', $course_ids))
        ->select('id')
        ->get();
        return $courses;
    }

    public function instructor_chat_view(){
        $chats = InstructorChat::where('user_id', '=', Auth::user()->id)->get();
        return view('instructor.instructor_chat', ['chats' => $chats]);
    }

    public function instructor_chat_add(Request $request){
        $chat = new InstructorChat;
        $chat->user_id = Auth::user()->id;
        $chat->name = Auth::user()->first_name . " " . Auth::user()->last_name;
        $chat->instructor_message = $request->message;
        $chat->admin_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message sent to Admin',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function instructor_chat_all(){
        $chats = InstructorChat::where('user_id', '=', Auth::user()->id)->get();
        return view('instructor.chat_all', compact('chats'));
    }

    public function student_chat_all(){
        $user_id = Auth::user()->id;
        $instructor = ApprovedInstructor::where('user_id', '=', $user_id)->first();
        $course_ids = $instructor->course_ids;
        $chats = UserChat::whereIn('course_id', $course_ids)->get();
        return view('instructor.chat_student', compact('chats'));
    }

    public function student_user_chat_reply($id){
        $chat = UserChat::findOrFail($id);
        return view('instructor.student_chat_reply', compact('chat'));
    }

    public function instructor_chat_replied(Request $request, $id){
        $chat = UserChat::findOrFail($id);
        $chat->instructor_message = $request->message;
        $chat->instructor_status = "replied";
        $chat->save();
        $notification = array(
            'message' => 'Message replied',
            'alert-type' => 'success'
        );
        return redirect()->route('student.chat')->with($notification);
    }


    public function instructor_chat_reply($id){
        $chat = InstructorChat::findOrFail($id);
        $chat->instructor_status = "viewed";
        $chat->save();
        return view('instructor.chat_reply', compact('chat'));
    }

    public function instructor_student_chat_reply($id){
        $chat = UserChat::findOrFail($id);
        return view('instructor.student_chat_reply', compact('chat'));
    }

    public function instructor_student_chat_reply_add(Request $request, $id){
        $chat = UserChat::findOrFail($id);
        $chat->instructor_message = $request->message;
        $chat->instructor_status = "replied";
        $chat->user_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message replied',
            'alert-type' => 'success'
        );
        return redirect()->route('student.chat')->with($notification);
    }

    public function instructor_github(){
        $github = GitHubLink::first();
        return view('instructor.github', compact('github'));
    }

    public function instructor_record(){
        $courseIds = $this->get_instructor_courses_id();
        $records = RecordLink::whereIn('course_id', $courseIds)->get();
        return view('instructor.record', compact('records'));
    }

    public function instructor_meeting(){
        $courseIds = $this->get_instructor_courses_id();
        $meetings = MeetingLink::whereIn('course_id', $courseIds)->get();
        return view('instructor.meeting', compact('meetings'));
    }


    public function instructor_password_view(){
        return view('instructor.change_password');
    }

    public function instructor_password_change(Request $request){
    $user = Auth::user();
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    if (Hash::check($request->old_password, $user->password)) {
        $user->password = Hash::make($request->new_password);
        $user->save();
        $notification = array(
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }else{
        $notification = array(
            'message' => 'Incorrect Password, Please try again.',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

}

public function project_final_view(){
    $courses = $this->get_instructor_courses();
    $cohorts = Cohort::all();
    return view('instructor.project', compact( 'courses', 'cohorts'));
}

public function project_edit_final($id){
    $courses = $this->get_instructor_courses();
    $cohorts = Cohort::all();
    $project = FinalProject::findOrFail($id);
    return view('instructor.project_edit', compact( 'courses', 'cohorts','project'));
}

public function project_final_all(){
        $courseIds = $this->get_instructor_courses_id();
        $projects = FinalProject::whereIn('course_id', $courseIds)->get();
        $cohorts = \App\Models\Cohort::pluck('name', 'id')->toArray();

        return view('instructor.project_all', compact('projects','cohorts'));
}

public function project_final_add(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'course_id'   => 'required|integer',
        'cohort_id'   => 'required|array',
        'description' => 'nullable|string',
        'image'       => 'required|file|mimes:jpg,jpeg,png,pdf,docx|max:5120',
    ]);

    // Create custom folder in public/
    $customFolder = public_path('project_files');
    if (!file_exists($customFolder)) {
        mkdir($customFolder, 0755, true);
    }

    // Handle file upload
    $image = $request->file('image');
    $originalExtension = $image->getClientOriginalExtension();
    $uniqueFilename = uniqid() . '_odumaretech.' . $originalExtension;
    $image->move($customFolder, $uniqueFilename);

    $filePath = 'project_files/' . $uniqueFilename; // Relative path for public access

    // Save a single project with JSON cohort_id
    $project = new FinalProject;
    $project->course_id   = $request->course_id;
    $project->cohort_id   = json_encode($request->cohort_id); // ✅ JSON
    $project->title       = $request->title;
    $project->status      = 'pending';
    $project->image       = $filePath;
    $project->description = $request->description;
    $project->save();

    return redirect()->back()->with([
        'message' => 'Project successfully saved with multiple cohorts!',
        'alert-type' => 'success'
    ]);
}


public function project_update(Request $request, $id)
{
    $project_update = FinalProject::findOrFail($id);

    // Define the custom path relative to /public
    $customPublicFolder = public_path('project');

    // Ensure the folder exists
    if (!file_exists($customPublicFolder)) {
        mkdir($customPublicFolder, 0755, true);
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $originalName = $image->getClientOriginalName();
        $fileUniqueName = uniqid() . "_odumaretech_" . $originalName;
        
        // Move the file to the public/project directory
        $image->move($customPublicFolder, $fileUniqueName);

        // Save the relative path to DB
        $path = 'project/' . $fileUniqueName;
    } else {
        $path = $project_update->image;
    }

    // Update other fields
    $project_update->course_id = $request->course_id;
    $project_update->cohort_id = json_encode($request->cohort_id);
    $project_update->title = $request->title;
    $project_update->status = $request->status;
    $project_update->image = $path;
    $project_update->description = $request->description;
    $project_update->save();

    $notification = [
        'message' => 'Project Successfully updated',
        'alert-type' => 'success'
    ];

    return redirect()->route('project.final.all')->with($notification);
}

    public function project_delete(Request $request, $id){
        $project =  FinalProject::findOrFail($id);
        $filePath = $project->image;
        File::delete(public_path($filePath));
        $project->delete();
         $notification = array(
             'message' => 'Project Successfully Deleted',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }

}
