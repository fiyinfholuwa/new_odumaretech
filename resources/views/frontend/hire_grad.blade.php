
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
            <span style="background: white; padding: 5px 10px; border-radius: 20px; font-weight: bold; color: #0E2293;">Top Tech Talents</span>
            <h2 style="margin-top: 20px;">Work With Exceptional Digital Talent</h2>

            <p style="margin: 15px 0;">
                Connect with the industry's most skilled digital professionals who consistently deliver outstanding results. Partner with professionals who don't just meet standards – they set them.</p>
                <a href="#" class="btn btn-warning" style="margin-bottom: 20px;">Hire Our Grad</a>

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
            <h3 class="text-center">Our Approach</h3>
            <p class="text-center">
                We streamline your path to exceptional talent, eliminating the complexity from hiring. Our refined process connects you with skilled professionals quickly and efficiently, ensuring you can focus on what matters – building and growing your business. No lengthy searches, no uncertainty – just direct access to verified expertise when you need it.
            </p>
            <?php
            $features = [
                [
                    'icon' => 'fa-laptop',
                    'title' => 'Drive Digital Innovation',
                    'description' => "Transform your team into pioneers of change, equipped to shape tomorrow's workplace rather than simply adapt to it.",
                ],
                [
                    'icon' => 'fa-book',
                    'title' => 'Future-Ready Workforce',
                    'description' => "Cultivate the mindset and capabilities needed for emerging ways of work, collaboration, and value creation in an AI-driven world.",
                ],
                [
                    'icon' => 'fa-search',
                    'title' => 'Learning That Creates Impact',
                    'description' => "Our evidence-based learning approach bridges the gap between theory and practice, enabling seamless transitions into new roles and responsibilities.",
                ],
            ];
            ?>

            <div class="row">
                @foreach($features as $feature)
                    <div class="col-lg-4 mb-4">
                        <div style="background-color: #E9ECFF;color:; padding: 20px; text-align: ; border-radius: 10px;">
                            <i   class="fa {{ $feature['icon'] }}" style="font-size: 30px; margin-bottom: 10px; background-color: #0E2293; color: white; padding: 10px; border-radius: 10px;"></i>
                            <h5>{{ $feature['title'] }}</h5>
                            <p>{{ $feature['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

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
