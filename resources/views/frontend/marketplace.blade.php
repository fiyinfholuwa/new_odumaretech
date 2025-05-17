
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 60vh;
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
                Browse thousands of courses from expert instructors or sell your own knowledge and skills            </p>
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
            $categories = [
                ['name' => 'Programming', 'courses' => 63, 'icon' => 'fa-code'],
                ['name' => 'Business', 'courses' => 52, 'icon' => 'fa-briefcase'],
                ['name' => 'Finance & Accounting', 'courses' => 33, 'icon' => 'fa-chart-line'],
                ['name' => 'IT & Software', 'courses' => 22, 'icon' => 'fa-network-wired'],
                ['name' => 'Office Productivity', 'courses' => 13, 'icon' => 'fa-desktop'],
                ['name' => 'Personal Development', 'courses' => 20, 'icon' => 'fa-user-graduate'],
                ['name' => 'Marketing', 'courses' => 12, 'icon' => 'fa-bullhorn'],
                ['name' => 'Photography & Video', 'courses' => 6, 'icon' => 'fa-camera-retro'],
                ['name' => 'Lifestyle', 'courses' => 2, 'icon' => 'fa-spa'],
                ['name' => 'Design', 'courses' => 26, 'icon' => 'fa-pencil-ruler'],
                ['name' => 'Health & Fitness', 'courses' => 16, 'icon' => 'fa-heartbeat'],
                ['name' => 'Music', 'courses' => 95, 'icon' => 'fa-music'],
            ];

            $backgrounds = ['#E9ECFF', '#FFF3CF', '#EBFFEE']; // Backgrounds to rotate
            ?>

            <div class="row">
                <?php foreach ($categories as $index => $category): ?>
                    <?php $bgColor = $backgrounds[$index % count($backgrounds)]; ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="row mx-1 py-3 rounded" style="background-color: <?= $bgColor ?>;">
                        <div class="col-3 d-flex align-items-center justify-content-center">
                    <span style="background-color: white; padding: 10px;">
                        <i class="fa <?= $category['icon'] ?> text-dark"></i>
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



    <section>
        <div class="container">
            <h3 class="text-center">Best Selling Courses</h3>

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



    @php
        $featuredCourses = [
            [
                'image' => asset('frontend/assets/img/image-6.png'),
                'category' => 'Programming',
                'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data Science',
                'instructor_img' => asset('frontend/assets/img/image-6.png'),
                'instructor' => 'Kevin Gilbert',
                'price' => '$14.00',
                'students' => '265.7K',
                'level' => 'Beginner',
                'duration' => '6 Hours',
                'bg' => '#E1F7E3'
            ],[
                'image' => asset('frontend/assets/img/image-6.png'),
                'category' => 'Programming',
                'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data Science',
                'instructor_img' => asset('frontend/assets/img/image-6.png'),
                'instructor' => 'Kevin Gilbert',
                'price' => '$14.00',
                'students' => '265.7K',
                'level' => 'Beginner',
                'duration' => '6 Hours',
                'bg' => '#E1F7E3'
            ],[
                'image' => asset('frontend/assets/img/image-6.png'),
                'category' => 'Programming',
                'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data Science',
                'instructor_img' => asset('frontend/assets/img/image-6.png'),
                'instructor' => 'Kevin Gilbert',
                'price' => '$14.00',
                'students' => '265.7K',
                'level' => 'Beginner',
                'duration' => '6 Hours',
                'bg' => '#E1F7E3'
            ],[
                'image' => asset('frontend/assets/img/image-6.png'),
                'category' => 'Programming',
                'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data Science',
                'instructor_img' => asset('frontend/assets/img/image-6.png'),
                'instructor' => 'Kevin Gilbert',
                'price' => '$14.00',
                'students' => '265.7K',
                'level' => 'Beginner',
                'duration' => '6 Hours',
                'bg' => '#E1F7E3'
            ],[
                'image' => asset('frontend/assets/img/image-6.png'),
                'category' => 'Programming',
                'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data Science',
                'instructor_img' => asset('frontend/assets/img/image-6.png'),
                'instructor' => 'Kevin Gilbert',
                'price' => '$14.00',
                'students' => '265.7K',
                'level' => 'Beginner',
                'duration' => '6 Hours',
                'bg' => '#E1F7E3'
            ],[
                'image' => asset('frontend/assets/img/image-6.png'),
                'category' => 'Programming',
                'title' => 'Machine Learning A-Z™: Hands-On Python & R In Data Science',
                'instructor_img' => asset('frontend/assets/img/image-6.png'),
                'instructor' => 'Kevin Gilbert',
                'price' => '$14.00',
                'students' => '265.7K',
                'level' => 'Beginner',
                'duration' => '6 Hours',
                'bg' => '#E1F7E3'
            ],
            // Add 5 more courses...
        ];
    @endphp

    <section class="py-5">
        <div class="container">
            <h3 class="mb-4 fw-bold text-center">Featured Courses</h3>

            @foreach($featuredCourses as $index => $course)
                @if($index % 2 === 0)
                    <div class="row mb-4">
                        @endif

                        <div class="col-lg-6 mb-3">
                            <a href="{{route('course_external_detail')}}">
                                <div class="d-flex bg-white shadow-sm rounded p-3 h-100" style="min-height: 200px;">
                                    <div class="me-3" style="width: 160px; flex-shrink: 0;">
                                        <img src="{{ $course['image'] }}" class="img-fluid rounded" style="height: 100%; object-fit: cover;" alt="Course image">
                                    </div>
                                    <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                        <div>
                                            <span class="badge" style="background-color: {{ $course['bg'] }}; color: black; font-size: 0.75rem; padding: 4px 10px;">{{ $course['category'] }}</span>
                                            <h5 class="mt-2 fw-semibold" style="font-size: 1.05rem;">{{ \Illuminate\Support\Str::limit($course['title'], 60) }}</h5>
                                        </div>
                                        <div class="mt-2 d-flex align-items-center">
                                            <img src="{{ $course['instructor_img'] }}" style="height: 32px; width: 32px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                                            <small class="text-muted me-auto">{{ $course['instructor'] }}</small>
                                            <strong class="text-primary">{{ $course['price'] }}</strong>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-between text-muted small">
                                            <span><i class="fa fa-users me-1"></i>{{ $course['students'] }} students</span>
                                            <span><i class="fa fa-signal me-1"></i>{{ $course['level'] }}</span>
                                            <span><i class="fa fa-clock me-1"></i>{{ $course['duration'] }}</span>
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


    @php
        $instructors = [
            [
                'name' => 'Devon Lane',
                'title' => 'Senior Developer',
                'students' => 845,
                'earnings' => '$265k+',
                'image' => 'https://media.istockphoto.com/id/1468138682/photo/happy-elementary-teacher-in-front-of-his-students-in-the-classroom.jpg?s=612x612&w=0&k=20&c=E6m0JNBcrQBkPl0dr5CcTrYZiUm6fwMmgaiQfR8uW7s='
            ],
            [
                'name' => 'Courtney Henry',
                'title' => 'UI/UX Designer',
                'students' => 920,
                'earnings' => '$198k+',
                'image' => 'https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg'
            ],
            [
                'name' => 'Wade Warren',
                'title' => 'Data Analyst',
                'students' => 780,
                'earnings' => '$155k+',
                'image' => 'https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg'
            ],
            [
                'name' => 'Esther Howard',
                'title' => 'Marketing Expert',
                'students' => 1025,
                'earnings' => '$289k+',
                'image' => 'https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg'
            ],
            [
                'name' => 'Albert Flores',
                'title' => 'Cybersecurity Lead',
                'students' => 600,
                'earnings' => '$175k+',
                'image' => 'https://images.pexels.com/photos/3183197/pexels-photo-3183197.jpeg'
            ],
            [
                'name' => 'Brooklyn Simmons',
                'title' => 'Project Manager',
                'students' => 890,
                'earnings' => '$204k+',
                'image' => 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg'
            ],
            [
                'name' => 'Guy Hawkins',
                'title' => 'AI Engineer',
                'students' => 740,
                'earnings' => '$232k+',
                'image' => 'https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg'
            ],
            [
                'name' => 'Dianne Russell',
                'title' => 'Finance Coach',
                'students' => 965,
                'earnings' => '$310k+',
                'image' => 'https://images.pexels.com/photos/1130626/pexels-photo-1130626.jpeg'
            ],
        ];
    @endphp

    <section style="background-color: #FFF3CF; padding: 60px 0;">
        <div class="container">
            <h3 class="mb-4 fw-bold text-center">Top Instructors</h3>
            <div class="row">
                @foreach($instructors as $instructor)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="border-radius: 20px;">
                            <img src="{{ $instructor['image'] }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $instructor['name'] }}">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="fw-bold mb-1">{{ $instructor['name'] }}</h5>
                                <p class="text-muted mb-2">{{ $instructor['title'] }}</p>
                                <div class="d-flex justify-content-between mt-auto">
                                    <div>
                                        <strong>{{ $instructor['students'] }}</strong><br>
                                        <small class="text-muted">Students</small>
                                    </div>
                                    <hr/>
                                    <div>
                                        <strong style="color: green;">{{ $instructor['earnings'] }}</strong><br>
                                        <small class="text-muted">Earnings</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section style="background-color:; padding: 60px 0;" class="why_odumare">
        <div class="container">
            <div class=" mb-5">
                <span class="badge bg-primary fs-5 mb-2">Sell Your Courses </span>

            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 style="color: #0E2293;" class="fw-bold">Turn Your Knowledge Into Income</h2>
                    <p style="color: #5A5A5A;" class="">
                        Join thousands of instructors who are already earning by sharing their expertise on our marketplace.</p>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-6">
                    <?php
                    $features = [
                        [
                            'icon' => 'fa-dollar-sign',
                            'title' => 'Earn Revenue',
                            'desc' => "Get paid for every course purchase with our competitive revenue sharing model",
                        ],
                        [
                            'icon' => 'fa-bullhorn',
                            'title' => "Grow Your Audience",
                            'desc' => "Reach millions of students worldwide and build your teaching brand",
                        ],
                        [
                            'icon' => 'fa-chalkboard-teacher',
                            'title' => 'Teach Your Way',
                            'desc' => 'Create courses at your own pace with our easy-to-use course builder',
                        ],
                    ];

                    foreach ($features as $feature):
                        ?>
                    <div class="d-flex mb-4 p-3 rounded" style="background-color: #E9ECFF;">
                        <div class="me-3 d-flex align-items-center justify-content-center" >
                            <i style="padding: 10px; background: #4A6CF7; border-radius:100%" class="fa <?=$feature['icon'];?> text-white fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold"><?=$feature['title'];?></h5>
                            <p class="mb-0 text-muted"><?=$feature['desc'];?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <a style="background-color: #0E2293;" class="btn btn-primary border-0">Sell Your Course</a>

                </div>
            </div>
        </div>
    </section>



</main>

@endsection
