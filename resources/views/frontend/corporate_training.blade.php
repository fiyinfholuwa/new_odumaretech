
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
            <h2 style="margin-top: 20px;">Transform Your Workforce with Targeted Training
            </h2>

            <p style="margin: 15px 0;">
                Upskill your team with our comprehensive corporate eLearning platform. Custom solutions for businesses of all sizes.</p>
                <a href="#" class="btn btn-warning" style="margin-bottom: 20px;">Schedule Consultation</a>

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


    <section style="background-color: #FFF3CF; padding: 60px 0;">
        <div class="company container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold" style="font-size: 2.5rem;">Trusted By</h2>
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

    <section>
        <div class="container">
            <h3 class="text-center">Everything You Need to Succeed
            </h3>
            <p class="text-center">
                Our comprehensive platform provides all the tools for effective corporate training
            </p>
            <?php
            $callToActions = [
                [
                    'icon' => 'fa-video-camera',
                    'title' => 'Live Sessions',
                    'description' => 'Get access to contents created by leaders and join live coaching sessions',
                    'link' => '#',
                    'link_text' => 'Join Live ->'
                ],
                [
                    'icon' => 'fa-road',
                    'title' => 'Custom Learning Paths',
                    'description' => 'Tailor training to specific roles, departments, or individual career goals with customizable learning paths.',
                    'link' => '#',
                    'link_text' => 'Customize Now ->'
                ],
                [
                    'icon' => 'fa-tasks',
                    'title' => 'Multiple Projects',
                    'description' => 'Each learning program is designed with more than 10 projects',
                    'link' => '#',
                    'link_text' => 'Explore Projects ->'
                ],
                [
                    'icon' => 'fa-graduation-cap',
                    'title' => 'Certification Programs',
                    'description' => 'Offer employees verifiable skills with industry-recognized certification programs.',
                    'link' => '#',
                    'link_text' => 'Get Certified ->'
                ],
            ];

            $background1 = "#E9ECFF"; // dark blue
            $background2 = "#FFF3CF"; // yellow
            ?>
            <section class="call_to_action py-5">
                <div class="container">
                    <div class="row">
                        <?php foreach($callToActions as $index => $item): ?>
                            <?php
                            $bgColor = ($index % 2 == 0) ? $background1 : $background2;
                            $textColor = ($index % 2 == 0) ? '#0E2293' : '#FFC000'; // Light or Dark text depending
                            ?>
                        <div class="col-lg-3 mb-4">
                            <div class="p-4 rounded h-100" style="background-color: <?= $bgColor; ?>;">
                                <i class="fa <?= $item['icon']; ?> mb-3" style="font-size: 30px; color: <?= $textColor; ?>; background: <?= $bgColor; ?>; padding: 4px;"></i>
                                <h3 class="h5 mb-2"><?= $item['title']; ?></h3>
                                <p class="mb-3"><?= $item['description']; ?></p>

                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        </div>
    </section>

    <section style="background-color:#FFF3CF; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2  class="fw-bold mb-3" style="font-size: 2.8rem; color: ;">Hire Top-Tier Tech Talent</h2>
                    <p class="lead mb-4" style="font-size: 1.2rem; color: black; ">
                        Access a pool of thoroughly trained, industry-ready digital professionals. Skip the lengthy recruitment process and connect directly with verified tech talent who can drive your company's digital initiatives forward.                    </p>
                    <a href="#" class="btn btn-warning btn-lg text-white">Hire Our Grad</a>
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
