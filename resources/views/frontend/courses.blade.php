
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 80vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
" class="section dark-background">
        <div  class="text-center" style="max-width: 800px; margin-top: 150px;  padding: 20px;">
            <span style="background: white; padding: 5px 10px; border-radius: 20px; font-weight: bold; color: #0E2293;">Expert Curated Courses</span>
            <h2 style="margin-top: 20px;">Unlock Your Potential with <br/> Expert-Led Courses</h2>
            <p style="margin: 15px 0;">Our meticulously crafted curriculum, taught by industry professionals, ensures a seamless journey from beginner to pro, setting industry standards while maintaining beginner-friendly accessibility.</p>
            <a href="#" class="btn btn-warning" style="margin-bottom: 20px;">Start Learning</a>

            <div style="position: relative; height: 100px; margin-top: 30px; display: flex; justify-content: center;">
                <div style="position: relative; width: 230px;"> <!-- Adjust width depending on how many images and overlap -->
                    <img src="{{asset('frontend/assets/img/Ellipse 121.png')}}"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;  position: absolute; left: 0;">
                    <img src="{{asset('frontend/assets/img/Ellipse 122.png')}}"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;  position: absolute; left: 50px;">
                    <img src="{{asset('frontend/assets/img/Ellipse 123.png')}}"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;  position: absolute; left: 100px;">
                    <img src="{{asset('frontend/assets/img/Ellipse 124.png')}}"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;  position: absolute; left: 150px;">
                </div>
            </div>

            <span style="display: block; margin-top: 20px;">Over 110k+ professionals trained.</span>
        </div>
    </section>



    <section class="popular-section py-5">
        <div class="container popular">
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
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSLTTbwYtmozuV9DOL8N0iYvU-37x2fm1TVA&s',
                        'category' => 'Cybersecurity',
                        'title' => 'Network Security',
                        'description' => 'Understand the foundations of securing enterprise-level networks and protecting digital assets.',
                        'weeks' => '5 Weeks',
                        'level' => 'Beginner',
                    ],
                    // Add more courses if needed
                ];

                $colors = ['#E9ECFF', '#FFF3CF']; // alternating background colors

                foreach ($courses as $index => $course) {
                    $colorIndex = floor($index / 2) % count($colors);
                    $bgColor = $colors[$colorIndex];
                    ?>
                <div class="col-lg-6 col-md-6">
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
                        <a href="{{route('course.detail', "hello")}}" style="background-color: #0E2293; border: none;" class="btn btn-primary btn-lg fw-bold">Start Learning</a>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>


    <?php
    $testimonials = [
        [
            'image' => 'https://media.istockphoto.com/id/1230749818/photo/portrait-of-smiling-male-owner-of-fashion-store-standing-in-front-of-clothing-display.jpg?s=612x612&w=0&k=20&c=xoWhF-hrQcbMEPDYncHiHF8HJX2YgmYt7T-KLCPZIpY=',
            'name' => 'Sarah L',
            'work' => 'Works at Deloitte',
            'comment' => 'The web design course provided a solid foundation for me. The instructors were knowledgeable and supportive, and the interactive learning environment was engaging. I highly recommend it!'
        ],
        [
            'image' => 'https://media.istockphoto.com/id/1230749818/photo/portrait-of-smiling-male-owner-of-fashion-store-standing-in-front-of-clothing-display.jpg?s=612x612&w=0&k=20&c=xoWhF-hrQcbMEPDYncHiHF8HJX2YgmYt7T-KLCPZIpY=',
            'name' => 'Michael D',
            'work' => 'Software Engineer at Google',
            'comment' => 'Thanks to the coding bootcamp, I landed my dream job! The hands-on projects really helped me build confidence and skills.'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?crop=faces&fit=crop&w=400&h=400',
            'name' => 'Jessica T',
            'work' => 'UX Designer at Amazon',
            'comment' => 'Amazing experience! The mentorship and practical exercises made the difference. I feel fully prepared for real-world challenges.'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?crop=faces&fit=crop&w=400&h=400',
            'name' => 'Chris P',
            'work' => 'Freelance Developer',
            'comment' => 'This course changed my career. I went from no experience to building client websites within a few months. Highly recommend!'
        ]
    ];
    ?>

    <section class="testimonial py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold" style="font-size: 2.5rem;">What Our Students Say</h3>
                <p class="text-muted">From career transformations to breakthrough moments, our students' success stories speak volumes.</p>
            </div>

            <?php foreach($testimonials as $index => $testimonial): ?>
                <?php
                $bgColor = ($index % 2 == 0) ? '#E9ECFF' : '#FFF3CF'; // Alternate background
                ?>
            <div class="row align-items-center py-4 px-3 mb-4" style="border-radius: 12px; ">
                    <?php if($index % 2 == 0): ?>
                <div class="col-lg-3 text-center mb-3 mb-lg-0">
                    <img src="<?= $testimonial['image']; ?>" alt="<?= $testimonial['name']; ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover;">
                </div>
                <div style="background-color: <?= $bgColor ?>; border-radius: 12px; padding: 20px; " class="col-lg-9 text-start">
                    <h5  class="fw-bold mb-1"><?= $testimonial['name']; ?></h5>
                    <p style="color: #5A5A5A;" class=" mb-2"><?= $testimonial['work']; ?></p>
                    <p style="color: #5A5A5A;"><?= $testimonial['comment']; ?></p>
                </div>
                <?php else: ?>
                <div style="background-color: <?= $bgColor ?>; border-radius: 12px; padding: 20px;" class="col-lg-9 text-start order-lg-1 order-2">
                    <h5 class="fw-bold mb-1"><?= $testimonial['name']; ?></h5>
                    <p style="color: #5A5A5A;" class=" mb-2"><?= $testimonial['work']; ?></p>
                    <p style="color: #5A5A5A;" ><?= $testimonial['comment']; ?></p>
                </div>
                <div class="col-lg-3 text-center order-lg-2 order-1 mb-3 mb-lg-0">
                    <img src="<?= $testimonial['image']; ?>" alt="<?= $testimonial['name']; ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover;">
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>



</main>

@endsection
