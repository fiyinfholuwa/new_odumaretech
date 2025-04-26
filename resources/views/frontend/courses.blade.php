
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
                    <img src="https://www.cnet.com/a/img/resize/f9c9645440d5d2433578ad9812f04665c150f587/hub/2021/09/21/8d574005-65e4-4a75-8545-410eb48fb042/iphone-13-mini-cnet-review-2021-105.jpg?auto=webp&fit=crop&height=1200&width=1200"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; position: absolute; left: 0;">
                    <img src="https://www.cnet.com/a/img/resize/f9c9645440d5d2433578ad9812f04665c150f587/hub/2021/09/21/8d574005-65e4-4a75-8545-410eb48fb042/iphone-13-mini-cnet-review-2021-105.jpg?auto=webp&fit=crop&height=1200&width=1200"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; position: absolute; left: 50px;">
                    <img src="https://www.cnet.com/a/img/resize/f9c9645440d5d2433578ad9812f04665c150f587/hub/2021/09/21/8d574005-65e4-4a75-8545-410eb48fb042/iphone-13-mini-cnet-review-2021-105.jpg?auto=webp&fit=crop&height=1200&width=1200"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; position: absolute; left: 100px;">
                    <img src="https://www.cnet.com/a/img/resize/f9c9645440d5d2433578ad9812f04665c150f587/hub/2021/09/21/8d574005-65e4-4a75-8545-410eb48fb042/iphone-13-mini-cnet-review-2021-105.jpg?auto=webp&fit=crop&height=1200&width=1200"
                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; position: absolute; left: 150px;">
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
                        <a href="#" class="btn btn-primary fw-bold">Start Learning</a>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>


</main>

@endsection
