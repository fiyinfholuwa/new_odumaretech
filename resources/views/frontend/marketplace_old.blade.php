
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 70vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
" class="section dark-background">
        <div  class="text-center" style="max-width: 800px; margin-top: 150px;  padding: 20px;">
            <h2 style="margin-top: 20px;">The Marketplace for Quality Online Courses
            </h2>

            <p style="margin: 15px 0;">
Browse a wide range of courses from expert instructors, or become a creator and share your own
knowledge with the world. Whether you’re here to learn new skills or teach what you know, our marketplace
is your gateway to growth.   </p>            
 <a href="{{route('course_list')}}" class="btn btn-warning" style="margin-bottom: 20px;">View Courses</a>

            <?php
            $stats = [
                ['count' => 10000, 'label' => 'Courses Available', 'suffix' => '+'],
                ['count' => 5000, 'label' => 'Expert Instructors', 'suffix' => '+'],
                ['count' => 15, 'label' => 'Students Worldwide', 'suffix' => 'M+'],
                ['count' => 25, 'label' => 'Instructor Earnings', 'prefix' => '$', 'suffix' => 'M+']
            ];
            ?>
            <div style="margin-top: 50px; margin-bottom: 40px;" class="row">
                <?php foreach ($stats as $index => $stat): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4 d-flex">
                    <div class="text-center p-4 shadow rounded flex-fill" style="background-color: white; min-height: 150px;">
                        <h3 class="text-primary fw-bold counter"
                            data-target="<?= $stat['count'] ?>"
                            data-prefix="<?= $stat['prefix'] ?? '' ?>"
                            data-suffix="<?= $stat['suffix'] ?? '' ?>">
                            0
                        </h3>
                        <p class="mb-0 text-muted"><?= $stat['label'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const counters = document.querySelectorAll('.counter');
                    const duration = 2000; // 2 seconds for all counters

                    counters.forEach(counter => {
                        const target = +counter.getAttribute('data-target');
                        const prefix = counter.getAttribute('data-prefix') || '';
                        const suffix = counter.getAttribute('data-suffix') || '';
                        const start = 0;
                        const frameRate = 60;
                        const totalFrames = Math.round((duration / 1000) * frameRate);
                        let frame = 0;

                        const counterInterval = setInterval(() => {
                            frame++;
                            const progress = frame / totalFrames;
                            const current = Math.round(target * progress);
                            counter.innerText = prefix + formatNumber(current) + suffix;

                            if (frame === totalFrames) {
                                clearInterval(counterInterval);
                                counter.innerText = prefix + formatNumber(target) + suffix;
                            }
                        }, 1000 / frameRate);
                    });

                    function formatNumber(num) {
                        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                });
            </script>

        </div>

    </section>


    <section style="">
        <div class="company container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem;">Browse Top Category</h2>
            </div>

            <?php
            
            $backgrounds = ['#E9ECFF', '#FFF3CF', '#EBFFEE']; // Backgrounds to rotate
            ?>

            <div class="row">
    <?php foreach ($categories as $index => $category): ?>
        <?php $bgColor = $backgrounds[$index % count($backgrounds)]; ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex"> <!-- make column flex -->
            <div class="category-card row mx-1 py-3 rounded w-100" style="background-color: <?= $bgColor ?>;">
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <span style="background-color: white; padding: 10px;">
                        <i class="fa fa-briefcase text-dark"></i>
                    </span>
                </div>
                <div class="col-9">
                    <h6 class="mb-1"><?= $category['name'] ?></h6>
                    <p class="mb-0 text-muted"><?= $category['courses'] ?> Courses</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

        </div>
    </section>

        @if (count($best_selling) > 0)


    <section>
        <div class="container">
            <h3 class="text-center">Best Selling Courses</h3>

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
                @foreach($best_selling as $index => $course)
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



        @if (count($featured_courses) > 0)

    <section class="py-5">
        <div class="container">
            <h3 class="mb-4 fw-bold text-center">Featured Courses</h3>

            @foreach($featured_courses as $index => $course)
            
            <?php

            $amount_info = getUserLocalCurrencyConversion($course['price']);
            ?>
                @if($index % 2 === 0)
                    <div class="row mb-4">
                        @endif

                        <div class="col-lg-6 mb-3">
                            <a href="{{route('course_external_detail', $course->course_url)}}">
                                <div class="d-flex bg-white shadow-sm rounded p-3 h-100" style="min-height: 200px;">
                                    <div class="me-3" style="width: 160px; flex-shrink: 0;">
                                        <img src="{{ asset($course['image']) }}" class="img-fluid rounded" style="height: 100%; object-fit: cover;" alt="Course image">
                                    </div>
                                    <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                        <div>
                                            <span class="badge" style="background-color: {{ $course['bg'] }}; color: black; font-size: 0.75rem; padding: 4px 10px;">{{ optional($course->cat)->name }}</span>
                                            <h5 class="mt-2 fw-semibold" style="font-size: 1.05rem;">{{ \Illuminate\Support\Str::limit($course['title'], 60) }}</h5>
                                        </div>
                                        <div class="mt-2 d-flex align-items-center">
                                            <img src="{{ asset(optional($course->instructor_name)->image) }}" style="height: 32px; width: 32px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                                            <small class="text-muted me-auto">{{ optional($course->instructor_name)->name }}</small>
                                            <strong class="text-primary">{{ $amount_info['currency_symbol'] }} {{ $amount_info['converted_amount'] }}</strong>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-between text-muted small">
                                            <span><i class="fa fa-users me-1"></i>{{ $course['student_count'] }} students</span>
                                            <span><i class="fa fa-signal me-1"></i>{{ $course['level'] }}</span>
                                            <span><i class="fa fa-clock me-1"></i>{{ $course['duration'] }}hoursr</span>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>

                        @if($index % 2 === 1 || $loop->last)
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif


   


</main>

@endsection
