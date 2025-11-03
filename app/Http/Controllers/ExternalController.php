<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\PayoutRequest;
use App\Models\ReferralBonusHistory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;


class ExternalController extends Controller
{
    public function in_course_view(){
        $categories = Category::all();
        return view('external_instructor.course_view', compact('categories'));
    }

    public function in_course_add(Request $request):RedirectResponse
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|integer',
            'description' => 'required|string',
            'level' => 'required|string',
            'duration' => 'required|integer',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Generate URL slug
            $url_slug = strtolower($request->title);
            $label_slug = preg_replace('/\s+/', '-', $url_slug);
            $label_slug = preg_replace('/[^a-z0-9\-]/', '', $label_slug);


                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $directory = 'uploads/courses/images/';

                // Create directory if not exists
                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0755, true);
                }

                // Move file to the directory
                $image->move(public_path($directory), $filename);
                $imageUrl =$directory . $filename;


            // Create new course
            $new_course = new Course();
            $new_course->title = $request->title;
            $new_course->course_url = $label_slug;
            $new_course->category = $request->category;
            $new_course->level = $request->level;
            $new_course->language = $request->language;
            $new_course->price = $request->price;
            $new_course->discount = $request->discount ?? 0;
            $new_course->duration = $request->duration;
            $new_course->instructor = Auth::user()->id;
            $new_course->course_type = 'external';

            $new_course->experience = $request->experience;
            $new_course->certification = $request->certificate;
            $new_course->description = $request->description;
            $new_course->description_corp = $request->description_corp;

            // Map form field names to database column names
            $new_course->course_outline = $request->course_outline; // Based on your form
            $new_course->outcome = $request->career_outcome; // Based on your form
            $new_course->requirement = $request->requirement; // Based on your form
            $new_course->admin_status = 'under_review';
            $new_course->image = $imageUrl;
            $new_course->save();


            try{
                $admins = User::where('user_type', 'admin')->pluck('email');

if ($admins->count() > 0) {
    $instructor = Auth::user();
    $instructorName = $instructor->first_name ?? 'Unknown User';
    $instructorEmail = $instructor->email ?? 'No email provided';

    foreach ($admins as $adminEmail) {
        Mail::raw(
            "A new course titled '{$new_course->title}' has been submitted for review.\n\n" .
            "Submitted by: {$instructorName} ({$instructorEmail})\n\n" .
            "Login to the admin panel to review it.",
            function ($message) use ($adminEmail) {
                $message->to($adminEmail)
                        ->subject('New Course Awaiting Review');
            }
        );
    }
}

            }catch(\Throwable $e){

            }
            $notification = [
                'message' => 'Course successfully added',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error adding course: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function in_course_all():View{
        $courses = Course::where('instructor', '=', Auth::user()->id)->get();
        return view('external_instructor.course_all', compact('courses'));
    }

    public function in_curriculum($id)
    {
        $course = Course::findOrFail($id);
        return view('external_instructor.curriculum', compact('course'));
    }

    public function in_saveCurriculum(Request $request, $id)
{
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'curriculum' => 'required|array',
        'curriculum.*.title' => 'required|string',
        'curriculum.*.points' => 'required|array',
        'curriculum.*.points.*.text' => 'required|string',
        'curriculum.*.points.*.url'  => 'required|url', // ✅ URL validation
    ]);


    try{
        $admins = User::where('user_type', 'admin')->pluck('email');

if ($admins->count() > 0) {
$instructor = Auth::user();
$instructorName = $instructor->first_name ?? 'Unknown User';
$instructorEmail = $instructor->email ?? 'No email provided';

foreach ($admins as $adminEmail) {
Mail::raw(
    "A new course titled '{$course->title}' has been submitted for review.\n\n" .
    "Submitted by: {$instructorName} ({$instructorEmail})\n\n" .
    "Login to the admin panel to review the Course curriculum it.",
    function ($message) use ($adminEmail) {
        $message->to($adminEmail)
                ->subject('New Course Awaiting Review');
    }
);
}
}

    }catch(\Throwable $e){

    }

    // Store as JSON
    $course->curriculum = json_encode($validated['curriculum']);
    $course->save();

    $notification = [
        'message' => 'Curriculum updated successfully.',
        'alert-type' => 'success'
    ];

    return redirect()->route('in.course.all')->with($notification);
}

    
    public function in_course_delete($id){
        $course =  Course::findOrFail($id);
        $filePath = $course->image;
        File::delete(public_path($filePath));
        $course->delete();
        $notification = array(
            'message' => 'Course Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function in_course_edit($id):View{
        $categories = Category::all();
        $course = Course::findOrFail($id);
        return view('external_instructor.course_edit', compact('course', 'categories'));
    }

    public function in_course_update(Request $request, $id): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|integer',
            'description' => 'required|string',
            'level' => 'required|string',
            'duration' => 'required|integer',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $course = Course::findOrFail($id);

            // Generate URL slug
            $url_slug = strtolower($request->title);
            $label_slug = preg_replace('/\s+/', '-', $url_slug);
            $label_slug = preg_replace('/[^a-z0-9\-]/', '', $label_slug);

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $directory = 'uploads/courses/images/';

                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0755, true);
                }

                $image->move(public_path($directory), $filename);
                $imageUrl = $directory . $filename;
            } else {
                $imageUrl = $course->image; // retain the old image
            }

            // Update course data
            $course->title = $request->title;
            $course->course_url = $label_slug;
            $course->category = $request->category;
            $course->level = $request->level;
            $course->language = $request->language;
            $course->price = $request->price;
            $course->discount = $request->discount ?? 0;
            $course->duration = $request->duration;
            $course->start_date = $request->start_date;

            
            $course->experience = $request->experience;
            $course->certification = $request->certificate;
            $course->description = $request->description;
            $course->description_corp = $request->description_corp;

            
            $course->image = $imageUrl;
            $course->save();

            $notification = [
                'message' => 'Course successfully updated',
                'alert-type' => 'success'
            ];

            return redirect()->route('in.course.all')->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error updating course: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function in_revenue(){

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
    return view('external_instructor.revenue', [
        'rewards' => $history,
        'reward_count' => $reward_count,
        'balance' => $reward_bal,
    ]);
    }


    public function in_password_view(){
        $countries = getAllCountries(); // ✅ use global function
        $user = Auth::user();
        $bankInfo = $user->bank_info ? json_decode($user->bank_info, true) : [];
        return view('external_instructor.profile', ['user' => $user, 'bankInfo' => $bankInfo, 'countries' => $countries]);
    }


    public function myPayoutRequests()
{
    $payouts = PayoutRequest::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

    return view('external_instructor.payout', compact('payouts'));
}

}
