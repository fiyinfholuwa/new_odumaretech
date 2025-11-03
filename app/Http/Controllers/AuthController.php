<?php

namespace App\Http\Controllers;

use App\Models\AppliedCourse;
use App\Models\ApprovedInstructor;
use App\Models\Assignment;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Course;
use App\Models\FinalProject;
use App\Models\Innovation;
use App\Models\LiveSession;
use App\Models\MasterClassLink;
use App\Models\Payment;
use App\Models\Slide;
use App\Models\SubmitAssignment;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function logout()
    {

        Session::flush();

        Auth::logout();

        return Redirect()->route('home');
    }

    public function check_login()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type === 'admin' || Auth::user()->user_type==='admin_manager') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->user_type === 'instructor') {
                return redirect()->route('instructor.dashboard');
            } elseif (Auth::user()->user_type === 'external_instructor') {
                return redirect()->route('external.instructor.dashboard');
            } else {
                $check_if_user_has_paid_course = AppliedCourse::where('user_id', '=', Auth::user()->id)->first();
                if ($check_if_user_has_paid_course) {
                    return redirect()->route('user.dashboard');
                } else {
                    return redirect()->route('home');
                }
            }
        } else {
            return redirect()->back();
        }
    }

    public function user_dashboard()
    {
        $applied_courses = AppliedCourse::where('user_id', '=', Auth::user()->id)->get();
        $all_slides = Slide::where('status', '=', 'active')->get();
        $slides = 0;
        foreach ($applied_courses as $arrays) {
            $courseId = $arrays['course_id'];
            $cohortId = $arrays['cohort_id'];
            foreach ($all_slides as $slide) {
                if ($slide['course_id'] === $courseId && is_array($slide['cohort_id'])) {
                    foreach ($slide['cohort_id'] as $id) {
                        if (in_array($cohortId, $slide['cohort_id'])) {
                            $slides++;
                            break;
                        }
                    }
                }
            }
        }
        $active = AppliedCourse::where('status', '=', 'pending')->where('user_id', '=', Auth::user()->id)->count();
        $complete =  AppliedCourse::where('status', '=', 'completed')->where('user_id', '=', Auth::user()->id)->count();
        $session = DB::table('live_sessions')
            ->join('applied_courses', 'live_sessions.course_id', '=', 'applied_courses.course_id')->join('cohorts', 'live_sessions.cohort_id', '=', 'cohorts.id')
            ->where('applied_courses.user_id', Auth::user()->id)
            ->where('live_sessions.status', '=', 'active')
            ->count();

        $applied_courses = AppliedCourse::where('user_id', '=', Auth::user()->id)->get();
        $all_assignments = Assignment::where('status', '=', 'active')->get();
        $assignments = 0;
        foreach ($applied_courses as $arrays) {
            $courseId = $arrays['course_id'];
            $cohortId = $arrays['cohort_id'];
            foreach ($all_assignments as $assignment) {
                if ($assignment['course_id'] === $courseId && is_array($assignment['cohort_id'])) {
                    foreach ($assignment['cohort_id'] as $id) {
                        if (in_array($cohortId, $assignment['cohort_id'])) {
                            $assignments++;
                            break;
                        }
                    }
                }
            }
        }

        $submitted_assignment  = SubmitAssignment::where('user_id', Auth::user()->id)->count();
        return view('user.dashboard', compact('slides', 'active', 'complete', 'session', 'assignments', 'submitted_assignment'));

        return view('user.dashboard');
    }
    public function admin_dashboard()
    {
        $users       = User::where('user_type', 'user')->count();
        $instructors = ApprovedInstructor::count();
        $payments    = Payment::where('status', 'paid')->sum('amount');
        $courses     = Course::count();
        $testimonial = Testimonial::count();
        $contacts    = Contact::count();
        $recent_masterclass = MasterClassLink::all();
        $innovations = Innovation::paginate(3);
        $blogs = Blog::paginate(3);
        $course_purchases = Course::where('course_type', 'internal')
        ->select('title', 'student_count')
        ->get();

        $monthly_revenue = Payment::select(
            DB::raw('MONTH(created_at) as month_number'),
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('SUM(amount) as revenue')
        )
        ->where('status', 'paid')
        ->groupBy('month_number', 'month')
        ->orderBy('month_number')
        ->get()
        ->map(function ($item) {
            return [
                'month' => $item->month,
                'revenue' => (float) $item->revenue,
            ];
        })
        ->toArray();

            return view('admin.dashboard', compact(
            'users',
            'instructors',
            'payments',
            'courses',
            'testimonial',
            'contacts',
            'recent_masterclass',
            'innovations',
            'blogs',
            'course_purchases',
            'monthly_revenue'
        ));
    }

    public function instructor_dashboard()
    {
        // $user_id = Auth::user()->id;
        $instructor = ApprovedInstructor::where('user_id', '=', Auth::user()->id)->first();
        $course_ids = $instructor->course_ids;
        $course_ids = is_array($course_ids) ? $course_ids : json_decode($course_ids, true);
        $students = AppliedCourse::whereIn('course_id', $course_ids)->count();
        $assignment = Assignment::whereIn('course_id', $course_ids)->count();
        $course = Course::whereIn('id', $course_ids)->count();
        $slide = Slide::whereIn('course_id', $course_ids)->count();
        $projects = FinalProject::whereIn('course_id', $course_ids)->count();
        $session = LiveSession::whereIn('course_id', $course_ids)->count();
        return view('instructor.dashboard', compact('students', 'assignment', 'course', 'slide', 'session', 'projects'));
        // return view('instructor.dashboard');

    }
    public function external_instructor_dashboard()
    {
        // $user_id = Auth::user()->id;
        // $instructor = ApprovedInstructor::where('user_id', '=', $user_id)->first();
        // $course_ids = $instructor->course_ids;
        // $students = AppliedCourse::whereIn('course_id', $course_ids)->count();
        // $assignment = Assignment::whereIn('course_id', $course_ids)->count();
        $course = Course::where('instructor', Auth::user()->id)->count();
        $recent_courses = Course::where('instructor', Auth::user()->id)->paginate(3);
        // $slide = Slide::whereIn('course_id', $course_ids)->count();
        // $session = LiveSession::whereIn('course_id', $course_ids)->count();
        // return view('instructor.dashboard', compact('students', 'assignment', 'course', 'slide', 'session'));
        return view('external_instructor.dashboard', ['courses' => $course, 'recent_courses' => $recent_courses]);
    }

    public function student_all()
    {
        $users = User::where('user_type', '=', '0')->get();
        return view('admin.student_all', compact('users'));
    }

    public function instructor_all()
    {
        $users = User::where('user_type', '=', '1')->get();
        return view('admin.instructor_all', compact('users'));
    }
    public function student_delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' => 'Student successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function instructor_delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' => 'Instructor successfully deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function instructor_edit($id)
    {
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

    public function instructor_update(Request $request, $id)
    {
        ApprovedInstructor::where('user_id', '=', $id)->update(['course_ids' => $request->course_ids]);
        $notification = array(
            'message' => 'Instructor successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all')->with($notification);
    }
}
