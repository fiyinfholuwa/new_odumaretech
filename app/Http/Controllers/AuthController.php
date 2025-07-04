<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\AppliedCourse;
use App\Models\User;
use App\Models\Contact;
use App\Models\Payment;
use App\Models\ApprovedInstructor;
use App\Models\Course;
use App\Models\Testimonial;
use App\Models\Assignment;
use App\Models\Slide;
use App\Models\LiveSession;

class AuthController extends Controller
{
    public function logout(){

        Session::flush();

         Auth::logout();

        return Redirect()->route('home');
    }

    public function check_login(){
        if (Auth::id()) {
            if (Auth::user()->user_type=='admin') {
                return redirect()->route('admin.dashboard');
            }elseif(Auth::user()->user_type=='instructor'){
             return redirect()->route('instructor.dashboard');
            }else{
                $check_if_user_has_paid_course = AppliedCourse::where('user_id', '=', Auth::user()->id)->first();
                if($check_if_user_has_paid_course){
                    return redirect()->route('user.dashboard');
                }else{
                    return redirect()->route('home');
                }

            }
        }else{
            return redirect()->back();
        }
    }

    public function user_dashboard(){
        // $applied_courses = AppliedCourse::where('user_id', '=', Auth::user()->id)->get();
        // $all_slides = Slide::where('status', '=', 'active')->get();
        // $slides = 0;
        // foreach ($applied_courses as $arrays) {
        //         $courseId = $arrays['course_id'];
        //         $cohortId = $arrays['cohort_id'];
        //         foreach ($all_slides as $slide) {
        //             if ($slide['course_id'] === $courseId && is_array($slide['cohort_id'])) {
        //                 foreach ($slide['cohort_id'] as $id) {
        //                     if (in_array($cohortId, $slide['cohort_id'])) {
        //                         $slides++;
        //                         break;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // $active = AppliedCourse::where('status', '=', 'pending')->where('user_id', '=', Auth::user()->id)->count();
        // $complete =  AppliedCourse::where('status', '=', 'completed')->where('user_id', '=', Auth::user()->id)->count();
        // $session = DB::table('live_sessions')
        // ->join('applied_courses', 'live_sessions.course_id', '=', 'applied_courses.course_id')->join('cohorts', 'live_sessions.cohort_id', '=', 'cohorts.id')
        // ->where('applied_courses.user_id', Auth::user()->id)
        // ->where('live_sessions.status', '=', 'active')
        // ->count();

        // $applied_courses = AppliedCourse::where('user_id', '=', Auth::user()->id)->get();
        // $all_assignments = Assignment::where('status', '=', 'active')->get();
        // $assignments = 0;
        // foreach ($applied_courses as $arrays) {
        //     $courseId = $arrays['course_id'];
        //     $cohortId = $arrays['cohort_id'];
        //     foreach ($all_assignments as $assignment) {
        //         if ($assignment['course_id'] === $courseId && is_array($assignment['cohort_id'])) {
        //             foreach ($assignment['cohort_id'] as $id) {
        //                 if (in_array($cohortId, $assignment['cohort_id'])) {
        //                     $assignments++;
        //                     break;
        //                 }
        //             }
        //         }
        //     }
        // }

        // return view('user.dashboard', compact('slides','active', 'complete', 'session', 'assignments') );

        return view('user.dashboard');
    }
    public function admin_dashboard(){

        // $users = User::where('user_type', '=', '0')->count();
        // $instructors = ApprovedInstructor::count();
        // $payments = Payment::where('status', '=', 'paid')->sum('amount');
        // $courses = Course::count();
        // $testimonial = Testimonial::count();
        // $contacts = Contact::count();
        return view('admin.dashboard');
    }
    public function instructor_dashboard(){
        // $user_id = Auth::user()->id;
        // $instructor = ApprovedInstructor::where('user_id', '=', $user_id)->first();
        // $course_ids = $instructor->course_ids;
        // $students = AppliedCourse::whereIn('course_id', $course_ids)->count();
        // $assignment = Assignment::whereIn('course_id', $course_ids)->count();
        // $course = Course::whereIn('id', $course_ids)->count();
        // $slide = Slide::whereIn('course_id', $course_ids)->count();
        // $session = LiveSession::whereIn('course_id', $course_ids)->count();
        // return view('instructor.dashboard', compact('students', 'assignment', 'course', 'slide', 'session'));
        return view('instructor.dashboard');

    }

    public function student_all(){
        $users = User::where('user_type', '=', '0')->get();
        return view('admin.student_all', compact('users'));
    }

    public function instructor_all(){
        $users = User::where('user_type', '=', '1')->get();
        return view('admin.instructor_all', compact('users'));
    }
    public function student_delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' => 'Student successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function instructor_delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' => 'Instructor successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function instructor_edit($id){
        $user = User::findOrFail($id);
        $user_id = $user->id;
        $courses = Course::all();
        $instructor = ApprovedInstructor::where('user_id', '=', $user_id)->first();
        $course_ids = $instructor->course_ids;
        $courses_old = Course::whereIn('id', array_map('intval', $course_ids))
        ->select('title')
        ->get();
        return view('admin.instructor_edit', compact('user', 'courses', 'courses_old'));
    }

    public function instructor_update(Request $request, $id){
        ApprovedInstructor::where('user_id', '=', $id)->update(['course_ids' => $request->course_ids]);
        $notification = array(
            'message' => 'Instructor successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all')->with($notification);

    }
}
