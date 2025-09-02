
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
            <h2 style="margin-top: 20px;">{{$course->title}}</h2>

        </div>


    </section>

<?php

$conversion = getUserLocalCurrencyConversion($course->price);

?>
    @php
        $sections = [
            [
                'details' => [
                    ['label' => 'Course', 'value' => $course->title],
                    ['label' => 'Program Length', 'value' => $course->duration . ' Weeks'],
                ],
            ],
            [
                'details' => [
                    ['label' => 'Certificate', 'value' => $course->certification],
                    ['label' => 'Start Date', 'value' => $course->start_date],
                ],
            ],
            [
                'details' => [
                    ['label' => 'Application Fee', 'value' => $conversion['currency_symbol'] . $conversion['converted_amount']],
                    ['label' => 'Location', 'value' => 'Virtual'],
                ],
            ],
        ];
    @endphp

    <section class="course_info py-4 px-3" style="background-color: #FFF3CF;">
        @foreach($sections as $section)
            <div class="row mb-3">
                @foreach($section['details'] as $detail)
                    <div class="col-md-6 mb-2">
                        <div class="d-flex flex-wrap align-items-center" style="font-size: 1.05rem; color: #333;">
                            <strong style="min-width: 150px;">{{ $detail['label'] }}:</strong>
                            <span class="bg-white px-3 py-2 rounded shadow-sm" style="flex: 1;">
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
                                <div class="w-100">
                                    <img src="{{ asset($course->image) }}" alt="Course Image" class="w-100" style="max-height: 800px; object-fit: cover;">
                                </div>


                                {{--                                    <div class="ratio ratio-16x9">--}}
                                {{--                                        <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF" title="YouTube video player" allowfullscreen style="border-radius: 10px;"></iframe>--}}
                                {{--                                    </div>--}}
                            </div>
                        </div>
                    </section>


                    @if(!is_null($course->description))
                        <section style="background-color: #FFF3CF;" class="course_description">
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
                    {{-- Curriculum Section --}}

                    @if (!is_null($course->curriculum))
                        @php
                            $decodedCurriculum = json_decode($course->curriculum, true);
                        @endphp

                        <section style="padding: 40px; background: #E9ECFF;">
                            <div class="container mx-auto">
                                <h3 style="margin-bottom: 15px; color: black; font-size: 2.5rem; font-weight: 700; text-align: ;">Course Curriculum</h3>
                                <p style="margin-bottom: 40px;  font-size: 1.1rem;">
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
                                                        <span style="color: #475569; line-height: 1.5;">{{ $point }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        <style>
                            .curriculum-section h3:hover {
                                background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%) !important;
                                transform: translateY(-1px);
                            }

                            .curriculum-section li:hover {
                                background: #f8fafc !important;
                            }

                            .curriculum-section li:last-child {
                                border-bottom: none !important;
                            }

                            .curriculum-section .expanded .fa-chevron-down {
                                transform: rotate(180deg);
                            }

                            .curriculum-section .expanded .fa-play {
                                animation: pulse 1s infinite;
                            }

                            @keyframes pulse {
                                0% { transform: scale(1); }
                                50% { transform: scale(1.1); }
                                100% { transform: scale(1); }
                            }
                        </style>

                        <script>
                            function toggleSection(header) {
                                const ul = header.nextElementSibling;
                                const chevron = header.querySelector('.fa-chevron-down');
                                const section = header.parentElement;

                                if (ul.style.display === 'none' || ul.style.display === '') {
                                    ul.style.display = 'block';
                                    section.classList.add('expanded');
                                    chevron.style.transform = 'rotate(180deg)';
                                } else {
                                    ul.style.display = 'none';
                                    section.classList.remove('expanded');
                                    chevron.style.transform = 'rotate(0deg)';
                                }
                            }
                        </script>
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

                    {{-- Load Font Awesome (if you haven't already) --}}


                    @php
                        $actualPrice = floatval($conversion['converted_amount']);
                        $installmentPercent = 40;
                        $installmentAmount = round($actualPrice * $installmentPercent / 100, 2);

                        $plans = [
                            [
                                'title' => 'Installment',
                                'price' => $conversion['currency_symbol'] . number_format($installmentAmount),
                                'description' => 'Pay ₦' . number_format($installmentAmount) . ' upfront, then weekly until the full ₦' . number_format($actualPrice) . ' is covered.',
                                'popular' => false,
                                'background' => '#FFF3CF',
                            ],
                            [
                                'title' => 'Full Payment',
                                'price' => $conversion['currency_symbol'] . number_format($actualPrice),
                                'description' => 'Pay once and enjoy full access. Save more with a one-time payment.',
                                'popular' => true,
                                'background' => '#E9ECFF',
                            ],
                        ];
                    @endphp

                    <section class="py-5" style="background: #f8f9fa;">
                        <div class="container">
                            <h2>Cost</h2>

                            <div class="row">
                                @foreach ($plans as $plan)
                                    <div class="col-md-6 mb-4">
                                        <div style="background-color: {{ $plan['background'] }}; padding: 30px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: 0.3s;">

                                            @if ($plan['popular'])
                                                <span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background-color: #FFC000; color: white; padding: 5px 12px; border-radius: 30px; font-size: 12px; font-weight: bold;">
                                Most Popular
                            </span>
                                            @endif

                                            <h5 style="font-weight: bold;">{{ $plan['title'] }}</h5>
                                            <h2 class="my-3" style="color: #333;">{{ $plan['price'] }}</h2>
                                            <p style="font-size: 0.95rem; color: #555;">{{ $plan['description'] }}</p>

{{--                                            <button class="btn btn-primary mt-3">Choose Plan</button>--}}
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
                                    'name' => optional($course->instructor_name)->first_name . " ". optional($course->instructor_name)->last_name,
                                    'role' => 'Entrepreneur & Designer • Founder of ShiftRide',
                                    'students' => optional($course->instructor_name)->student_count,
                                    'courses' => optional($course->instructor_name)->student_count,
                                    'bio' => optional($course->instructor_name)->about_me,
                                    'image' => asset(optional($course->instructor_name)->image),
                                ];
                            @endphp

                            <div style="background-color: #E9ECFF; border-radius: 40px;">
                                <div class="row" style="padding: 20px; align-items: center;">

                                    <div class="col-lg-3 text-center">
                                        <img src="{{ $instructor['image'] }}" alt="Instructor Image" style="max-width: 100%; border-radius: 50%;">
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


                    @if(!is_null($course->outcome))
                    <section style="background-color: #FFF3CF;">
                        <div class="container" style="padding: 30px; margin-top: -40px;">
                            <h3>Career Outcome</h3>


                            <div style="background-color: white; padding: 30px; border-radius: 30px;">
                                {!! $course->outcome !!}
                            </div>
                        </div>
                    </section>

                    @endif




                </div>

                <!-- Description -->
                <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">


                    @if(!is_null($course->description))
                        <section style="background-color: #FFF3CF; margin-top: 60px;" class="course_description">
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

                    @php
                        $actualPrice = floatval($conversion['converted_amount']);
                        $installmentPercent = 40;
                        $installmentAmount = round($actualPrice * $installmentPercent / 100, 2);

                        $plans = [
                            [
                                'title' => 'Installment',
                                'price' => $conversion['currency_symbol'] . number_format($installmentAmount),
                                'description' => 'Pay ₦' . number_format($installmentAmount) . ' upfront, then weekly until the full ₦' . number_format($actualPrice) . ' is covered.',
                                'popular' => false,
                                'background' => '#FFF3CF',
                            ],
                            [
                                'title' => 'Full Payment',
                                'price' => $conversion['currency_symbol'] . number_format($actualPrice),
                                'description' => 'Pay once and enjoy full access. Save more with a one-time payment.',
                                'popular' => true,
                                'background' => '#E9ECFF',
                            ],
                        ];
                    @endphp
                    <section class="py-5" style="background: #f8f9fa; margin-top: 60px;">
                        <div class="container">
                            <h2>Cost</h2>

                            <div class="row">
                                @foreach ($plans as $plan)
                                    <div class="col-md-6 mb-4">
                                        <div style="background-color: {{ $plan['background'] }}; padding: 30px; border-radius: 12px; text-align: center; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: 0.3s;">

                                            @if ($plan['popular'])
                                                <span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background-color: #FFC000; color: white; padding: 5px 12px; border-radius: 30px; font-size: 12px; font-weight: bold;">
                                Most Popular
                            </span>
                                            @endif

                                            <h5 style="font-weight: bold;">{{ $plan['title'] }}</h5>
                                            <h2 class="my-3" style="color: #333;">{{ $plan['price'] }}</h2>
                                            <p style="font-size: 0.95rem; color: #555;">{{ $plan['description'] }}</p>

                                            {{--                                            <button class="btn btn-primary mt-3">Choose Plan</button>--}}
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

                    @if(!is_null($course->outcome)))
                    <section style="background-color: #FFF3CF; margin-top: 60px;">
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

                        <section style="padding: 40px; background: #E9ECFF; margin-top: 60px;">
                            <div class="container mx-auto">
                                <h3 style="margin-bottom: 15px; color: black; font-size: 2.5rem; font-weight: 700; text-align: ;">Course Curriculum</h3>
                                <p style="margin-bottom: 40px;  font-size: 1.1rem;">
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
                                                        <span style="color: #475569; line-height: 1.5;">{{ $point }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        <style>
                            .curriculum-section h3:hover {
                                background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%) !important;
                                transform: translateY(-1px);
                            }

                            .curriculum-section li:hover {
                                background: #f8fafc !important;
                            }

                            .curriculum-section li:last-child {
                                border-bottom: none !important;
                            }

                            .curriculum-section .expanded .fa-chevron-down {
                                transform: rotate(180deg);
                            }

                            .curriculum-section .expanded .fa-play {
                                animation: pulse 1s infinite;
                            }

                            @keyframes pulse {
                                0% { transform: scale(1); }
                                50% { transform: scale(1.1); }
                                100% { transform: scale(1); }
                            }
                        </style>

                        <script>
                            function toggleSection(header) {
                                const ul = header.nextElementSibling;
                                const chevron = header.querySelector('.fa-chevron-down');
                                const section = header.parentElement;

                                if (ul.style.display === 'none' || ul.style.display === '') {
                                    ul.style.display = 'block';
                                    section.classList.add('expanded');
                                    chevron.style.transform = 'rotate(180deg)';
                                } else {
                                    ul.style.display = 'none';
                                    section.classList.remove('expanded');
                                    chevron.style.transform = 'rotate(0deg)';
                                }
                            }
                        </script>
                    @endif

                </div>
            </div>
        </div>

        <!-- Enroll Modal -->
{{--        <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content border-0 shadow-lg rounded-4">--}}
{{--                    <div class="modal-header border-0 pb-0">--}}
{{--                        <h1 class="modal-title fs-4 fw-bold" id="enrollModalLabel">Enroll Now</h1>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class=" p-4 rounded-3 mb-4 text-center fw-semibold" style="background-color: #E9ECFF;">--}}
{{--                            Web Development (Frontend)--}}
{{--                        </div>--}}
{{--                        <form>--}}

{{--                            <div class="mb-3">--}}
{{--                                <label for="paymentMethod" class="form-label fw-semibold">Select Payment Method</label>--}}
{{--                                <select class="form-select rounded-3" id="paymentMethod">--}}
{{--                                    <option value="">-- Choose Payment Method --</option>--}}
{{--                                    <option value="card">Card</option>--}}
{{--                                    <option value="bank_transfer">Bank Transfer</option>--}}
{{--                                    <option value="cash">Cash</option>--}}
{{--                                    <option value="paypal">PayPal</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <label for="paymentType" class="form-label fw-semibold">Select Payment Type</label>--}}
{{--                                <select class="form-select rounded-3" id="paymentType">--}}
{{--                                    <option value="">-- Choose Payment Type --</option>--}}
{{--                                    <option value="full">Full Payment</option>--}}
{{--                                    <option value="installment">Installment</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold">Submit Enrollment</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

      @php
    $installmentPercent = 40;

    // Start with base price
    $basePrice = $course->price;
    $discountedPrice = $basePrice;

    // Apply course discount if available
    if ($course->discount) {
        $discountedPrice -= $basePrice * ($course->discount / 100);
    }

    // Apply coupon if the user has one
    if ($check_user_has_coupon) {
        $discountedPrice -= $basePrice * ($coupon_check->discount / 100);
    }
$discountedPrice = getUserLocalCurrencyConversion($discountedPrice)['converted_amount'];


    // Now use converted discounted amount (already done elsewhere)
    $convertedAmount = floatval($conversion['converted_amount']);
    $installmentAmount = round($convertedAmount * $installmentPercent / 100, 2);

    // Format
    $formattedFullPrice = $conversion['currency_symbol'] . number_format($convertedAmount, 2);
    $formattedInstallment = $conversion['currency_symbol'] . number_format($installmentAmount, 2);
@endphp

<div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h1 class="modal-title fs-4 fw-bold" id="enrollModalLabel">Enroll Now</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="p-4 rounded-3 mb-4 text-center fw-semibold" style="background-color: #E9ECFF;">
                    {{ $course->title }}
                </div>

                <form method="POST" action="{{ route('pay') }}">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="cohort_id" value="{{ $cohort_name?->id ?? 1 }}">
                    <input type="hidden" name="payment" value="flutterwave">
                    <input type="hidden" name="currency" value="{{ $conversion['currency_code'] }}">

                    @if(Auth::check())
                        <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="amount" value="{{ round($discountedPrice, 2) }}">

                        <div class="mb-3">
                            <label for="paymentType" class="form-label fw-semibold">Select Payment Type</label>
                            <select class="form-select rounded-3" id="paymentType" name="payment_type" required>
                                <option value="">-- Choose Payment Type --</option>
                                <option value="installment">Installment ({{ $formattedInstallment }} upfront)</option>
                                <option value="full">Full Payment ({{ $formattedFullPrice }})</option>
                            </select>
                        </div>

                        @if($has_pending)
                            <button type="button" class="btn btn-danger cta-btn radius-xl">
                                You Already Registered for a Course.
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary cta-btn radius-xl text-uppercase">
                                Enroll
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary cta-btn radius-xl text-uppercase">
                            Enroll
                        </a>
                    @endif
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
                $colors = ['#E9ECFF', '#FFF3CF']; // alternating background colors

                foreach ($courses as $index => $course) {
                    $colorIndex = floor($index / 2) % count($colors);
                    $bgColor = $colors[$colorIndex];
                    ?>
                <div class="col-lg-4 col-md-4">
                    <div style="background-color: <?php echo $bgColor; ?>;" class="course-card p-3 shadow-sm rounded-4 position-relative">
                        <div class="course-image position-relative">
                            <img src=" {{asset($course['image'])}}" alt="Course Image" class="img-fluid rounded-3">
                            <span style="background-color: #FFC000; color: white; position: absolute; top: 10px; left: 10px; padding: 5px 10px; border-radius: 5px; font-size: 14px;">{{ optional($course->cat)->name }}</span>
                        </div>
                        <h3 class="mt-3"><?php echo $course['title']; ?></h3>
                        <p class="text-muted"><?php echo $course['description']; ?></p>
                        <div class="mb-3">
                            <span style="padding: 5px 10px; background-color: white; border-radius: 10px; font-size: 14px;"><?php echo $course['duration']; ?> Weeks</span>
                            <span style="background-color: #FFF0DC; color: #FF9500; padding: 5px 10px; border-radius: 10px; font-size: 14px;"><?php echo $course['level']; ?></span>
                        </div>
                        <a href="{{route('course.detail', $course->course_url)}}" style="background-color: #0E2293; border: none;" class="btn btn-primary btn-lg fw-bold">Start Learning</a>
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
