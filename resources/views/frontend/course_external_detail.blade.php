
@extends('frontend.layout.app')

@section('content')
    <main class="main">

<?php
$amount_info = getUserLocalCurrencyConversion($course['price']);

?>
        <!-- Hero Section -->
        <section style="
  height: 100vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  animation: animateBackground 10s ease infinite;
  padding: 40px 20px;
" class="section dark-background">

            <div class="container bg-white text-dark p-4 rounded" style="margin-top: 100px;">
                <div class="row g-4">
                    <!-- Course Info Section -->
                    <div class="col-lg-8">
                        <h3 class="fw-bold" style="color: black;">{{ $course->title }}</h3>

                        @if (!is_null($course->instructor))
                            <div class="d-flex align-items-center mb-4">
                            <img src="{{ optional($course->instructor_name)->image 
        ? asset($course->instructor_name->image) 
        : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnFRPx77U9mERU_T1zyHcz9BOxbDQrL4Dvtg&s' }}"
     alt="Instructor"
     class="img-fluid rounded-circle"
     style="width: 80px; height: 80px; object-fit: cover;">

                            <div class="ms-3">
                                <p class="mb-0 text-muted">Created by:</p>
                                <h6 style="color:navy;" class="mb-0 fw-bold">{{ optional($course->instructor_name)->first_name . " ". optional($course->instructor_name)->last_name }}</h6>
                            </div>
                        </div>

                        @endif
                        <!-- Instructor Info -->
                        
                        <!-- Video Preview -->
                        <div class="ratio ratio-16x9">
                        <div class="w-100">
                                    <img src="{{ asset($course->image) }}" alt="Course Image" class="w-100" style="max-height: 800px; object-fit: cover;">
                                </div>

                            {{-- <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF"
                                    title="YouTube video player" allowfullscreen style="border-radius: 10px;"></iframe> --}}
                        </div>
                    </div>

                    <!-- Purchase Section -->
                    <div class="col-lg-4">
                        <div class="p-4 rounded" style="background-color: #FFF3CF;">
                            <h3 class="fw-bold mb-3 " style="color: black;"> {{ $amount_info['currency_symbol'] }} {{ $amount_info['converted_amount'] }}</h3>

                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fa fa-clock me-2"></i>Course Duration</span>
                                <span>{{ $course->duration }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fa fa-layer-group me-2"></i>Course Level</span>
                                <span>{{ $course->level }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fa fa-users me-2"></i>Students Enrolled</span>
                                <span>{{ $course->student_count }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span><i class="fa fa-language me-2"></i>Language</span>
                                <span>{{$course->language}}</span>
                            </div>
                            
                            <!-- Buy Now Button (triggers modal) -->
                            <button class="btn btn-warning btn-lg w-100 mb-3" style="background-color: #FFC000;" data-bs-toggle="modal" data-bs-target="#buyNowModal">
                                Buy Now
                            </button>

                            <p class="mb-2 fw-semibold">Share this course:</p>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm" style="background-color: #FFFFFF; color: #757575;">
                                    <i class="fas fa-copy"></i> Copy
                                </button>
                                <a href="#" class="btn btn-sm" style="background-color: #FFFFFF; color: #757575;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-sm" style="background-color: #FFFFFF; color: #757575;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-sm" style="background-color: #FFFFFF; color: #757575;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-sm" style="background-color: #FFFFFF; color: #757575;">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Buy Now Modal -->
                   <div class="modal fade" id="buyNowModal" tabindex="-1" aria-labelledby="buyNowModalLabel" aria-hidden="true">
    <div style="border-radius: 40px;" class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('pay') }}">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <input type="hidden" name="cohort_id" value="{{ $cohort_name?->id ?? 1 }}">
                <input type="hidden" name="payment" value="flutterwave">
                <input type="hidden" name="currency" value="{{ $amount_info['currency_code'] }}">
                <input type="hidden" name="course_type" value="{{ $course->course_type ?? 'external' }}"> <!-- Added -->

                @if(Auth::check())
                    <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
<input type="hidden" name="amount" value="{{ round($amount_info['converted_amount'], 2) }}">
                    <input type="hidden" name="payment_type" value="full">

                    <div class="modal-header bg-light text-dark">
                        <h5 style="color: black;" class="modal-title" id="buyNowModalLabel">Purchase Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="fw-semibold">You are about to purchase:</p>
                        <h5 style="background-color: #E9ECFF; color: black; padding: 10px; border-radius: 10px;">
                            {{ $course->title }}
                        </h5>
                        <p class="mb-2"><i class="fa fa-clock me-1"></i> Duration: {{ $course->duration }}Hours</p>
                        <p class="mb-2"><i class="fa fa-money-bill me-1"></i> Price:
                            <strong>{{ $amount_info['currency_symbol'] }} {{ $amount_info['converted_amount'] }}</strong>
                        </p>

                    
                        <p class="text-muted">Proceeding will take you to the checkout page.</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        @if($has_pending)
                            <button type="button" class="btn btn-danger cta-btn radius-xl">
                                You Already Registered for a Course.
                            </button>
                        @else
                            <button type="submit" class="btn btn-warning text-dark">Continue to Payment</button>
                        @endif
                    </div>
                @else
                    <div class="modal-body">
                        <p>You need to log in to proceed with the payment.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login to Continue</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

                </div>
            </div>

        </section>



        <section>
            <div class="">
                <!-- Tabs -->
                <ul class="nav nav-tabs nav-fill container" id="courseTab" role="tablist" style="background-color: #E9ECFF; padding: 15px; border-radius: 10px; width: 800px;">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab">Reviews <sup class="badge bg-danger">{{ $reviews->count() }}</sup></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="requirement-tab" data-bs-toggle="tab" data-bs-target="#requirement" type="button" role="tab">Requirement</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab">Curriculum</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab">Instructor</button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="outcome-tab" data-bs-toggle="tab" data-bs-target="#outcome" type="button" role="tab">Career Outcome</button>
                    </li> --}}

                </ul>

                <style>
                    .nav-tabs .nav-link.active {
                        background-color: #0E2293;
                        color: #ffffff;
                        border-color: #0E2293;
                    }

                    .nav-tabs .nav-link {
                        color: #000000;
                    }

                    @media (max-width: 768px) {
  #courseTab {
    flex-direction: column !important;
    width: 100% !important;
  }

  #courseTab .nav-item {
    width: 100%;
    margin-bottom: 5px;
  }
}


                </style>
                <!-- Tab Content -->
                <div class="tab-content" id="courseTabContent">
                    <!-- Overview -->

                    <!-- Description -->
                    <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
    
    {{-- ✅ Review Form Section --}}
    <div class="container mb-4">
        
        <div class="card-body">
            @auth
                {{-- Logged in users can submit reviews --}}
                <form action="{{ route('reviews.store', $course->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="message" class="form-label fw-bold">
                            <i class="bi bi-chat-dots me-1"></i>
                            Your Review
                        </label>
                        <textarea name="message" id="message" class="form-control" 
                                  rows="4" placeholder="Share your thoughts about this course..." required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label fw-bold">
                            <i class="bi bi-star-half me-1"></i>
                            Rating
                        </label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Select your rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}">
                                    {{ str_repeat('⭐', $i) }} {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>
                            Submit Review
                        </button>
                    </div>
                </form>
            @else
                
            @endauth
        </div>
    </div>

    {{-- ✅ Reviews Display Section --}}
    <div class="container">
        
        <div class="card-body">
            @forelse($reviews as $review)
                <div class="border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-1">{{ $review->user->name }}</h6>
                            <div class="text-warning small">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                                <span class="text-muted ms-1">({{ $review->rating }}/5)</span>
                            </div>
                        </div>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0 mt-2">{{ $review->message }}</p>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="bi bi-chat-dots display-6 text-muted"></i>
                    <h5 class="text-muted mt-2">No Reviews Yet</h5>
                    <p class="text-muted">Be the first to review this course!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

                    <div class="tab-pane fade show " id="description" role="tabpanel" aria-labelledby="description-tab">


                    @if(!is_null($course->description))
                        <section style="background-color: #FFF3CF; margin-top: 50px; margin-bottom: -60px;"
                            style="background-color: #FFF3CF;" class="course_description">
                            <div style="padding: 30px; margin-top: -40px;" class="container">
                                <h3>Course Description</h3>
                                <div style="background-color: white; padding: 30px; border-radius: 30px;" class="">
                                    <p>
                                        {!!$course->description!!}
                                    </p>
                                </div>
                            </div>
                        </section>

                    @endif


                    </div>

                    <div class="tab-pane fade" id="cost" role="tabpanel" aria-labelledby="cost-tab">

                        <section>
                            <div class="container">
                                <h2>Cost</h2>
                                <div class="row">
                                    @php
                                        $plans = [
                                            [
                                                'title' => 'Weekly',
                                                'price' => '$10/week',
                                                'description' => 'Pay the same amount each week until your course is fully paid for.',
                                                'popular' => false,
                                                'background' => '#FFF3CF', // normal background
                                            ],
                                            [
                                                'title' => 'Monthly',
                                                'price' => '$35/month',
                                                'description' => 'Save more by paying monthly.',
                                                'popular' => true,
                                                'background' => '#E9ECFF', // special background for popular
                                            ],
                                            [
                                                'title' => 'One Time',
                                                'price' => '$300',
                                                'description' => 'Pay once and forget about it!',
                                                'popular' => false,
                                                'background' => '#FFF3CF',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($plans as $plan)
                                        <div class="col-lg-4 mb-4">
                                            <div style="background-color: {{ $plan['background'] }}; padding: 30px; border-radius: 10px; text-align: center; position: relative;">

                                                @if ($plan['popular'])
                                                    <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background-color: #FFC000; color: white; padding: 5px 10px; border-radius: 20px; font-size: 12px;">
                                Most Popular
                            </span>
                                                @endif

                                                <h5>{{ $plan['title'] }}</h5>
                                                <h2 >{{ $plan['price'] }}</h2>
                                                <button style="margin: 15px 0; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
                                                    Choose
                                                </button>
                                                <p>{{ $plan['description'] }}</p>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </section>

                    </div>

                    <!-- Requirement -->
                    <div class="tab-pane fade" id="requirement" role="tabpanel" aria-labelledby="requirement-tab">
                        @if(!is_null($course->requirement))
                        <section style="background-color:;" class="course_description">
                            <div style="padding: 30px; margin-top: -40px;" class="container">
                                <h3>Admission Requirements</h3>
                                <div style="background-color: #FFF3CF; padding: 30px; border-radius: 30px;">
                                    <p>
                                       {!! $course->requirement !!}
                                    </p>
                                </div>
                            </div>
                        </section>

                    @endif
                   
                    </div>


                    <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                        <section>
                        <div class="container">
                            <h3>Course Instructor</h3>

                            @php
                                $instructor = [
                                    'name' => optional($course->instructor_name)->first_name . " ". optional($course->instructor_name)->last_name,
                                    'role' => 'Entrepreneur & Designer • Founder of ShiftRide',
                                    'students' => optional($course->instructor_name)->student_count,
                                    'courses' => optional($course->instructor_name)->student_count,
                                    'bio' => optional($course->instructor_name)->about_me,
                                    'image' => asset(optional($course->instructor_name)->image ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnFRPx77U9mERU_T1zyHcz9BOxbDQrL4Dvtg&s'),
                                ];
                            @endphp

                            <div style="background-color: #E9ECFF; border-radius: 40px;">
                                <div class="row" style="padding: 20px; align-items: center;">

                                    <div class="col-lg-3 text-center">
                                        <img src="{{   $instructor['image'] }}" alt="Instructor Image" style="max-width: 100%; border-radius: 50%;">
                                    </div>

                                    <div class="col-lg-9">
                                        <h3>{{ $instructor['name'] }}</h3>
                                        {{-- <p>{{ $instructor['role'] }}</p> --}}

                                        <p>
                                            <i style="color: #0E2293;" class="fa fa-users"></i> {{ number_format($instructor['students']) }} Students
                                            &nbsp;
                                            {{-- <i style="color: #FFF3CF;" class="fa fa-book"></i> {{ str_pad($instructor['courses'], 2, '0', STR_PAD_LEFT) }} Courses --}}
                                        </p>

                                        <p>{!! $instructor['bio'] !!}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>

                    </div>

                    <div class="tab-pane fade" id="outcome" role="tabpanel" aria-labelledby="outcome-tab">

                        @if(!is_null($course->outcome))
                    <section style="background-color: #FFF3CF;margin-top: 50px;margin-bottom: -60px">
                        <div class="container" style="padding: 30px; margin-top: -40px;">
                            <h3>Career Outcome</h3>


                            <div style="background-color: white; padding: 30px; border-radius: 30px;">
                                {!! $course->outcome !!}
                            </div>
                        </div>
                    </section>

                    @endif

                    </div>


                    <!-- Curriculum -->
                    <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                     @if (!is_null($course->curriculum))
                        @php
                            $decodedCurriculum = json_decode($course->curriculum, true);
                        @endphp

                        <section style="padding: 40px; background: #E9ECFF; margin-top: 50px;margin-bottom: -60px;">
    <div class="container mx-auto">
        <h3 style="margin-bottom: 15px; color: black; font-size: 2.5rem; font-weight: 700;">Course Curriculum</h3>
        <p style="margin-bottom: 40px; font-size: 1.1rem;">
            {{ count($decodedCurriculum) }} Sections •
            {{ collect($decodedCurriculum)->reduce(fn($carry, $item) => $carry + count($item['points']), 0) }} Lectures
        </p>

        <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); backdrop-filter: blur(10px);">
            @foreach ($decodedCurriculum as $index => $section)
                <div style="margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; transition: all 0.3s ease;">
                    <h3 onclick="toggleSection(this)" style="cursor: pointer; display: flex; justify-content: space-between; align-items: center; padding: 20px; margin: 0; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); font-size: 1.2rem; font-weight: 600; color: #334155; transition: all 0.3s ease;">
                        <span>{{ $section['title'] }}</span>
                        <span style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 30px; height: 30px; background: #FFC000; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                <i class="fa fa-play" style="color: white; font-size: 12px; margin-left: 2px;"></i>
                            </div>
                            <small style="color: #64748b; font-weight: 500;">{{ count($section['points']) }} lectures</small>
                            <i class="fa fa-chevron-down" style="color: #94a3b8; transition: transform 0.3s ease;"></i>
                        </span>
                    </h3>

                    <ul style="display: none; padding: 0; margin: 0; background: #fefefe;">
                        @foreach ($section['points'] as $i => $point)
                            <li style="padding: 15px 25px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 15px; transition: all 0.2s ease;">
                                <span style="width: 25px; height: 25px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #64748b;">{{ $i + 1 }}</span>
                                <a href="{{ $point['url'] }}" target="_blank" style="color: #475569; line-height: 1.5; text-decoration: none;">
                                    {{ $point['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endif

                        {{-- Toggle Script --}}
                        <script>
                            function toggleSection(header) {
                                const ul = header.nextElementSibling;
                                const icon = header.querySelector('.fa');

                                if (ul.style.display === "none" || ul.style.display === "") {
                                    ul.style.display = "block";
                                    icon.classList.remove('fa-play');
                                    icon.classList.add('fa-chevron-down');
                                } else {
                                    ul.style.display = "none";
                                    icon.classList.remove('fa-chevron-down');
                                    icon.classList.add('fa-play');
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>

            <!-- Enroll Modal -->
        </section>


        <section>
            <div class="container">
                <h3 class="text-bold">Related Courses</h3>

                
                @if (count($popular_courses) > 0)


    <section>
        <div class="container">

            <?php
            
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
                   @foreach($popular_courses as $index => $course)
                    <?php 
                                $amount_info = getUserLocalCurrencyConversion($course['price']);

                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex">

                            <a style="text-decoration: none; color: black;" href="{{route('course_external_detail', $course->course_url)}}">
                                <div class="course-card w-100 shadow-sm">
                                    <img src="{{ asset($course['image']) }}" class="img-fluid mb-2" style="height: 160px; object-fit: cover; border-radius: 5px;" />

                                    <div class="course-meta">
                                        <span style="background-color: #F5F5F5; padding: 4px 8px; border-radius: 4px;">{{ optional($course->cat)->name }}</span>
                                        <strong>{{ $amount_info['currency_symbol'] }} {{ $amount_info['converted_amount'] }}</strong>
                                    </div>

                                    <div class="course-title mt-2">
                                        {{ \Illuminate\Support\Str::limit($course['title'], 60) }}
                                    </div>

                                    <div class="row align-items-center mt-3 course-footer">
                                        <div class="col-2">
                                            <img src="{{ asset(optional($course->instructor_name)->image) }}" style="height: 30px; width: 30px; border-radius: 50%;" />
                                        </div>
                                        <div class="col-5 ps-0">
                                            <small class="text-muted">Course By</small><br/>
                                            <strong>{{ optional($course->instructor_name)->name }}</strong>
                                        </div>
                                        <div class="col-5 text-end">
                                            <small class="text-muted">{{ $course['student_count'] }} Students</small>
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
    @endif


            </div>
        </section>

        <!-- Include Bootstrap JS -->

        <!-- JavaScript for managing Overview Tab -->
    </main>

@endsection
