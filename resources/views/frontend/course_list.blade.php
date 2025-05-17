
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->

    <style>
        @keyframes animateBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>

    <section style="
  height: 40vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 30px 0;
" class="section dark-background">
        <div class="container text-white">
            <div class="row mb-4 g-3 align-items-center">

                <div class="col-md-3">
                    <select style="background-color: #E9ECFF;" class="form-select form-select-lg">
                        <option selected>Filter</option>
                        <option>Free Courses</option>
                        <option>Paid Courses</option>
                        <option>Beginner Level</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select style="background-color: #E9ECFF;" class="form-select form-select-lg">
                        <option selected>Sort by: Trending</option>
                        <option>Newest</option>
                        <option>Popular</option>
                        <option>Top Rated</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex">
                    <input style="background-color: #E9ECFF;" type="text" class="form-control form-control-lg me-2" placeholder="Enter keyword..." />
                    <button class="btn btn-light btn-lg" style="background-color: #E9ECFF;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <strong>Suggestions:</strong>
                <span class="badge bg-white text-dark me-2">User Interface</span>
                <span class="badge bg-white text-dark me-2">User Experience</span>
                <span class="badge bg-white text-dark me-2">Web Design</span>
                <span class="badge bg-white text-dark me-2">Interface</span>
                <span class="badge bg-white text-dark me-2">App</span>
            </div>

            <div>
                <h5 class="text-light">3,145,684 results found for <span class="fw-bold">“UI/UX Design”</span></h5>
            </div>
        </div>
    </section>


    <section>
        <div class="container">

            <?php
            $courses = [
                [
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],[
                    'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data...',
                    'price' => '$14.00',
                    'category' => 'Design',
                    'students' => '265.7K',
                    'instructor' => 'Kevin Gilbert',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
                [
                    'title' => 'Complete Web Developer Bootcamp',
                    'price' => '$19.00',
                    'category' => 'Programming',
                    'students' => '312K',
                    'instructor' => 'Angela Yu',
                    'course_img' => asset('frontend/assets/img/image-6.png'),
                    'instructor_img' => asset('frontend/assets/img/image-6.png'),
                ],
            ];

            ?>

            <style>
                .course-card {
                    background-color: #E9ECFF;
                    min-height: 100%; /* ensures cards stretch equally */
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    padding: 15px;
                    border-radius: 8px;
                }

                .course-title {
                    font-size: 1rem;
                    font-weight: 600;
                    flex-grow: 1; /* allows title block to push others downward */
                }

                .course-meta {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-top: 10px;
                }

                .course-footer {
                    margin-top: auto;
                }
            </style>

            <div class="container">
                <div class="row">
                    @foreach($courses as $index => $course)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                            <a style="text-decoration: none; color: black;" href="{{route('course_external_detail')}}">
                                <div class="course-card w-100 shadow-sm">
                                    <img src="{{ $course['course_img'] }}" class="img-fluid mb-2" style="height: 160px; object-fit: cover; border-radius: 5px;" />

                                    <div class="course-meta">
                                        <span style="background-color: #F5F5F5; padding: 4px 8px; border-radius: 4px;">{{ $course['category'] }}</span>
                                        <strong>{{ $course['price'] }}</strong>
                                    </div>

                                    <div class="course-title mt-2">
                                        {{ \Illuminate\Support\Str::limit($course['title'], 60) }}
                                    </div>

                                    <div class="row align-items-center mt-3 course-footer">
                                        <div class="col-2">
                                            <img src="{{ $course['instructor_img'] }}" style="height: 30px; width: 30px; border-radius: 50%;" />
                                        </div>
                                        <div class="col-5 ps-0">
                                            <small class="text-muted">Course By</small><br/>
                                            <strong>{{ $course['instructor'] }}</strong>
                                        </div>
                                        <div class="col-5 text-end">
                                            <small class="text-muted">{{ $course['students'] }} Students</small>
                                        </div>
                                    </div>
                                </div>

                            </a>
                        </div>

                        @if(($index + 1) % 4 == 0)
                </div><div class="row">
                    @endif
                    @endforeach
                </div>
            </div>


        </div>
    </section>


</main>

@endsection
