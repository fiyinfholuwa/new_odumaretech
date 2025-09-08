
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
            <span style="background: white; padding: 5px 10px; border-radius: 20px; font-weight: bold; color: #0E2293;">Expert Curated Courses</span>
            <h2 style="margin-top: 20px;">Welcome to Odumare Tech</h2>
            <p style="margin: 15px 0;">

At OdumareTech, we believe everyone deserves a chance to thrive in the digital world. That’s why we make
tech education practical, accessible, and supportive no matter your background or experience.
Our programs are designed to help you learn by doing. You’ll work on real projects, get guidance from
experienced mentors, and join a vibrant community that’s invested in your success. From your first lesson
to your first job offer, we’re with you every step of the way.
When you finish, you’ll have a globally recognized certification and the confidence to launch your tech
career anywhere in the world.                 </p>
            <a href="{{ route('courses') }}" class="btn btn-warning" style="margin-bottom: 20px;">Get Started</a>

        </div>
    </section>

    <section class="after_hero py-5">
        <div class="container">
            {{-- <p class="mb-4">
            We know real experience matters. That’s why you can join our exclusive Research and Innovation
department to build practical skills that set you apart. Even after you finish your program, we’re still here
for you—with ongoing drop-in sessions, interview tips, and expert advice to help you land your first tech
job.
            </p>
            <p class="mb-4">
Our mission is to empower you with the tech skills and real-world experience you need to grow—personally
and professionally. We’re committed to making tech education accessible and supportive, so everyone has
a fair chance to learn, develop, and succeed.
Our vision is a world where everyone can pursue their passions, live fulfilling lives, and reach their full
potential. We believe in equitable access to education, training, and real-world experience for all.
Empowerment, Compassion, Innovation, Collaboration, Excellence and Inclusivity, Diversity,
Creativity, Passion, Continuous improvement.
            </p> --}}
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

    <section style="background-color: #FFC000;" class="mission_about py-5">
        <div class="container">
            <div class="row g-4">
                <?php
                $cards = [
                    [
                        'title' => 'Our Mission',
                        'description' => 'Our mission is to empower individuals with tech knowledge, skills, and practical experience for personal and professional growth. Through a supportive and innovative learning approach, we strive to level the playing field, providing equitable opportunities for all to learn, develop, and flourish.',
                    ],
                    [
                        'title' => 'Our Vision',
                        'description' => 'Our vision is to build a compassionate world where everyone is free to pursue their passions, live fulfilling lives, and reach their full potential. We want to see everyone have equitable access to education, training, and practical experience in the society.',
                    ],
                    [
                        'title' => 'Our Values',
                        'description' => 'Empowerment, Compassion, Innovation, Collaboration, Excellence and Inclusivity, Diversity, Creativity, Passion, Continuous improvement.',
                    ],
                ];

                foreach ($cards as $card) {
                    ?>
                <div class="col-md-4">
                    <div class="mission-card p-4 text-center h-100">
                        <h3 class="fw-bold mb-3"><?php echo $card['title']; ?></h3>
                        <p><?php echo $card['description']; ?></p>
                    </div>
                </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>


    <section style="background-color: #0E2293">
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


    <section style="background-color:; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2  class="fw-bold mb-3" style="font-size: 2.8rem; color: ;">Join Our Team of Experts</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">
Ignite minds. Inspire futures. Become an instructor with us today!                    </p>
                    <a href="{{ route('career') }}" class="btn btn-warning btn-lg text-white">Apply Now</a>
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




</main>

@endsection
