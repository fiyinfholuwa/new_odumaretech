
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
                We are not just another tech company; we are your dedicated ally on the path to excellence. We go beyond theoretical concepts. We believe in the power of practical application, which is why we provide you with hands-on projects and real-world case studies. Your journey with us culminates in a prestigious certification that validates your comprehensive skills and expertise.            </p>
            <a href="#" class="btn btn-warning" style="margin-bottom: 20px;">Get Started</a>

        </div>
    </section>

    <section class="after_hero py-5">
        <div class="container">
            <p class="mb-4">
                We understand that practical experience is invaluable, which is why we offer you the unique opportunity to join our exclusive Research and Innovation department and acquire the practical skills necessary to flourish in your domain. Even after you complete our program, our commitment to your success remains unwavering. We offer ongoing drop-in sessions where our team provides guidance, interview tips, and valuable insights, maximizing your chances of securing your first job in the competitive tech market.
            </p>
            <div class="row g-3">
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/img/about1.png') }}" class="img-fluid rounded-3 w-100">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/img/about2.png') }}" class="img-fluid rounded-3 w-100">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('frontend/assets/img/about3.png') }}" class="img-fluid rounded-3 w-100">
                </div>
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

                ['icon' => 'house', 'number' => 20, 'name' => 'Partnered Companies'],
            ];

            foreach ($items as $item) {
                ?>
            <div class="col-lg-3 mt-5">
                <div class="home-card-box">
                    {{--                    <div class="home-arc"></div>--}}
                    <div class="home-icon-box">
                        <i class="fa <?php echo $item['icon']; ?> text-white"></i>
                    </div>
                    <div class="home-number" data-number="<?php echo $item['number']; ?>">
                        0
                    </div>
                    <div class="home-name">
                            <?php echo $item['name']; ?>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const counters = document.querySelectorAll('.home-number');
                const duration = 2000; // all counters will finish in 2 seconds (2000ms)

                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-number');
                    let startTimestamp = null;

                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        counter.innerText = Math.floor(progress * target);

                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            counter.innerText = target + '+'; // Ensure it finishes clean with "+"
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
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">Ignite Minds and Inspire Others. Become an Instructor with Us Today!</p>
                    <a href="#" class="btn btn-warning btn-lg text-white">Join The Team</a>
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
