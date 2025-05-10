
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 40vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  flex-direction: column; /* Stack items vertically */
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
" class="section dark-background">

        <div style="max-width: 700px; margin-bottom: 20px; margin-top: 10px;">
            <h2 style="margin-top: 20px;">Web Development (Frontend)</h2>

        </div>

    </section>

    <?php

    $sections = [
        [
            'details' => [
                ['label' => 'Course', 'value' => 'Web Development'],
                ['label' => 'Program Length', 'value' => '16 Weeks'],
            ],
        ],
        [
            'details' => [
                ['label' => 'Course', 'value' => 'Data Science'],
                ['label' => 'Program Length', 'value' => '24 Weeks'],
            ],
        ],
        [
            'details' => [
                ['label' => 'Course', 'value' => 'UI/UX Design'],
                ['label' => 'Program Length', 'value' => '12 Weeks'],
            ],
        ],
    ];

    ?>
    <section  style="background-color: #FFF3CF;  padding: 20px;" class="course_info">
        @foreach($sections as $section)
                    <div class="row" style="padding: 5px;">
                        @foreach($section['details'] as $detail)
                            <div class="col-lg-6">
                                <div style="font-size: 1.1rem; color: #333;">
                                    {{ $detail['label'] }}:
                                    <span style="background-color: #fff; padding: 8px 12px; border-radius: 6px; display: inline-block;">
                                {{ $detail['value'] }}
                                  </span>
                                </div>
                            </div>
                        @endforeach
                </div>
        @endforeach

    </section>


    <section>
        <div class="">
            <!-- Tabs -->
            <ul class="nav nav-tabs nav-fill container" id="courseTab" role="tablist" style="background-color: #E9ECFF; padding: 15px; border-radius: 10px;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="requirement-tab" data-bs-toggle="tab" data-bs-target="#requirement" type="button" role="tab">Requirement</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab">Curriculum</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cost-tab" data-bs-toggle="tab" data-bs-target="#cost" type="button" role="tab">Cost</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab">Instructor</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="outcome-tab" data-bs-toggle="tab" data-bs-target="#outcome" type="button" role="tab">Career Outcome</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="enroll-tab" data-bs-toggle="modal" data-bs-target="#enrollModal" type="button" role="tab">Enroll</button>
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
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <section style="background-color: ; padding: 60px 0;" class="accelerate text-white">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF" title="YouTube video player" allowfullscreen style="border-radius: 10px;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <section style="background-color: #FFF3CF;" class="course_description">
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

                    {{-- Curriculum Section --}}
                    <section style="padding: 40px; background-color: #E9ECFF;">
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

                    {{-- Load Font Awesome (if you haven't already) --}}


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

                    <section style="background-color: #FFF3CF;">
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

                <!-- Description -->
                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">


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
        <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-0 pb-0">
                        <h1 class="modal-title fs-4 fw-bold" id="enrollModalLabel">Enroll Now</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class=" p-4 rounded-3 mb-4 text-center fw-semibold" style="background-color: #E9ECFF;">
                            Web Development (Frontend)
                        </div>
                        <form>

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
                            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">Submit Enrollment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="popular-section py-5">
        <div class="container popular">
            <h2>Free Course Recommendations</h2>
            <div class="section-header text-center mb-5">
                <!-- You can add a heading or description here if you want -->
            </div>
            <div class="course-list row g-4">
                <?php
                $courses = [
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Web Development',
                        'title' => 'Frontend Development',
                        'description' => 'This immersive program covers front-end development, equipping you with the skills needed to create stunning and interactive websites and web applications.',
                        'weeks' => '4 Weeks',
                        'level' => 'Beginner',
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Data Science',
                        'title' => 'Data Analytics',
                        'description' => 'Learn how to work with data, analyze patterns, and make decisions using real-world datasets and powerful tools like Python and SQL.',
                        'weeks' => '6 Weeks',
                        'level' => 'Intermediate',
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Cybersecurity',
                        'title' => 'Ethical Hacking',
                        'description' => 'Master the skills needed to protect systems and networks from cyber attacks with hands-on ethical hacking training.',
                        'weeks' => '8 Weeks',
                        'level' => 'Advanced',
                    ]
                    // Add more courses if needed
                ];

                $colors = ['#E9ECFF']; // alternating background colors

                foreach ($courses as $index => $course) {
                    $colorIndex = floor($index / 2) % count($colors);
                    $bgColor = $colors[$colorIndex];
                    ?>
                <div class="col-lg-4 col-md-6">
                    <div style="background-color: <?php echo $bgColor; ?>;" class="course-card p-3 shadow-sm rounded-4 position-relative">
                        <div class="course-image position-relative">
                            <img src="<?php echo $course['image']; ?>" alt="Course Image" class="img-fluid rounded-3">
                            <span style="background-color: #FFC000; color: white; position: absolute; top: 10px; left: 10px; padding: 5px 10px; border-radius: 5px; font-size: 14px;"><?php echo $course['category']; ?></span>
                        </div>
                        <h3 class="mt-3"><?php echo $course['title']; ?></h3>
                        <p class="text-muted"><?php echo $course['description']; ?></p>
                        <div class="mb-3">
                            <span style="padding: 5px 10px; background-color: white; border-radius: 10px; font-size: 14px;"><?php echo $course['weeks']; ?></span>
                            <span style="background-color: #FFF0DC; color: #FF9500; padding: 5px 10px; border-radius: 10px; font-size: 14px;"><?php echo $course['level']; ?></span>
                        </div>
                        <a href="{{route('course.detail')}}" style="background-color: #0E2293; border: none;" class="btn btn-primary btn-lg fw-bold">Start Learning</a>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Include Bootstrap JS -->

    <!-- JavaScript for managing Overview Tab -->
</main>

@endsection
