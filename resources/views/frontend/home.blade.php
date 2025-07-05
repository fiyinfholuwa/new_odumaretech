
@extends('frontend.layout.app')

@section('content')
<main class="main">


    <style>
        
        
        /* Cube Animation Styles */
        .cube-container {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            perspective: 1000px;
            z-index: 1;
        }
        
        .cube {
            width: 200px;
            height: 200px;
            position: relative;
            transform-style: preserve-3d;
            animation: rotateCube 20s infinite linear;
        }
        
        .cube-face {
            position: absolute;
            width: 200px;
            height: 200px;
            border: 2px solid #FFC000;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            color: white;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        
        .cube-face:hover {
            background: rgba(255, 192, 0, 0.2);
            transform: scale(1.05);
        }
        
        .cube-face img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .cube-face h3 {
            font-size: 16px;
            margin: 10px 0 5px 0;
            color: #FFC000;
        }
        
        .cube-face p {
            font-size: 12px;
            line-height: 1.4;
            opacity: 0.9;
        }
        
        /* Cube face positioning */
        .front {
            transform: rotateY(0deg) translateZ(100px);
        }
        
        .back {
            transform: rotateY(180deg) translateZ(100px);
        }
        
        .right {
            transform: rotateY(90deg) translateZ(100px);
        }
        
        .left {
            transform: rotateY(-90deg) translateZ(100px);
        }
        
        .top {
            transform: rotateX(90deg) translateZ(100px);
        }
        
        .bottom {
            transform: rotateX(-90deg) translateZ(100px);
        }
        
        @keyframes rotateCube {
            0% {
                transform: rotateX(0deg) rotateY(0deg);
            }
            100% {
                transform: rotateX(360deg) rotateY(360deg);
            }
        }
        
        /* Floating particles around cube */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #FFC000;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .particle:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .particle:nth-child(2) {
            top: 80%;
            right: 20%;
            animation-delay: 2s;
        }
        
        .particle:nth-child(3) {
            bottom: 30%;
            left: 30%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
                opacity: 1;
            }
            50% {
                transform: translateY(-20px) translateX(10px);
                opacity: 0.5;
            }
        }
        
        
        
        
        .decorative-line {
            position: absolute;
            height: 100px;
            width: 100px;
            left: -80px;
            top: 50px;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .decorative-line {
                display: none !important;
            }
            
            .cube-container {
                position: static;
                transform: none;
                display: flex;
                justify-content: center;
                margin: 40px 0;
            }
            
            .cube {
                width: 150px;
                height: 150px;
            }
            
            .cube-face {
                width: 150px;
                height: 150px;
                padding: 15px;
            }
            
            .cube-face img {
                width: 40px;
                height: 40px;
            }
            
            .cube-face h3 {
                font-size: 14px;
            }
            
            .cube-face p {
                font-size: 10px;
            }
            
            .front, .back {
                transform: rotateY(0deg) translateZ(75px);
            }
            .back {
                transform: rotateY(180deg) translateZ(75px);
            }
            .right {
                transform: rotateY(90deg) translateZ(75px);
            }
            .left {
                transform: rotateY(-90deg) translateZ(75px);
            }
            .top {
                transform: rotateX(90deg) translateZ(75px);
            }
            .bottom {
                transform: rotateX(-90deg) translateZ(75px);
            }
            
            h2 {
                font-size: 2rem;
            }
            
            .col-xl-6, .col-lg-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{asset('frontend/assets/img/hero.jpg')}}" alt="" data-aos="fade-in">

<div class="cube-container">
            <div class="cube">
                <div class="cube-face front">
                    <img src="https://via.placeholder.com/60x60/FFC000/FFFFFF?text=WEB" alt="Web Development">
                    <h3>Web Dev</h3>
                    <p>Master modern web technologies</p>
                </div>
                <div class="cube-face back">
                    <img src="https://via.placeholder.com/60x60/FFC000/FFFFFF?text=AI" alt="AI & ML">
                    <h3>AI & ML</h3>
                    <p>Explore artificial intelligence</p>
                </div>
                <div class="cube-face right">
                    <img src="https://via.placeholder.com/60x60/FFC000/FFFFFF?text=DATA" alt="Data Science">
                    <h3>Data Science</h3>
                    <p>Unlock insights from data</p>
                </div>
                <div class="cube-face left">
                    <img src="https://via.placeholder.com/60x60/FFC000/FFFFFF?text=CYBER" alt="Cybersecurity">
                    <h3>Cybersecurity</h3>
                    <p>Protect digital assets</p>
                </div>
                <div class="cube-face top">
                    <img src="https://via.placeholder.com/60x60/FFC000/FFFFFF?text=CLOUD" alt="Cloud Computing">
                    <h3>Cloud Tech</h3>
                    <p>Scale with cloud solutions</p>
                </div>
                <div class="cube-face bottom">
                    <img src="https://via.placeholder.com/60x60/FFC000/FFFFFF?text=MOBILE" alt="Mobile Development">
                    <h3>Mobile Dev</h3>
                    <p>Build mobile experiences</p>
                </div>
            </div>
            
            <!-- Floating particles -->
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="container">

            <div style="margin-top:-100px;" class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-xl-6 col-lg-8">
                    <span style="background-color: #FFC000; padding: 5px;  border-radius: 10px; font-size:10px;">Led by Professionals</span>
                    <h2 style="position: relative;">
                        <img class="decorative-line" style="position: relative; height: 100px; width: 100px; left: -80px; top: 50px;" src="{{ asset('frontend/assets/img/line.png') }}" alt="line" />
                        Break Free With Tech Superpowers<span>.</span>
                    </h2>

                    <style>
                        @media (max-width: 768px) {
                            .decorative-line {
                                display: none !important;
                            }
                        }
                    </style>
                    <p>Embark on a thrilling expedition into the vast realm of technology, where innovation meets possibility and your digital potential awaits.</p>
                </div>
                <div style="margin-top: 30px;">
                    <a href="{{route('courses')}}" class="btn  btn-primary">Explore Courses</a>
                </div>
            </div>
        </div>

    </section>


    <section data-aos="fade-up" data-aos-delay="100" style="background-color: #0E2293">
        <div style="padding: 10px 75px;" class="row">
            <?php
            $items = [
                ['icon' => 'fa-laptop', 'number' => 20, 'name' => 'BootCamps'],
                ['icon' => 'fa-graduation-cap', 'number' => 15, 'name' => 'Student Taught'],
                ['icon' => 'fa-briefcase', 'number' => 80, 'name' => 'Employability'],
                ['icon' => 'fa-house', 'number' => 20, 'name' => 'Partnered Companies'],
            ];
            ?>

            <?php foreach ($items as $item): ?>
            <div class="col-lg-3 mt-5">
                <div class="home-card-box" style="position: relative;">
                    <img src="{{ asset('frontend/assets/img/curve.png') }}"
                         style="position: absolute; bottom: -20px; left: 0; transform: rotate(-10deg); height: 200px; width: auto;"
                         alt="curve" />
                    <div class="home-icon-box">
                        <i class="fa <?php echo $item['icon']; ?> text-white" style="font-size: 40px; background-color: #FFC000;  padding: 10px; border-radius: 3px;"></i>
                    </div>
                    <div style="color: #0E2293;" class="home-number"
                         data-number="<?php echo $item['number']; ?>"
                         data-suffix="<?php echo ($item['name'] == 'Employability') ? '%' : '+'; ?>">
                        0
                    </div>
                    <div  class="home-name text-white" style="margin-top: 10px; color: #0E2293; ">
                        <span style="color: #0E2293; font-weight: bolder;">{{ $item['name'] }} </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const counters = document.querySelectorAll('.home-number');
                const duration = 2000; // 2 seconds

                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-number');
                    const suffix = counter.getAttribute('data-suffix') || '+';
                    let startTimestamp = null;

                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        counter.innerText = Math.floor(progress * target);

                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            counter.innerText = target + suffix; // Add correct suffix
                        }
                    };

                    window.requestAnimationFrame(step);
                });
            });
        </script>
    </section>


    <section style="background-color: #FFF3CF; padding: 60px 0;">
        <div class="company container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem;">Our Partner</h2>
            </div>
            <div class="row justify-content-center">
                <?php
                $partners = [
                    'frontend/assets/img/deloitte.png',
                    'frontend/assets/img/firstbank.png',
                    'frontend/assets/img/nhs.png',
                    'frontend/assets/img/zenith.png',
                    'frontend/assets/img/deloitte.png',
                    'frontend/assets/img/firstbank.png',
                    'frontend/assets/img/nhs.png',
                    'frontend/assets/img/zenith.png',
                   'frontend/assets/img/deloitte.png',
                    'frontend/assets/img/firstbank.png',
                    'frontend/assets/img/nhs.png',
                    'frontend/assets/img/zenith.png',

                ];

                foreach ($partners as $partner) {
                    ?>
                <div class="col-6 col-md-4 col-lg-2 kompany text-center mb-4">
                    <img src="{{ asset($partner) }}" alt="Partner Logo" class="img-fluid partner-logo">
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>


@if (count($popular_courses)> 0)
<section class="popular-section py-5">
        <div class="container popular">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem;">Popular Courses</h2>
                <p class="text-muted">We Provide Highly Structured Training and Courses</p>
            </div>
            <div class="course-list row g-4">
                <?php
                
                foreach ($popular_courses as $course) {
                    ?>
                <div  class="col-lg-4 col-md-6">
                    <div style="background-color: #E9ECFF; !important;"  class="course-card p-3 bg-light shadow-sm rounded-4 position-relative">
                        <div class="course-image position-relative">
                            <img src="<?php echo $course['image']; ?>" alt="Course Image" class="img-fluid rounded-3">
                        <span class="badge-category">
                            {{ $course->cat->name ?? 'No Category' }}
                        </span>
                        </div>
                        <h3 class="mt-3"><?php echo $course['title']; ?></h3>
                        @php
                            $cleaned = strip_tags(html_entity_decode($course['description']));
                            $words = explode(' ', $cleaned);
                            $shortDesc = implode(' ', array_slice($words, 0, 20));
                        @endphp

                        <p class="text-muted">{{ $shortDesc }}{{ count($words) > 20 ? '...' : '' }}</p>
                        <a href="{{route('course.detail', $course['course_url'])}}" class="text-primary fw-bold">Learn More →</a>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
            <div style="text-align: center; padding-top: 20px;">
                <a href="{{route('courses')}}" class="btn btn-primary">View All Courses</a>
            </div>
        </div>
    </section>
    
@endif

    
    <section class="how_you_will_learn py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem;">How you will learn</h2>
                <p class="text-muted">Premium skills learning across the entire digital product lifecycle</p>
            </div>
            <div class="learn_list row g-4">
                <?php
                $learn_items = [
                    [
                        'title' => 'Immerse Learning',
                        'points' => [
                            'Robust Content and Videos.',
                            'Interactive quizzes and assignments.',
                            'Peer collaboration opportunities.',
                            'Hands-on projects and real-world scenarios.',
                        ],
                    ],
                    [
                        'title' => 'Mentor Support',
                        'points' => [
                            'Direct access to industry experts.',
                            'Weekly live Q&A sessions.',
                            'Feedback on your projects.',
                            'Career guidance and portfolio reviews.',
                        ],
                    ],
                    [
                        'title' => 'Practical Approach',
                        'points' => [
                            'Real company case studies.',
                            'Problem-solving sessions.',
                            'Capstone projects for real-world application.',
                            'Internship and job opportunities after course.',
                        ],
                    ],
                    [
                        'title' => 'Career Pathways',
                        'points' => [
                            'Guided learning journeys.',
                            'Specialization tracks (frontend, backend, data, etc).',
                            'Resume and LinkedIn support.',
                            'Mock interviews and job prep.',
                        ],
                    ],
                ];

                foreach ($learn_items as $index => $item) {
                    // Set background: even index (0,2) one color; odd (1,3) another
                    $background = ($index % 2 == 0) ? '#FFF3CF' : '#E9ECFF';
                    ?>
                <div class="col-lg-3 col-md-6">
                    <div class="learn-card p-4 rounded-4 shadow-sm h-100" style="background-color: <?php echo $background; ?>;">
                        <h4 class="fw-bold mb-4"><?php echo $item['title']; ?></h4>
                        <ul class="list-unstyled">
                                <?php foreach ($item['points'] as $point) { ?>
                            <li class="mb-3">
                                <i style="background: <?=$background;?>" class="fa fa-check-circle  me-2"></i><?php echo $point; ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section style="background-color:; padding: 60px 0;" class="why_odumare">
        <div class="container">
            <div class=" mb-5">
                <span class="badge bg-primary fs-5 mb-2">Why Odumaretech?</span>

            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 style="color: #0E2293;" class="fw-bold">More than just Another Educational Platform</h2>
                    <p style="color: #5A5A5A;" class="">We are your dedicated partner in mastering digital skills. Our approach combines rigorous learning with practical experience, setting us apart.</p>
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
                            'icon' => 'fa-location',
                            'title' => 'Learn at your Convenience',
                            'desc' => 'Transform any space into your classroom. Whether you\'re at home, relaxing at the beach, working in your studio, or managing your business - your learning journey adapts to your lifestyle.',
                        ],
                        [
                            'icon' => 'fa-champagne-glasses ',
                            'title' => 'Learning that Sparks Joy',
                            'desc' => 'Experience education reimagined for the modern learner. Our dynamic curriculum brings concepts to life through interactive lessons, engaging projects, and immersive content.',
                        ],
                        [
                            'icon' => 'fa-certificate',
                            'title' => 'Learn from Industry Leaders',
                            'desc' => 'Our expert instructors are handpicked for their exceptional expertise and proven track record. Each brings extensive real-world experience, deep subject matter knowledge, and a passion for teaching.',
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
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->

    <section style="background-color: #E9ECFF; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2  class="fw-bold mb-3" style="font-size: 2.8rem; color: ;">Accelerate Your Workforce</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">Let’s partner with you to train and develop your talent in areas of tech that will in turn transform your business.</p>
                    <a href="{{route('corporate_training')}}" style="background-color: #0E2293; border: none;" class="btn btn-warning btn-lg text-white">Read More</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF" title="YouTube video player" allowfullscreen style="border-radius: 10px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (count($innovations)  > 0)
        <section style="background-color: #FFF3CF; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2  class="fw-bold mb-3" style="font-size: 2.8rem; color: ;">Research and Innovation</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">
                        Our cutting-edge research at OdumareTech. Curiosity knows no bounds, and neither do we. Are you passionate about shaping the future? Join us in our pursuit of knowledge.                    </p>
                    <a href="{{route('innovation')}}" style="background-color: #FFC000; border: none;" class="btn btn-warning btn-lg text-white">Learn More</a>
                </div>
            </div>
            <div class="row">

                
                @foreach($innovations as $card)
                    <div class="col-lg-4 mb-4">
                    <a href="{{route('innovation.info',$card->id)}}">
                        <div style="background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 10px; text-align: ; height: 100%;">
                            <img src="{{ asset($card['image']) }}" alt="{{ $card['image'] }}" class="img-fluid mb-3" style=" object-fit: cover;" />
                            <h4 style="color: #333; font-weight: bold; margin-top: 20px;">{{ $card['name'] }}</h4>
                        </div>
                        </a>
                    </div>

                @endforeach
            </div>

        </div>
    </section>

    @endif
    
    <section style="background-color: #E9ECFF; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2  class="fw-bold mb-3" style="font-size: 2.8rem; color: ;">Intensive BootCamp</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">
                        Let’s partner with you to train and develop your talent in areas of tech that will inturn transform your business                    </p>
                    <a href="{{route('courses')}}" style="background-color: #0E2293; border: none;" class="btn btn-warning btn-lg text-white">Our Courses</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/EaGakAaLt5g?si=IkxAQ37BMNTWVJEF" title="YouTube video player" allowfullscreen style="border-radius: 10px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section style="background-color: #FFF3CF; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2  class="fw-bold mb-3" style="font-size: 2.8rem; color: ;">Free Masterclass</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">
                        Our Exclusive Free Masterclass Series – Your Gateway to Professional Knowledge. Seize the Opportunity to Learn Directly from Industry Experts. Reserve Your Spot Now! </p>
                        <a href="{{route('masterclass')}}" style="background-color: #FFC000; border: none;" class="btn btn-warning btn-lg text-white">Join Masterclass</a>
                </div>
            </div>
            <div class="row">

                <?php
                $cards = [
                    [
                        'image' => 'https://csweb.rice.edu/sites/g/files/bxs4941/files/2022-06/MCS%20vs%20Bootcamp_Hero_Web-min.jpg',
                    ],
                    [
                        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXLtAsdGC_e5xCXNFsPIVlLdN9jWS3y-Ci4w&s',
                    ],
                    [
                        'image' => 'https://i0.wp.com/www.ripplesnigeria.com/wp-content/uploads/2022/01/IMG-20220113-WA0004_copy_650x366.jpg?fit=650%2C366&ssl=1',
                    ],
                ];

                ?>
                @foreach($cards as $card)
                    <div class="col-lg-4 mb-4">
    <div style="height: 250px; overflow: hidden; border-radius: 10px;">
        <img src="{{ asset($card['image']) }}"
             class="img-fluid w-100 h-100"
             style="object-fit: cover;" />
    </div>
</div>

                @endforeach
            </div>

        </div>
    </section>


    @if (count($testimonials) > 0)
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
                    <p style="color: #5A5A5A;" class=" mb-2"><?= $testimonial['title']; ?></p>
                    <p style="color: #5A5A5A;"><?= html_entity_decode($testimonial['content']); ?></p>
                </div>
                <?php else: ?>
                <div style="background-color: <?= $bgColor ?>; border-radius: 12px; padding: 20px;" class="col-lg-9 text-start order-lg-1 order-2">
                    <h5 class="fw-bold mb-1"><?= $testimonial['name']; ?></h5>
                    <p style="color: #5A5A5A;" class=" mb-2"><?= $testimonial['title']; ?></p>
                <p style="color: #5A5A5A;"><?= html_entity_decode($testimonial['content']); ?></p>
                </div>
                <div class="col-lg-3 text-center order-lg-2 order-1 mb-3 mb-lg-0">
                    <img src="<?= $testimonial['image']; ?>" alt="<?= $testimonial['name']; ?>" style="height: 120px; width: 120px; border-radius: 50%; object-fit: cover;">
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
 
    @endif
    

    <section style="background-color: #FFF3CF; padding: 60px 0;">
        <div class="company container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem;">Where Our Graduates Work</h2>
            </div>
            <div class="row justify-content-center">
                <?php
                $partners = [
                    'frontend/assets/img/deloitte.png',
                    'frontend/assets/img/firstbank.png',
                    'frontend/assets/img/nhs.png',
                    'frontend/assets/img/zenith.png',
                    'frontend/assets/img/deloitte.png',
                    'frontend/assets/img/firstbank.png',
                    'frontend/assets/img/nhs.png',
                    'frontend/assets/img/zenith.png',
                    'frontend/assets/img/deloitte.png',
                    'frontend/assets/img/firstbank.png',
                    'frontend/assets/img/nhs.png',
                    'frontend/assets/img/zenith.png',

                ];

                foreach ($partners as $partner) {
                    ?>
                <div class="col-6 col-md-4 col-lg-2 kompany text-center mb-4">
                    <img src="{{ asset($partner) }}" alt="Partner Logo" class="img-fluid partner-logo">
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>


    <?php
    $faqs = [
        [
            'question' => 'What is OdumareTech?',
            'answer' => 'OdumareTech is a tech platform that focuses on practical, hands-on learning. Through real-world projects and industry collaboration, we prepare students for their first professional role, equipping them with practical expertise and confidence.'
        ],
        [
            'question' => 'How do I enroll in a course?',
            'answer' => 'To enroll, simply visit our course page, choose a program, and follow the registration instructions.'
        ],
        [
            'question' => 'Are the programs certified?',
            'answer' => 'Yes, upon completion you will receive an industry-recognized certificate.'
        ],
        [
            'question' => 'Can I learn at my own pace?',
            'answer' => 'Absolutely! Our programs are designed to be flexible so you can learn on your schedule.'
        ],
        [
            'question' => 'Is there support available during my learning?',
            'answer' => 'Yes, we provide mentorship and support throughout your learning journey to help you succeed.'
        ],
    ];
    ?>
    <section class="faq py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <h3 class="fw-bold" style="font-size: 2.5rem;">Frequently Asked Questions</h3>
                    <p>Still have any questions? Contact our Team via <a href="mailto:contact@odumaretech.com">contact@odumaretech.com</a></p>
                    <a href="{{route('faq')}}" class="btn btn-outline-warning">See all FAQs</a>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="faqAccordion">
                        <?php foreach($faqs as $index => $faq): ?>
                        <div class="accordion-item mb-3 shadow-sm" style="border-radius: 12px; overflow: hidden; background: #fff;">
                            <h2 class="accordion-header" id="heading<?= $index ?>">
                                <button class="accordion-button collapsed custom-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                                    <span><?= $faq['question'] ?></span>
                                    <span class="icon-toggle ms-auto">+</span>
                                </button>
                            </h2>
                            <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                        <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.custom-accordion-button');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('.icon-toggle');

                    // Small timeout to wait for class change
                    setTimeout(() => {
                        if (this.classList.contains('collapsed')) {
                            icon.textContent = '+';
                        } else {
                            icon.textContent = '-';
                        }
                    }, 150);
                });
            });
        });
    </script>

</main>

@endsection
