<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AppliedCourse;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\FinalProject;
use App\Models\GitHubLink;
use App\Models\InstructorNotification;
use App\Models\LiveSession;
use App\Models\PayoutRequest;
use App\Models\RecordLink;
use App\Models\ReferralBonusHistory;
use App\Models\Slide;
use App\Models\SubmitAssignment;
use App\Models\SubmitProject;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use App\Models\UserAchievement;
use App\Models\UserChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF; // 👈 this is what you meant by use PDF;

class UserController extends Controller
{
    public function resource_view(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.resource_view', compact('fetch_user_details'));
    }

    public function resource_detail($id, $co){
        $course_title = Course::where('id', '=', $id)->first();
        $resources = Slide::where('course_id', '=', $id)->whereJsonContains('cohort_id', [$co])
            ->where('status', 'active')
            ->get();
        return view('user.resource_detail', compact('resources', 'course_title'));
    }


    public function course_active(){
        $courses= $this->user_info_pending();
        return view('user.course_active', compact('courses'));
    }

    public function course_complete(){
        $courses= $this->user_info_complete();
        return view('user.course_complete', compact('courses'));
    }

    public function session_view(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.session_view', compact('fetch_user_details'));
    }

    public function session_all($id, $co){
        $course_title = Course::where('id', '=', $id)->first();
        $sessions = LiveSession::where('course_id', '=', $id)->where('cohort_id', '=', $co)
        ->where('status', '=', 'active')->get();
        return view('user.session_all', compact('sessions', 'course_title'));
    }

    public function notification_view(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.notification_view', compact('fetch_user_details'));
    }


    public function record_user_view(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.record_view', compact('fetch_user_details'));
    }


    public function assignment_view_user(){
        $fetch_user_details = $this->user_info_pending();
        return view('user.assignment_view', compact('fetch_user_details'));
    }

    public function project_view_user(){
        $fetch_user_details = $this->user_info_pending();
        $projects = FinalProject::all();
        return view('user.project_view', compact('fetch_user_details', 'projects'));
    }

    public function project_submit($id, $co){
        $course_id = $id;
        $cohort_id = $co;
        $project = FinalProject::where('course_id', $course_id)
        ->whereJsonContains('cohort_id', $co)
        ->first();
    return view('user.project_submit', compact('project'));
    }

    public function project_submit_user(Request $request, $id){

        $check_project = FinalProject::where('id', '=', $id)->first();
        $course_id = $check_project->course_id;
        $assignment_id = $check_project->id;
        $check_project_submitted = SubmitProject::where('course_id', '=', $course_id)->where('assessment_id', '=', $assignment_id)
        ->where('status', '=', "pending")->where('user_id', '=', Auth::user()->id)->first();

        $check_graded_project = SubmitProject::where('course_id', '=', $course_id)->where('assessment_id', '=', $assignment_id)
        ->where('status', '=', "graded")->where('user_id', '=', Auth::user()->id)->first();

        if($check_graded_project){
            $notification = array(
                'message' => 'Project has already been graded',
                'alert-type' => 'error'
            );
            return redirect()->route('project.submitted.user')->with($notification);
        }

        if(!$check_project_submitted){
            $submit = new SubmitProject;
            if($request->hasfile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalName();
                $filename = $extension;
                $file_unique_name = uniqid();
                $image->storeAs( '/project' , "/" . $file_unique_name . "_odumaretech" . "." .$filename, 'public');
                $path = "storage/project/" . $file_unique_name . "_odumaretech" . "." .$filename;
            }else{
                $path = NULL;
            }
            $submit->course_id = $request->course_id;
            $submit->assessment_id = $request->asessement_id;
            $submit->image = $path;
            $submit->link = $request->link;
            $submit->status = "pending";
            $submit->status_in = 0;
            $submit->user_id = Auth::user()->id;
            $submit->save();
            $notification = array(
                'message' => 'Project Submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('project.submitted.user')->with($notification);

        }else{

            $check_project_submitted->delete();
            $submit = new SubmitProject;
            if($request->hasfile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalName();
                $filename = $extension;
                $file_unique_name = uniqid();
                $image->storeAs( '/project' , "/" . $file_unique_name . "_odumaretech" . "." .$filename, 'public');
                $path = "storage/project/" . $file_unique_name . "_odumaretech" . "." .$filename;
            }else{
                $path = NULL;
            }
            $submit->course_id = $request->course_id;
            $submit->assessment_id = $request->assignment_id;
            $submit->image = $path;
            $submit->link = $request->link;
            $submit->status = "pending";
            $submit->status_in = 0;
            $submit->user_id = Auth::user()->id;
            $submit->save();
            $notification = array(
                'message' => 'Project Submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('project.submitted.user')->with($notification);

        }

    }


    public function project_submitted(){
        $assignments = SubmitProject::where('user_id', '=', Auth::user()->id)->get();
        return view('user.submitted_project', compact('assignments'));
    }



    public function notification_all($id,$co){
        $course_title = Course::where('id', '=', $id)->first();
        $notifications = InstructorNotification::where('course_id', '=', $id)->where('cohort_id', '=', $co)
        ->where('status', '=', 'active')->get();
        return view('user.notification_all', compact('notifications', 'course_title'));
    }

    public function assignment_user_all($id, $co){
        $course_title = Course::where('id', '=', $id)->first();
        $assignments = Assignment::where('course_id', $id)
            ->whereJsonContains('cohort_id', [$co])
            ->where('status', 'active')
            ->get();
        return view('user.assignment_all', compact('assignments', 'course_title'));
    }

    public function assignment_submit($id){
        $assignment = Assignment::findOrFail($id);
        return view('user.assignment_submit', compact('assignment'));
    }


    public function assignment_submit_user(Request $request, $id){

        $check_assignment = Assignment::where('id', '=', $id)->first();
        $course_id = $check_assignment->course_id;
        $assignment_id = $check_assignment->id;
        $check_assignment_submitted = SubmitAssignment::where('course_id', '=', $course_id)->where('assessment_id', '=', $assignment_id)
        ->where('status', '=', "pending")->where('user_id', '=', Auth::user()->id)->first();

        $check_graded_assignment = SubmitAssignment::where('course_id', '=', $course_id)->where('assessment_id', '=', $assignment_id)
        ->where('status', '=', "graded")->where('user_id', '=', Auth::user()->id)->first();
        if($check_graded_assignment){
            $notification = array(
                'message' => 'Assignment has already been graded',
                'alert-type' => 'error'
            );
            return redirect()->route('assignment.submitted.user')->with($notification);
        }

        if(!$check_assignment_submitted){
            $submit = new SubmitAssignment;
            if($request->hasfile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalName();
                $filename = $extension;
                $file_unique_name = uniqid();
                $image->storeAs( '/assignment' , "/" . $file_unique_name . "_odumaretech" . "." .$filename, 'public');
                $path = "storage/assignment/" . $file_unique_name . "_odumaretech" . "." .$filename;
            }else{
                $path = NULL;
            }
            $submit->course_id = $request->course_id;
            $submit->assessment_id = $request->assignment_id;
            $submit->image = $path;
            $submit->link = $request->link;
            $submit->status = "pending";
            $submit->status_in = 0;
            $submit->review = "Not Available";
            $submit->user_id = Auth::user()->id;
            $submit->save();
            $notification = array(
                'message' => 'Assignment Submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assignment.submitted.user')->with($notification);

        }else{

            $check_assignment_submitted->delete();
            $submit = new SubmitAssignment;
            if($request->hasfile('image')){
                $image = $request->file('image');
                $extension = $image->getClientOriginalName();
                $filename = $extension;
                $file_unique_name = uniqid();
                $image->storeAs( '/assignment' , "/" . $file_unique_name . "_odumaretech" . "." .$filename, 'public');
                $path = "storage/assignment/" . $file_unique_name . "_odumaretech" . "." .$filename;
            }else{
                $path = NULL;
            }
            $submit->course_id = $request->course_id;
            $submit->assessment_id = $request->assignment_id;
            $submit->image = $path;
            $submit->link = $request->link;
            $submit->status = "pending";
            $submit->status_in = 0;
            $submit->user_id = Auth::user()->id;
            $submit->save();
            $notification = array(
                'message' => 'Assignment Submitted successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assignment.submitted.user')->with($notification);

        }

    }


    public function assignment_submitted(){
        $assignments = SubmitAssignment::where('user_id', '=', Auth::user()->id)->get();
        return view('user.submitted_assignment', compact('assignments'));
    }

    public function user_info(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)->get();
    }

    public function user_info_pending(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'pending')->where('admission_status', '=', 'accepted')->get();
    }


    public function user_info_complete(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'completed')->get();
    }

    public function chat_user_view(){
        $course_ids = AppliedCourse::where('user_id', '=', Auth::user()->id)
        ->where('status', '=', 'pending')->get();
        $ids = collect($course_ids)->pluck('course_id');
        $courses = Course::whereIn('id', $ids)
        ->select('id', 'title')
        ->get();
        return view('user.chat_view', compact('courses'));
    }
    public function chat_user_add(Request $request){
        $chat = new UserChat;
        $chat->user_id = Auth::user()->id;
        $chat->name = Auth::user()->first_name . " " . Auth::user()->last_name;
        $chat->user_message = $request->message;
        $chat->course_id = $request->course_id;
        $chat->instructor_status = "pending";
        $chat->save();
        $notification = array(
            'message' => 'Message sent to Instructor',
            'alert-type' => 'success'
        );
        return redirect()->route('chat.user.all')->with($notification);

    }

    public function chat_user_all(){
        $chats = UserChat::where('user_id', '=', Auth::user()->id)->get();
        return view('user.chat_all', compact('chats'));
    }

    public function user_chat_reply_view($id){
        $chat = UserChat::findOrFail($id);
        $chat->user_status = "viewed";
        $chat->save();
        return view('user.user_instructor', compact('chat'));
    }
    public function user_github(){
        $github = GitHubLink::first();
        return view('user.github', compact('github'));
    }


    public function user_record($id, $co){
        $course_title = Course::where('id', '=', $id)->first();
        $records = RecordLink::where('course_id', '=', $id)->where('cohort_id', '=', $co)->get();
        return view('user.record', compact('records', 'course_title'));
    }

    public function get_user_courses_id(){
        return AppliedCourse::where('user_id', '=', Auth::user()->id)->where('status', '=', 'pending')->select('course_id')->get();

    }
    public function user_password_view(){
        $countries = getAllCountries(); // ✅ use global function
        $user = Auth::user();
        $bankInfo = $user->bank_info ? json_decode($user->bank_info, true) : [];
        return view('user.change_password', ['user' => $user, 'bankInfo' => $bankInfo, 'countries' => $countries]);
    }

    public function user_password_change(Request $request){
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

public function download_certificate($id){
    $course_details = Course::findOrFail($id);
    $submit_project_detail = SubmitProject::where('course_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
    $name = Auth::user()->first_name . " " . Auth::user()->last_name;
    $time = $submit_project_detail->updated_at;
    $dateTime = new \DateTime($time);
    $formattedDate = $dateTime->format('jS F, Y');
    $student_id = Auth::user()->student_id;

    $data = ['name' => $name,
            'course' => $course_details->title,
            'score'=> $submit_project_detail->status_in,
            'time' => $formattedDate
    ];
    $pdf = PDF::loadView('user.certificate', $data);
    return $pdf->download('certificate_'.$student_id.'.pdf');
}


public function transactions_user()
    {
        $payments = Payment::where('user_email', '=', Auth::user()->email)->where('status', '=', 'paid')->get();
        return view('user.payment', compact('payments'));
    }


    public function user_reward()
{
    $user = Auth::user();

    // Get all users referred by the logged-in user
    $reward_count = User::where('referred_by', $user->referral_code)->count();

    // Get the user's current referral bonus balance
    $reward_bal = $user->referral_bonus ?? 0;

    // Get referral bonus history with related details
    $history = ReferralBonusHistory::where('referrer_id', $user->id)
                ->with(['referredUser', 'course'])
                ->orderBy('created_at', 'desc')
                ->get();

    // Pass everything to the view
    return view('user.reward', [
        'rewards' => $history,
        'reward_count' => $reward_count,
        'balance' => $reward_bal,
    ]);
}

public function user_badge()
{
    $userId = Auth::id();

    // Fetch all achievements and user progress (including locked ones)
    $achievements = Achievement::leftJoin('user_achievements', function ($join) use ($userId) {
            $join->on('achievements.id', '=', 'user_achievements.achievement_id')
                 ->where('user_achievements.user_id', '=', $userId);
        })
        ->select(
            'achievements.id',
            'achievements.code',
            'achievements.title',
            'achievements.description',
            'achievements.color',
            'achievements.icon',
            'achievements.points',
            'achievements.target',
            'user_achievements.earned',
            'user_achievements.progress',
            'user_achievements.current',
            'user_achievements.earned_at'
        )
        ->get();

    // Calculate totals
    $totalEarned   = $achievements->where('earned', 1)->count();
    $totalPoints   = $achievements->where('earned', 1)->sum('points');


    return view('user.badge', [
        'achievements' => $achievements,
        'user'         => Auth::user(),
        'totalEarned'  => $totalEarned,
        'totalPoints'  => $totalPoints,
    ]);
}

    public function user_leaderboard(){
        return view('user.leaderboard');
    }
    public function user_certificates(){

        $certificates = DB::table('applied_courses')
    ->join('courses', 'courses.id', '=', 'applied_courses.course_id')
    ->join('categories', 'categories.id', '=', 'courses.category')
    ->select(
        'courses.id',
        'courses.title',
        'courses.cohort',
        'courses.course_type',
        'categories.name as category',
        'applied_courses.status',
        'applied_courses.updated_at'
    )
    ->where('applied_courses.user_id', Auth::id())
    ->get()
    ->map(function ($row) {
        return [
            'id'       => $row->id,
            'title'       => $row->title,
            'cohort'       => $row->cohort,
            'course_type'       => $row->course_type,
            'category'    => $row->category ?? 'General',
            'status'      => $row->status === 'pending' ? 'In Progress' : 'Issued',
            'date_issued' => $row->status === 'completed' 
                                ? \Carbon\Carbon::parse($row->updated_at)->format('m/d/Y') 
                                : null,
            'progress'    => $row->status === 'pending' ? rand(40, 95) : 100,
            'action'      => $row->status === 'pending' ? 'Continue' : 'Download'
        ];
    })
    ->toArray();

      return view('user.certificates', compact('certificates'));
    }


    public function updateProfile(Request $request)
    {
        // ✅ Validate inputs
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'about_me'   => 'nullable|string|max:1000',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // 2MB max
        ]);
    
        // ✅ Get logged-in user
        $user = Auth::user();
    
        // ✅ Update user fields
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->phone      = $request->phone;
        $user->about_me   = $request->about_me;
    
        // ✅ Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext  = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $path = public_path('uploads/profile/');
    
            if (!file_exists($path)) {
                mkdir($path, 0755, true); // create directory if not exists
            }
    
            $file->move($path, $filename);
    
            // delete old image if exists
            if ($user->image && file_exists($path . $user->image)) {
                unlink($path . $user->image);
            }
    
            $user->image = "uploads/profile/".$filename;
        }
    
        // ✅ Save changes
        $user->save();
    
        $notification = array(
            'message' => 'Profile updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    

public function updateBankInfo(Request $request)
{
    $request->validate([
        'bank_name' => 'required|string|max:255',
        'account_number' => 'required|string|max:255',
        'swift_code' => 'required|string|max:50',
        'country' => 'required|string|max:100',
        'bank_address' => 'nullable|string|max:255',
    ]);

    $user = Auth::user();
    $user->bank_info = json_encode($request->only('bank_name','account_number','swift_code','country','bank_address'));
    $user->save();

    $notification = array(
        'message' => 'Bank information updated successfully.',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
}


public function myPayoutRequests()
{
    $payouts = PayoutRequest::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

    return view('user.payout', compact('payouts'));
}


public function requestPayout(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
    ]);

    $user = Auth::user();

    // ✅ Check if bank info exists
    if (empty($user->bank_info)) {
        return back()->with([
            'message' => 'You must add bank information before requesting payout.',
            'alert-type' => 'error'
        ]);
    }

    $bankInfo = json_decode($user->bank_info, true);

    // ✅ Ensure requested amount <= available bonus
    if ($request->amount > $user->referral_bonus) {
        return back()->with([
            'message' => 'Requested amount exceeds your available earnings.',
            'alert-type' => 'error'
        ]);
    }

    DB::transaction(function () use ($user, $request, $bankInfo) {
        // ✅ Insert payout request
        DB::table('payout_requests')->insert([
            'user_id'   => $user->id,
            'amount'    => $request->amount,
            'bank_info' => json_encode($bankInfo),
            'status'    => 'pending',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        // ✅ Decrement referral bonus
        $user->decrement('referral_bonus', $request->amount);
    });

    return back()->with([
        'message' => 'Your payout request has been submitted successfully.',
        'alert-type' => 'success'
    ]);
}


public function updateUserAchievementByCode($userId, $code, $increment = 1)
{
    $achievement = Achievement::where('code', $code)->first();
    if (!$achievement) return;

    $userAchievement = UserAchievement::firstOrCreate(
        ['user_id' => $userId, 'achievement_id' => $achievement->id],
        ['current' => 0, 'progress' => 0, 'earned' => false]
    );

    $userAchievement->current += $increment;
    $userAchievement->progress = min(100, ($userAchievement->current / $achievement->target) * 100);

    if (!$userAchievement->earned && $userAchievement->current >= $achievement->target) {
        $userAchievement->earned = true;
        $userAchievement->earned_at = now();
        $userAchievement->user->increment('points', $achievement->points);
    }

    $userAchievement->save();
}


public function user_view_course_curriculum($id)
    {
        $course = Course::findOrFail($id);
        return view('user.user_curriculum', compact('course'));
    }

}
