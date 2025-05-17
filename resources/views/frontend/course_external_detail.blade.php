
@extends('frontend.layout.app')

@section('content')
    <main class="main">

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
                        <h3 class="fw-bold" style="color: black;">Complete Website Responsive Design: from Figma to Webflow to Website Design</h3>
                        <p class="mb-4">3 in 1 Course: Learn to design websites with Figma, build with Webflow, and make a living freelancing.</p>

                        <!-- Instructor Info -->
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://www.foodallergy.org/sites/default/files/styles/635x460/public/2020-06/shutterstock_1375976735.jpg?h=45a22253&itok=6rPqSQOO"
                                 alt="Instructor" class="img-fluid rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                            <div class="ms-3">
                                <p class="mb-0 text-muted">Created by:</p>
                                <h6 class="mb-0 fw-bold">Dianne Russell</h6>
                            </div>
                        </div>

                        <!-- Video Preview -->
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF"
                                    title="YouTube video player" allowfullscreen style="border-radius: 10px;"></iframe>
                        </div>
                    </div>

                    <!-- Purchase Section -->
                    <div class="col-lg-4">
                        <div class="p-4 rounded" style="background-color: #FFF3CF;">
                            <h3 class="fw-bold mb-3 " style="color: black;">$14.00</h3>

                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fa fa-clock me-2"></i>Course Duration</span>
                                <span>6 Months</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fa fa-layer-group me-2"></i>Course Level</span>
                                <span>Beginner & Intermediate</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fa fa-users me-2"></i>Students Enrolled</span>
                                <span>69,419,618</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span><i class="fa fa-language me-2"></i>Language</span>
                                <span>Mandarin</span>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <span><i class="fa fa-closed-captioning me-2"></i>Subtitle</span>
                                <span>English</span>
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
                                <div class="modal-header bg-light text-dark">
                                    <h5  style="color: black;" class="modal-title" id="buyNowModalLabel">Purchase Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-semibold">You are about to purchase:</p>
                                    <h5 style="background-color: #E9ECFF; color: black; padding: 10px; border-radius: 10px;">Complete Website Responsive Design: from Figma to Webflow to Website Design</h5>
                                    <p class="mb-2"><i class="fa fa-clock me-1"></i> Duration: 6 Months</p>
                                    <p class="mb-2"><i class="fa fa-money-bill me-1"></i> Price: <strong>$14.00</strong></p>
                                    <div class="mb-3">
                                        <label for="paymentMethod" class="form-label fw-semibold">Select Payment Method</label>
                                        <select class="form-select rounded-3" id="paymentMethod">
                                            <option value="">-- Choose Payment Method --</option>
                                            <option value="card">Card</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="cash">Cash</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="paymentType" class="form-label fw-semibold">Select Payment Type</label>
                                        <select class="form-select rounded-3" id="paymentType">
                                            <option value="">-- Choose Payment Type --</option>
                                            <option value="full">Full Payment</option>
                                            <option value="installment">Installment</option>
                                        </select>
                                    </div>
                                    <p class="text-muted">Proceeding will take you to the checkout page.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="" class="btn btn-warning text-dark">Continue to Payment</a>
                                </div>
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
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="outcome-tab" data-bs-toggle="tab" data-bs-target="#outcome" type="button" role="tab">Career Outcome</button>
                    </li>

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

                </style>
                <!-- Tab Content -->
                <div class="tab-content" id="courseTabContent">
                    <!-- Overview -->

                    <!-- Description -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">


                        <section  style="background-color: #FFF3CF; margin-top: 50px; margin-bottom: -60px;" class="course_description">
                            <div style="padding: 30px; margin-top: -40px;" class="container">
                                <h3>Course Description</h3>
                                <div style="background-color: white; padding: 30px; border-radius: 30px;" class="">
                                    <p>
                                        Ready to unlock the power of the web? Join our Web Development course at OdumareTech and embark on a thrilling journey into the dynamic world of technology. This immersive program covers front-end development, equipping you with the skills needed to create stunning and interactive websites and web applications.
                                        In this course, you'll dive deep into the essential building blocks of web development, starting with HTML, CSS, and JavaScript. You'll learn to craft visually appealing web pages, master responsive design techniques, and bring interactivity to life through JavaScript. We'll guide you through the latest front-end frameworks, empowering you to build powerful user interfaces and manage complex data flows.
                                        Throughout the course, you'll tackle real-world challenges, collaborate with fellow learners, and receive expert guidance from our experienced instructors. By the end, you'll be well-versed in front-end development website development.
                                        Whether you're a beginner or an experienced professional, this course is designed to meet you at your skill level and guide you towards web development mastery. Join us at OdumareTech and unlock your potential to shape the digital world with your creativity and technical expertise. Enroll now and kickstart your journey into the exciting realm of web development!
                                    </p>
                                </div>
                            </div>
                        </section>

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
                        <section style="background-color:;" class="course_description">
                            <div style="padding: 30px; margin-top: -40px;" class="container">
                                <h3>Admission Requirements</h3>
                                <div style="background-color: #FFF3CF; padding: 30px; border-radius: 30px;">
                                    <p>
                                        1. <strong>Educational Background:</strong> You don’t need to have a certificate to apply for this diploma program. We expect anyone to take the program.<br><br>
                                        2. <strong>Language Proficiency:</strong> The course is conducted in English, so applicants must have a basic understanding of the English language to effectively engage with the curriculum and participate in discussions.<br><br>
                                        3. <strong>Assessment:</strong> All applicants will be required to take an assessment. However, we would provide you with a study kit to prepare you for the assessment.
                                    </p>
                                </div>
                            </div>
                        </section>

                    </div>


                    <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                        <section>
                            <div class="container">
                                <h3>Course Instructor</h3>

                                @php
                                    $instructor = [
                                        'name' => 'Dianne Russell',
                                        'role' => 'Entrepreneur & Designer • Founder of ShiftRide',
                                        'students' => 5324,
                                        'courses' => 1,
                                        'bio' => "I'm an entrepreneur & designer with a high passion for building products of all sorts and seeing ideas come to life. As a serial entrepreneur, I've designed and built projects in fields ranging from fashion to technology.",
                                        'image' => asset('frontend/assets/img/Ellipse 124.png'),
                                    ];
                                @endphp

                                <div style="background-color: #E9ECFF; border-radius: 40px;">
                                    <div class="row" style="padding: 20px; align-items: center;">

                                        <div class="col-lg-3 text-center">
                                            <img src="{{ $instructor['image'] }}" alt="Instructor Image" style="max-width: 100%; border-radius: 50%;">
                                        </div>

                                        <div class="col-lg-9">
                                            <h3>{{ $instructor['name'] }}</h3>
                                            <p>{{ $instructor['role'] }}</p>

                                            <p>
                                                <i style="color: #0E2293;" class="fa fa-users"></i> {{ number_format($instructor['students']) }} Students
                                                &nbsp;
                                                <i style="color: #FFF3CF;" class="fa fa-book"></i> {{ str_pad($instructor['courses'], 2, '0', STR_PAD_LEFT) }} Courses
                                            </p>

                                            <p>{{ $instructor['bio'] }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>

                    <div class="tab-pane fade" id="outcome" role="tabpanel" aria-labelledby="outcome-tab">

                        <section style="background-color: #FFF3CF; margin-top: 50px;margin-bottom: -60px;">
                            <div class="container" style="padding: 30px; margin-top: -40px;">
                                <h3>Career Outcome</h3>

                                @php
                                    $careerOutcomes = [
                                        [
                                            'title' => 'Educational Background',
                                            'description' => 'You don’t need to have a certificate to apply for this diploma program. We expect anyone to take the program.',
                                        ],
                                        [
                                            'title' => 'Language Proficiency',
                                            'description' => 'The course is conducted in English, so applicants must have a basic understanding of the English language to effectively engage with the curriculum and participate in discussions.',
                                        ],
                                        [
                                            'title' => 'Assessment',
                                            'description' => 'All applicants will be required to take an assessment. However, we would provide you with a study kit to prepare you for the assessment.',
                                        ],
                                    ];
                                @endphp

                                <div style="background-color: white; padding: 30px; border-radius: 30px;">
                                    <ul style="padding-left: 20px; list-style: decimal;">
                                        @foreach ($careerOutcomes as $outcome)
                                            <li style="margin-bottom: 20px;">
                                                <strong>{{ $outcome['title'] }}:</strong> {{ $outcome['description'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>

                    </div>


                    <!-- Curriculum -->
                    <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                        <section style="padding: 40px; background-color: #E9ECFF; margin-top: 50px; margin-bottom: -60px;">
                            <div style=" margin: auto;" class="container">
                                <h2 style="text-align: ; margin-bottom: 20px;">Curriculum</h2>
                                <p style="text-align: ; margin-bottom: 40px;">6 Sections • 202 Lectures</p>

                                <div style="background-color: #ffffff; padding: 30px; border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

                                    @php
                                        $curriculumData = [
                                            [
                                                'title' => 'Getting Started',
                                                'color' => '#FFC000',
                                                'lectures' => [
                                                    'What is Webflow?',
                                                    'Sign up in Webflow',
                                                    'Webflow Terms & Conditions',
                                                    'Teaser of Webflow',
                                                    'Practice Project',
                                                ],
                                            ],
                                            [
                                                'title' => 'Secret of Good Design',
                                                'color' => '#FF5733',
                                                'lectures' => [
                                                    'Practice Design Like an Artist',
                                                ],
                                            ],
                                            [
                                                'title' => 'Web Development (Webflow)',
                                                'color' => '#28A745',
                                                'lectures' => [
                                                    'Full Web Development Training using Webflow',
                                                ],
                                            ],
                                            [
                                                'title' => 'Secrets of Making Money Freelancing',
                                                'color' => '#FFC107',
                                                'lectures' => [
                                                    'Learn how to monetize your web design skills',
                                                ],
                                            ],
                                            [
                                                'title' => 'Advanced',
                                                'color' => '#6610f2',
                                                'lectures' => [
                                                    'Advanced Tips & Strategies for Professionals',
                                                ],
                                            ],
                                            [
                                                'title' => 'Course Outline',
                                                'color' => '#E83E8C',
                                                'lectures' => [
                                                    'Master creating websites that adapt seamlessly to all screen sizes.',
                                                    'Learn websockets and real-time communication for live updates.',
                                                    'Understand frontend frameworks like React and Vue.js.',
                                                    'Deploy frontend applications to various hosting platforms.',
                                                    'Communicate with server-side APIs to fetch and display data.',
                                                    'Follow coding standards, conventions, and code review processes.',
                                                    'Enhance website performance and user experience.',
                                                    'Prepare for frontend engineering job interviews and build a strong portfolio.',
                                                ],
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($curriculumData as $index => $section)
                                        <div style="margin-bottom: 20px;">
                                            <h3 onclick="toggleSection(this)" style="cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                                                <span>{{ $section['title'] }}</span>
                                                <span style="display: flex; align-items: center; gap: 5px;">
                            <i class="fa fa-play" style="color: #FFC000; border-radius: 100%; border: 1px solid   #FFC000;"></i>
                            <small>({{ count($section['lectures']) }})</small>
                        </span>
                                            </h3>
                                            <ul style="display: none; padding-left: 20px; margin-top: 10px;">
                                                @foreach ($section['lectures'] as $i => $lecture)
                                                    <li>{{ $i + 1 }}. {{ $lecture }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach


                                </div>
                                <div style="margin-top: 20px;">
                                    <h3>Course Outline</h3>
                                    <div>
                                        @php
                                            $courseOutline = [
                                                'Master the art of creating websites that adapt seamlessly to different screen sizes and devices, ensuring an optimal user experience.',
                                                'Learn about websockets and real-time communication to enable live updates and interactivity in your applications.',
                                                'Gain insights into popular frontend frameworks like React and Vue.js, enabling you to build robust and interactive web applications.',
                                                'Successfully deploy frontend applications to various hosting platforms and understand the deployment process.',
                                                'Learn how to communicate with server-side APIs to fetch and display data on your web applications.',
                                                'Acquire insights into industry standards, coding conventions, and code review processes to ensure code quality and collaboration.',
                                                'Explore techniques to enhance website performance, reduce loading times, and improve user experience.',
                                                'Prepare for frontend engineering job interviews by honing your skills and building a strong portfolio of projects.',
                                            ];
                                        @endphp

                                        @foreach ($courseOutline as $index => $point)
                                            <p>{{ $index + 1 }}. {{ $point }}</p>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </section>

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
                    ]
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

                                <a style="text-decoration: none; color: black;" href="">
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

        <!-- Include Bootstrap JS -->

        <!-- JavaScript for managing Overview Tab -->
    </main>

@endsection
