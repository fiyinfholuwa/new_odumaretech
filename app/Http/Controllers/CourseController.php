<?php

namespace App\Http\Controllers;

use App\Models\AppliedCourse;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\CohortCourse;
use App\Models\Coupon;
use App\Models\CouponUsed;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function all_course(){
        $courses  = Course::where('normal_display', '=', 'yes')->paginate(6);
        $categories = Category::all();
        return view('frontend.course', compact('courses','categories'));
    }
    public function category_view(){
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function cohort_view(){
        $cohorts = Cohort::all();
        return view('admin.cohort', compact('cohorts'));
    }

    public function cohort_m_view(){
        $cohort_courses = CohortCourse::all();
        $cohorts = Cohort::all();
        $courses = Course::all();
        return view('admin.cohort_m', compact('cohort_courses', 'cohorts', 'courses'));
    }

    public function cohort_add(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $cohort = new Cohort;
        $cohort->name = $request->name;
        $cohort->save();
        $notification = array(
            'message' => 'Cohort Sucessfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function cohort_m_add(Request $request){

        $cohort_c = new CohortCourse;
        $check_if_exist = CohortCourse::where('course_id', '=', $request->course_id)->where('cohort_id', '=', $request->cohort_id)->first();
        if($check_if_exist){
            $notification = array(
                'message' => 'Cohort And Course Setup already exist',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $cohort_c->price = $request->price;
        $cohort_c->course_id = $request->course_id;
        $cohort_c->cohort_id = $request->cohort_id;
        $cohort_c->save();
        $notification = array(
            'message' => 'Cohort Course Sucessfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function category_add(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $url_slug = strtolower($request->name);
        $label_slug= preg_replace('/\s+/', '-', $url_slug);

        $category = new Category;
        $category->name = $request->name;
        $category->category_url = $label_slug;
        $category->save();
        $notification = array(
            'message' => 'Category Sucessfully saved',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function category_delete($id){
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function cohort_delete($id){
        Cohort::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Cohort Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function cohort_m_delete($id){
        CohortCourse::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Cohort Course Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function category_edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.category_edit', compact('category', 'categories'));
    }

    public function cohort_edit($id){
        $cohort = Cohort::findOrFail($id);
        $cohorts = Cohort::all();
        return view('admin.cohort_edit', compact('cohort', 'cohorts'));
    }


    public function cohort_m_edit($id){
        $cohort = CohortCourse::findOrFail($id);
        $cohort_courses = CohortCourse::all();
        $cohorts = Cohort::all();
        $courses = Course::all();
        return view('admin.cohort_edit_m', compact('cohort', 'cohorts', 'courses', 'cohort_courses'));
    }



    public function category_update(Request $request, $id){
        $category_update = Category::findOrFail($id);
        $url_slug = strtolower($request->name);
        $label_slug= preg_replace('/\s+/', '-', $url_slug);

        $category_update->name = $request->name;
        $category_update->category_url = $label_slug;
        $category_update->save();

        $notification = array(
            'message' => 'Category Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('category.view')->with($notification);
    }

    public function cohort_update(Request $request, $id){
        $cohort_update = Cohort::findOrFail($id);
        $cohort_update->name = $request->name;
        $cohort_update->save();
        $notification = array(
            'message' => 'Cohort Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('cohort.view')->with($notification);
    }

    public function cohort_m_update(Request $request, $id){
        $cohort_c= CohortCourse::findOrFail($id);
        $check_if_exist = CohortCourse::where('course_id', '=', $request->course_id)->where('cohort_id', '=', $request->cohort_id)->first();
        if($check_if_exist){
            $notification = array(
                'message' => 'Cohort And Course Setup already exist',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $cohort_c->price = $request->price;
        $cohort_c->course_id = $request->course_id;
        $cohort_c->cohort_id = $request->cohort_id;
        $cohort_c->save();
        $notification = array(
            'message' => 'Cohort Course Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('cohort_m.view')->with($notification);
    }

    public function course_view(){
        $categories = Category::all();
        $cohorts = Cohort::all();
        return view('admin.course_view', compact('categories', 'cohorts'));
    }

    public function course_add(Request $request):RedirectResponse
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|integer',
            'description' => 'required|string',
            'level' => 'required|string',
            'duration' => 'required|integer',
            'language' => 'required|string|max:50',
            'cohort' => 'required|integer',
            'start_date' => 'required|date',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'lecture' => 'required|string',
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
            $new_course->lecture = $request->lecture;
            $new_course->discount = $request->discount ?? 0;
            $new_course->duration = $request->duration;
            $new_course->start_date = $request->start_date;
            $new_course->cohort = $request->cohort;

            // Handle checkbox values properly
            $new_course->normal_display = $request->has('normal_display') ? 'yes' : 'no';
            $new_course->corporate_display = $request->has('corporate_display') ? 'yes' : 'no';

            $new_course->experience = $request->experience;
            $new_course->certification = $request->certificate;
            $new_course->description = $request->description;
            $new_course->description_corp = $request->description_corp;

            // Map form field names to database column names
            $new_course->course_outline = $request->course_outline; // Based on your form
            $new_course->outcome = $request->career_outcome; // Based on your form
            $new_course->requirement = $request->requirement; // Based on your form

            $new_course->image = $imageUrl;
            $new_course->save();

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

    public function course_all():View{
        $courses = Course::all();
        $instructors = User::all();
        return view('admin.course_all', compact('courses','instructors'));
    }

    public function curriculum($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.curriculum', compact('course'));
    }

    public function saveCurriculum(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'curriculum' => 'required|array',
            'curriculum.*.title' => 'required|string',
            'curriculum.*.points' => 'required|array',
            'curriculum.*.points.*' => 'required|string',
        ]);

        $course->curriculum = json_encode($validated['curriculum']);
        $course->save();

        $notification = [
            'message' => 'Curriculum updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('course.all')->with($notification);
    }

    public function assignInstructor(Request $request):RedirectResponse
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:users,id', // assuming instructors are in users table
        ]);

       $course = Course::findOrFail($request->course_id);
       $course->instructor = $request->instructor_id;
       $course->save();
        $notification = [
            'message' => 'Instructor assigned successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function course_delete($id){
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

    public function course_edit($id):View{
        $categories = Category::all();
        $cohorts = Cohort::all();
        $course = Course::findOrFail($id);
        return view('admin.course_edit', compact('course', 'categories', 'cohorts'));
    }

    public function course_update(Request $request, $id): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|integer',
            'description' => 'required|string',
            'level' => 'required|string',
            'duration' => 'required|integer',
            'language' => 'required|string|max:50',
            'cohort' => 'required|integer',
            'start_date' => 'required|date',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|min:0|max:100',
            'lecture' => 'required|string',
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
            $course->lecture = $request->lecture;
            $course->discount = $request->discount ?? 0;
            $course->duration = $request->duration;
            $course->start_date = $request->start_date;
            $course->cohort = $request->cohort;

            $course->normal_display = $request->has('normal_display') ? 'yes' : 'no';
            $course->corporate_display = $request->has('corporate_display') ? 'yes' : 'no';

            $course->experience = $request->experience;
            $course->certification = $request->certificate;
            $course->description = $request->description;
            $course->description_corp = $request->description_corp;

            // Additional optional fields
            $course->course_outline = $request->course_outline;
            $course->outcome = $request->career_outcome;
            $course->requirement = $request->requirement;
            $course->support = $request->support;

            $course->image = $imageUrl;
            $course->save();

            $notification = [
                'message' => 'Course successfully updated',
                'alert-type' => 'success'
            ];

            return redirect()->route('course.all')->with($notification);

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error updating course: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function course_detail($name){

        $course = Course::where('course_url', $name)->get()->first();
        if(Auth::check()){
            $check_user_has_coupon = CouponUsed::where('user_id', '=', Auth::user()->id)->where('course_id','=', $course->id)->first();
            $has_pending = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)
                ->where('status' , '=' , "pending")->first();
        }else{
            $check_user_has_coupon = NULL;
            $has_pending = NULL;
        }
        $cohort_name = Cohort::where('id', $course->cohort)->first();
        $coupon_check = Coupon::where('course_id', '=', $course->id)->first();

        return view('frontend.course_detail', compact('course', 'coupon_check','check_user_has_coupon', 'has_pending', 'cohort_name' ));
    }

    public function course_category($name){
        $category = Category::where('category_url', '=', $name)->get()->first();
        $category_id = $category->id;
        $courses  = Course::where('category', '=', $category_id)->paginate(6);
        $course = Course::where('course_url', $name)->get()->first();
        $categories = Category::all();
        return view('frontend.category', compact('course', 'categories', 'courses', 'category'));
    }

    public function search(Request $request)
    {
        // Process the search query
        $searchTerm = $request->input('search');
        // Perform the search
        $categories = Category::all();
        $courses = Course::where('title', 'like', '%' . $searchTerm . '%')->paginate(6);
        // Return the search results page
        return view('frontend.search', compact('courses', 'searchTerm', 'categories'));
    }


    public function coupon_view(){
        $courses = Course::select('id', 'title')->get();
        $coupons = Coupon::all();
        return view('admin.coupon', compact('coupons', 'courses'));
    }

    public function coupon_add(Request $request){

        $coupon = new Coupon;
        $coupon->code = $request->code;
        $coupon->course_id = $request->course_id;
        $coupon->discount = $request->discount;
        $coupon->number = $request->number;
        $coupon->user_id = 0;
        $coupon->save();
        $notification = array(
            'message' => 'Coupon Sucessfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function coupon_delete($id){
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function coupon_edit($id){
        $coupon = Coupon::findOrFail($id);
        $courses = Course::select('id', 'title')->get();
        $coupons = Coupon::all();
        return view('admin.coupon_edit', compact('coupons', 'courses', 'coupon'));
    }



    public function coupon_update(Request $request, $id){
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->course_id = $request->course_id;
        $coupon->discount = $request->discount;
        $coupon->number = $request->number;
        $coupon->user_id = 0;
        $coupon->save();
        $notification = array(
            'message' => 'Coupon Sucessfully updated',
            'alert-type' => 'success'
        );
        return redirect()->route('coupon.view')->with($notification);
    }

    public function coupon_validate(Request $request){
        $get_coupon = Coupon::where('code', '=', $request->code)->first();
        $get_coupon_exist = CouponUsed::where('coupon_id', '=', $request->coupon_id)->where('user_id', Auth::user()->id)->where('course_id', '=',$request->course_id)->first();

        if(!$get_coupon){
            $notification = array(
                'message' => 'Invalid Coupon Code',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $get_all_coupon_number = CouponUsed::where('coupon_id', '=',$get_coupon->id )->count();

        if($get_coupon_exist){
            $notification = array(
                'message' => 'Coupon Code Applied',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }elseif($get_all_coupon_number >= $get_coupon->number){
            $notification = array(
                'message' => 'Coupon Limit reached',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $coupon = new CouponUsed;
            $coupon->user_id = Auth::user()->id;
            $coupon->course_id = $request->course_id;
            $coupon->coupon_id = $request->coupon_id;
            $coupon->save();
            $update_coupon_used = Coupon::where('code', '=', $get_coupon->code)->update(['user_id' => $get_coupon->user_id + 1]);
            $notification = array(
                'message' => 'Coupon Code Applied',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

    }

}
