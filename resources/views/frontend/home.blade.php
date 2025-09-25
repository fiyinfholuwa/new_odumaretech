
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

    <!-- Rain container -->
    <div class="rain"></div>

    <div class="container">
        <div style="margin-top:-100px;" class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-xl-6 col-lg-8">
                <span style="background-color: #FFC000; padding: 5px; border-radius: 10px; font-size:10px;">Led by Professionals</span>
                <h2 style="position: relative;">
                    <img class="decorative-line" style="position: relative; height: 100px; width: 100px; left: -80px; top: 50px;" src="{{ asset('frontend/assets/img/line.png') }}" alt="line" />
                    Unlock Your Tech Superpowers for Tomorrow, Today <span>.</span>
                </h2>

                <style>
                    @media (max-width: 768px) {
                        .decorative-line {
                            display: none !important;
                        }
                    }
                </style>
                <p>
                    Hands-on courses, real projects, and a community that’s got your back. Start your journey—no experience
                    needed.
                </p>
            </div>
            <div style="margin-top: 30px;">
                <a href="{{route('courses')}}" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </div>
</section>

<style>
/* Rain effect */
.rain {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
    z-index: 5;
}

/* Each drop */
.rain span {
    position: absolute;
    top: -10%;
    width: 2px;
    height: 40px;
    background: rgba(255, 255, 255, 0.3);
    animation: fall linear infinite;
}

/* Falling animation */
@keyframes fall {
    0% {
        transform: translateY(0);
        opacity: 1;
    }
    100% {
        transform: translateY(120vh);
        opacity: 0.4;
    }
}
</style>

<script>
// Generate raindrops dynamically
document.addEventListener("DOMContentLoaded", () => {
    const rain = document.querySelector(".rain");
    const dropCount = 50; // adjust density

    for (let i = 0; i < dropCount; i++) {
        const drop = document.createElement("span");
        drop.style.left = Math.random() * 100 + "vw";  // random X position
        drop.style.animationDuration = 0.5 + Math.random() * 1.5 + "s"; // different speeds
        drop.style.animationDelay = Math.random() * 2 + "s"; // staggered starts
        rain.appendChild(drop);
    }
});
</script>




    <!-- Certification Section -->
    <section class="certification-section">
        <div class="certification-container">
            <div class="certification-text">
                <h2 class="animate-title">Certified & Trusted</h2>
                <p class="animate-description">
                    Our organization has earned internationally recognized certifications, 
                    demonstrating our commitment to excellence and trust.
                </p>
               
            </div>
            <div class="certification-logos">
                <div class="logo-wrapper">
                    <img src="{{ asset('frontend/assets/img/uk.jpeg') }}" alt="UK Certification" class="cert-logo" />
                    <div class="logo-overlay">
                        {{-- <span>UK Certification</span> --}}
                    </div>
                </div>
                <div class="logo-wrapper">
                    <img src="{{ asset('frontend/assets/img/at.jpeg') }}" alt="AT Certification" class="cert-logo" />
                    <div class="logo-overlay">
                        {{-- <span>AT Certification</span> --}}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating particles background -->
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        
        <!-- Animated background waves -->
        <div class="waves">
            <div class="wave wave1"></div>
            <div class="wave wave2"></div>
        </div>
    </section>

    <style>
      
      

        .certification-section {
            background: linear-gradient(135deg, #001f3f 0%, #003366 50%, #001a33 100%);
            color: #fff;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        .certification-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            position: relative;
            z-index: 2;
        }

        .certification-text {
            flex: 1 1 400px;
        }

        .animate-title {
            font-size: 32px;
            margin-bottom: 15px;
            color: #ffffff;
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 1s ease-out 0.3s forwards;
            position: relative;
        }

        .animate-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #4A90E2, #2ECC71);
            animation: expandLine 1.5s ease-out 1s forwards;
        }

        .animate-description {
            font-size: 18px;
            line-height: 1.7;
            color: #e8e8e8;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 1s ease-out 0.6s forwards;
            margin-bottom: 25px;
        }

        .trust-badges {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 8px 15px;
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.8s ease-out forwards;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .badge:nth-child(1) { animation-delay: 0.9s; }
        .badge:nth-child(2) { animation-delay: 1.1s; }
        .badge:nth-child(3) { animation-delay: 1.3s; }

        .badge:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .badge-icon {
            font-size: 18px;
            animation: pulse 2s infinite;
        }

        .certification-logos {
            flex: 1 1 300px;
            display: flex;
            gap: 30px;
            justify-content: center;
            align-items: center;
        }

        .logo-wrapper {
            position: relative;
            opacity: 0;
            transform: scale(0.8) rotateY(45deg);
            animation: logoAppear 1s ease-out forwards;
            cursor: pointer;
        }

        .logo-wrapper:nth-child(1) { animation-delay: 1.2s; }
        .logo-wrapper:nth-child(2) { animation-delay: 1.5s; }

        .cert-logo {
            max-height: 100px;
            width: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .logo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 31, 63, 0.9);
            backdrop-filter: blur(5px);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .logo-wrapper:hover .cert-logo {
            transform: scale(1.1) rotateY(5deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            filter: brightness(1.1);
        }

        .logo-wrapper:hover .logo-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        /* Floating particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s infinite linear;
        }

        .particle:nth-child(1) {
            left: 10%;
            animation-delay: 0s;
            animation-duration: 8s;
        }

        .particle:nth-child(2) {
            left: 30%;
            animation-delay: 2s;
            animation-duration: 6s;
        }

        .particle:nth-child(3) {
            left: 50%;
            animation-delay: 4s;
            animation-duration: 7s;
        }

        .particle:nth-child(4) {
            left: 70%;
            animation-delay: 1s;
            animation-duration: 9s;
        }

        .particle:nth-child(5) {
            left: 85%;
            animation-delay: 3s;
            animation-duration: 5s;
        }

        .particle:nth-child(6) {
            left: 95%;
            animation-delay: 5s;
            animation-duration: 8s;
        }

        /* Animated background waves */
        .waves {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            pointer-events: none;
            z-index: 1;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V7.23C0,65.52,268.63,112.77,600,112.77S1200,65.52,1200,7.23V0Z" fill="rgba(255,255,255,0.05)"></path></svg>');
            background-size: 1200px 100px;
            animation: waveMove 10s ease-in-out infinite;
        }

        .wave1 {
            animation-delay: 0s;
            opacity: 0.7;
        }

        .wave2 {
            animation-delay: -5s;
            opacity: 0.5;
            animation-direction: reverse;
        }

        /* Keyframe Animations */
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes expandLine {
            to {
                width: 60px;
            }
        }

        @keyframes logoAppear {
            to {
                opacity: 1;
                transform: scale(1) rotateY(0deg);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes waveMove {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(-50px);
            }
        }

        /* Intersection Observer Animation Trigger */
        .certification-section.animate {
            animation: sectionGlow 2s ease-out;
        }

        @keyframes sectionGlow {
            0% {
                box-shadow: inset 0 0 0 rgba(74, 144, 226, 0);
            }
            50% {
                box-shadow: inset 0 0 100px rgba(74, 144, 226, 0.1);
            }
            100% {
                box-shadow: inset 0 0 0 rgba(74, 144, 226, 0);
            }
        }

        /* Enhanced hover effects */
        .certification-text:hover .animate-title {
            animation: titleShine 1s ease-out;
        }

        @keyframes titleShine {
            0% {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            }
            50% {
                text-shadow: 0 0 20px rgba(74, 144, 226, 0.8), 0 0 30px rgba(46, 204, 113, 0.6);
            }
            100% {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .certification-container {
                flex-direction: column;
                text-align: center;
                gap: 30px;
            }

            .certification-logos {
                justify-content: center;
                gap: 0px;
                margin-top:-280px;
            }

            .animate-title {
                font-size: 28px;
            }

            .animate-description {
                font-size: 16px;
            }

            .trust-badges {
                justify-content: center;
            }

            .cert-logo {
                max-height: 80px;
            }
        }

        @media (max-width: 480px) {
            .certification-section {
                padding: 60px 15px;
            }

            .trust-badges {
                flex-direction: column;
                align-items: center;
            }

            .certification-logos {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for scroll-triggered animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        // Add stagger effect to badges
                        const badges = entry.target.querySelectorAll('.badge');
                        badges.forEach((badge, index) => {
                            setTimeout(() => {
                                badge.style.animationDelay = `${0.9 + index * 0.2}s`;
                            }, index * 100);
                        });
                    }
                });
            }, { threshold: 0.3 });

            const certificationSection = document.querySelector('.certification-section');
            observer.observe(certificationSection);

            // Enhanced interactive effects
            const logoWrappers = document.querySelectorAll('.logo-wrapper');
            logoWrappers.forEach(wrapper => {
                wrapper.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1) rotateY(5deg)';
                    this.style.filter = 'brightness(1.2)';
                });

                wrapper.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotateY(0deg)';
                    this.style.filter = 'brightness(1)';
                });

                // Click effect
                wrapper.addEventListener('click', function() {
                    this.style.animation = 'logoAppear 0.6s ease-out';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 600);
                });
            });

            // Badge click effects
            const badges = document.querySelectorAll('.badge');
            badges.forEach(badge => {
                badge.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    this.style.background = 'rgba(74, 144, 226, 0.3)';
                    
                    setTimeout(() => {
                        this.style.transform = '';
                        this.style.background = 'rgba(255, 255, 255, 0.1)';
                    }, 150);
                });
            });

            // Add dynamic particle creation
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                
                document.querySelector('.particles').appendChild(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 10000);
            }

            // Create particles periodically
            setInterval(createParticle, 2000);

            // Mouse movement parallax effect
            document.addEventListener('mousemove', (e) => {
                const mouseX = (e.clientX / window.innerWidth) * 100;
                const mouseY = (e.clientY / window.innerHeight) * 100;
                
                const wave1 = document.querySelector('.wave1');
                const wave2 = document.querySelector('.wave2');
                
                if (wave1 && wave2) {
                    wave1.style.transform = `translateX(${-mouseX * 0.02}px)`;
                    wave2.style.transform = `translateX(${mouseX * 0.01}px)`;
                }
                
                // Subtle parallax on certification logos
                logoWrappers.forEach((wrapper, index) => {
                    const multiplier = (index + 1) * 0.01;
                    wrapper.style.transform += ` translate(${mouseX * multiplier}px, ${mouseY * multiplier}px)`;
                });
            });

            // Add typing effect to description
            function typeWriter(element, text, speed = 50) {
                let i = 0;
                element.innerHTML = '';
                element.style.opacity = '1';
                
                function type() {
                    if (i < text.length) {
                        element.innerHTML += text.charAt(i);
                        i++;
                        setTimeout(type, speed);
                    }
                }
                type();
            }

            // Trigger typing effect when section is visible
            setTimeout(() => {
                const description = document.querySelector('.animate-description');
                const originalText = description.textContent;
                typeWriter(description, originalText, 30);
            }, 1500);
        });
    </script>



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
    <style>
    .partner-logo {
        width: 100%;
        height: 100px; /* adjust height as needed */
        object-fit: contain; 
        background: white; /* optional, makes logos on transparent background visible */
        padding: 5px; /* optional, gives breathing room */
    }
</style>

    <div class="company container">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold" style="font-size: 2.5rem;">Our Partner</h2>
        </div>
        <div class="row justify-content-center">
            <?php
            $partners = [
                'https://logos-world.net/wp-content/uploads/2021/08/Deloitte-Emblem.png',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThzUVNHMjee6gSYl7bTk-jT3npCZJw5qKcYA&s',
                'https://upload.wikimedia.org/wikipedia/commons/d/d3/National_Health_Service_%28England%29_logo.svg',
                'https://play-lh.googleusercontent.com/zvF7hv8g_NhRceUCZlEdwHBKEj7EneBHESau90TlARSdbvezPdQQ_HPA_JPypxyqNLRY=w600-h300-pc0xffffff-pd',
                'https://upload.wikimedia.org/wikipedia/commons/8/84/Zapier-logo.png',
                'https://sm.pcmag.com/t/pcmag_me/review/s/spotify/spotify_wc7u.1200.png',
                'https://m.media-amazon.com/images/I/71bVFk8cUKL.png',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoAU2r-709qkZeCFT0Zdmhoyg2_UYm6xF0rA&s',
                'https://images.contentstack.io/v3/assets/blt9e072702140c498e/bltea5495240d348c1f/5f51dca8ee702027c4ce85d9/Overview_Adobe_logo.png',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRA15tv2KxH56D7RHjS1JNeDoC3uyUp3F-8w&s',
                'https://m.media-amazon.com/images/I/31JfJ6dXD9L.png'
            ];

            foreach ($partners as $partner) {
            ?>
            <div class="col-6 col-md-4 col-lg-2 kompany text-center mb-4">
                <img src="<?= $partner ?>" alt="Partner Logo" class="img-fluid partner-logo">
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
                <p class="text-muted">Learn tech skills the way top professionals do—by doing, not just watching.</p>
            </div>
            <div class="learn_list row g-4">
                <?php
                $learn_items = [
                    [
                        'title' => 'Immerse Learning',
                        'points' => [
                            'Watch easy-to-follow videos and explore robust content.',
                            'Test your knowledge with interactive quizzes and assignments.',
                            'Team up with peers for group projects and discussions.',
                            'Build real skills with hands-on projects and real-world scenarios.',
                        ],
                    ],
                    [
                        'title' => 'Mentor Support',
                        'points' => [
                            'Get direct access to industry experts for advice and support.',
                            'Join weekly live Q&A sessions to get your questions answered.',
                            'Receive personalized feedback on your projects.',
                            'Benefit from career guidance and portfolio reviews.',
                        ],
                    ],
                    [
                        'title' => 'Practical Approach',
                        'points' => [
                            'Work on real company case studies and solve real problems.',
                            'Tackle capstone projects that showcase your skills.',
                            'Unlock internship and job opportunities after your course.',
                        ],
                    ],
                    [
                        'title' => 'Career Pathways',
                        'points' => [
                            'Follow guided learning journeys tailored to your goals.',
                            'Choose specialization tracks like frontend, backend, or data.',
                            'Get help with your resume and LinkedIn profile.',
                            'Practice with mock interviews and job prep sessions.',
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
                <span class="btn bg-primary fs-5 mb-2 text-white">Why Odumaretech?</span>

            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 style="color: #0E2293;" class="fw-bold">Not Just Another EdTech Platform</h2>
                    <p style="color: #5A5A5A;" class="">We’re your dedicated partner in mastering digital skills. Our unique blend of hands-on learning and real-world experience sets us apart.</p>
                    <div class="ratio ratio-16x9">
                        <iframe
  src="https://www.youtube.com/embed/BQY-qE-mXGk"
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
                            'title' => 'Learn on Your Terms',
                            'desc' => 'Turn any place into your classroom. Whether you’re at home, on the go, or balancing work and life, our
flexible programs fit your schedule and lifestyle.',
                        ],
                        [
                            'icon' => 'fa-champagne-glasses ',
                            'title' => 'Learning That Inspires',
                            'desc' => 'Say goodbye to boring lessons. Our interactive curriculum makes learning fun and practical, with engaging
projects and content that bring tech to life.',
                        ],
                        [
                            'icon' => 'fa-certificate',
                            'title' => 'Guidance from Industry Pros',
                            'desc' => 'Learn from the best. Our instructors are real-world experts who are passionate about helping you succeed,
sharing insights you won’t find in textbooks.',
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



    <section style="background-color: #E9ECFF; padding: 60px 0;" class="accelerate">
    <div class="container">
        <!-- Title & Description -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3" style="font-size: 2.8rem; color: #0E2293;">
                    Intensive BootCamp
                </h2>
                <h4 class="mb-3" style="color: #0E2293;">
                    Empower Your Team. Transform Your Business.
                </h4>
                <p class="lead mb-4" style="font-size: 1.1rem; color: #333;">
                    Partner with us to train and develop your talent in high-impact tech skills. 
                    Our intensive bootcamps are designed to equip your team with the latest tools 
                    and knowledge to drive real results for your business.
                </p>
                <h4 class="mb-4" style="color: #0E2293;">
                    Ready to up-skill your workforce?
                </h4>
                <a href="{{ route('courses') }}" 
                   style="background-color: #0E2293; border: none; padding: 12px 30px; font-size: 1.1rem; border-radius: 6px;" 
                   class="btn btn-warning text-white fw-semibold">
                    Get Started
                </a>
            </div>
        </div>

        <!-- Video Section -->
        <div class="row">
            <div class="col-12">
                <div class="ratio ratio-16x9">
                    <iframe 
  src="https://www.youtube.com/embed/vkUfFhMsR6g"
                        title="YouTube video player" 
                        allowfullscreen 
                        style="border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- About Section -->

    <section style="background: linear-gradient(135deg, #E9ECFF 0%, #F4F6FF 100%); padding: 60px 0;" class="accelerate">
    <div class="container">
        <!-- Headline -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3" style="font-size: 2.8rem; color: #0E2293;">
                    Accelerate Your Workforce
                </h2>
                <p class="lead mb-3" style="font-size: 1.2rem; color: #333;">
                    Unlock Your Team’s Tech Potential
                </p>
                <p style="color: #444; font-size: 1.05rem; line-height: 1.6;">
                    Partner with us to train and develop your talent in the tech skills that matter most. 
                    Our tailored programs empower your workforce to innovate, adapt, and drive your business forward.
                </p>
                <h4 class="mb-4" style="color: #0E2293; font-weight: 600;">
                    Ready to future-proof your team?
                </h4>
                <a href="{{ route('corporate_training') }}" 
                   class="btn btn-lg text-white fw-semibold"
                   style="background-color: #0E2293; border: none; padding: 12px 30px; border-radius: 6px;">
                    Partner With Us
                </a>
            </div>
        </div>

        <!-- Video -->
        <div class="row">
            <div class="col-12">
                <div class="ratio ratio-16x9">
                    <iframe 
  src="https://www.youtube.com/embed/NKtNQm6JePc"
                        title="YouTube video player" 
                        allowfullscreen 
                        style="border-radius: 10px; box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.08);">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>


    <section style="background-color: #FFF3CF; padding: 60px 0;" class="accelerate text-white">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
    <div class="col-lg-8">
        <h2 class="fw-bold mb-3" style="font-size: 2.8rem; color: #0E2293;">
            Free Masterclass
        </h2>
        <p style="color: #444; font-size: 1.15rem; font-weight: 500;">
            Unlock Expert Insights — For Free!
        </p>
        <p class="lead mb-4" style="font-size: 1.15rem; color: #333; line-height: 1.6;">
            Join our exclusive masterclass series and learn directly from industry leaders. 
            Don’t miss this chance to boost your skills and grow your network.
        </p>
        <h4 class="mb-4" style="color: #0E2293; font-weight: 600;">
            Reserve your spot today!
        </h4>
        <a href="{{ route('masterclass') }}" 
           class="btn btn-lg fw-semibold text-white" 
           style="background-color: #FFC000; border: none; padding: 12px 30px; border-radius: 6px;">
            Sign Up Now
        </a>
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
                    'https://logos-world.net/wp-content/uploads/2021/08/Deloitte-Emblem.png',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThzUVNHMjee6gSYl7bTk-jT3npCZJw5qKcYA&s',
                'https://upload.wikimedia.org/wikipedia/commons/d/d3/National_Health_Service_%28England%29_logo.svg',
                'https://play-lh.googleusercontent.com/zvF7hv8g_NhRceUCZlEdwHBKEj7EneBHESau90TlARSdbvezPdQQ_HPA_JPypxyqNLRY=w600-h300-pc0xffffff-pd',

                   
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
