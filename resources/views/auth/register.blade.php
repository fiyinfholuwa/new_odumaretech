<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Odumaretech</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }


        input::placeholder {
            opacity: 0.5 !important;
            color: #aaa !important;
        }


        /* Header */
        .header {
            background: white;
            padding: 16px 0;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .logo-placeholder {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1a73e8, #34a853);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: #1a73e8;
            margin: 0;
        }

        .back-home {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }

        .back-home:hover {
            color: #1a73e8;
        }

        /* Main Content */
        .main-wrapper {
            min-height: calc(100vh - 100px);
            display: flex;
            align-items: center;
        }

        /* Testimonials Section */
        .testimonials {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            border-radius: 20px;
            padding: 48px;
            color: white;
            position: relative;
            overflow: hidden;
            height: fit-content;
        }

        .testimonials::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://www.korvia.com/wp-content/uploads/2015/10/testimonial-background-academy.jpg');
            opacity: 0.3;
        }

        .testimonials-content {
            position: relative;
            z-index: 1;
        }

        .testimonials h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .testimonials .lead {
            font-size: 18px;
            color: #b3b3b3;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 32px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .testimonial-text {
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 24px;
            color: #e8e8e8;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b, #feca57);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 16px;
        }

        .author-info h5 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: white;
        }

        .testimonial-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
        }

        .nav-arrows {
            display: flex;
            gap: 12px;
        }

        .nav-arrow {
            width: 44px;
            height: 44px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 16px;
        }

        .nav-arrow:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .nav-arrow.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .navigation-dots {
            display: flex;
            gap: 10px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s;
        }

        .dot.active {
            background: #feca57;
            transform: scale(1.2);
        }

        /* Login Form */
        .login-form {
            background: white;
            border-radius: 20px;
            padding: 48px;
            /*box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);*/
            height: fit-content;
        }

        .login-form h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #212529;
        }

        .login-form .text-muted {
            margin-bottom: 40px;
            font-size: 16px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating input {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 16px;
            padding: 16px 12px;
            height: 60px;
        }

        .form-floating input:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 0.2rem rgba(26, 115, 232, 0.25);
        }

        /*.form-floating label {*/
        /*    font-weight: 500;*/
        /*}*/

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            font-size: 30px;
            z-index: 10;
        }

        .form-check {
            margin-bottom: 32px;
        }

        .form-check-input:checked {
            background-color: #1a73e8;
            border-color: #1a73e8;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #1a73e8, #1557b0);
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 32px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1557b0, #1a73e8);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 115, 232, 0.3);
        }

        .signup-link {
            text-align: center;
            margin-bottom: 32px;
        }

        .social-login {
            text-align: center;
        }

        .social-login .text-muted {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .social-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }

        .social-btn {
            width: 56px;
            height: 56px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-btn:hover {
            border-color: #1a73e8;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-wrapper {
                padding: 20px;
            }

            .testimonials,
            .login-form {
                padding: 32px 24px;
            }

            .testimonials h2 {
                font-size: 28px;
            }

            .login-form h2 {
                font-size: 32px;
            }

            .testimonials{
                display: none;
            }
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="logo-container">
                    <!-- Replace with actual logo image -->
                    <h1 class="logo-text"><a href="{{route('home')}}" class="logo d-flex align-items-center me-auto me-lg-0">
                            <!-- Uncomment the line below if you also wish to use an image logo -->
                            <img  style="border-radius:10px; width: 200px;" src="{{ asset('logo.png') }}" alt="">
                            <!-- <h1 class="sitename">GP</h1>
                            <span>.</span> -->
                        </a>
                    </h1>
                </div>
            </div>
            <div class="col-6 t">
                <a href="{{route('home')}}" class="back-home">
                    <i class="bi bi-arrow-left"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="main-wrapper">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Testimonials Section -->
            <div class="col-lg-7">
    <section class="testimonials">
        <div class="testimonials-content">
            <h2>Students Testimonials</h2>
            <p class="lead">
                From career transformations to breakthrough moments, our students' success stories speak volumes.
            </p>

            @foreach ($testimonials as $index => $testimonial)
                <div class="testimonial-card {{ $index === 0 ? '' : 'd-none' }}" id="testimonial-{{ $index + 1 }}">
                    <div>
                        <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                    </div>
                    <div class="testimonial-author">
                        @if ($testimonial->image)
                            <img  style="height:100px; width:100px; border-radius:30px;" src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" class="author-avatar-img">
                        @else
                            <div class="author-avatar">
                                {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                            </div>
                        @endif
                        <div class="author-info">
                            <h5>{{ $testimonial->name }}</h5>
                            @if ($testimonial->title)
                                <small>{{ $testimonial->title }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="testimonial-navigation">
                <div class="nav-arrows">
                    <div class="nav-arrow" onclick="previousTestimonial()">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <div class="nav-arrow" onclick="nextTestimonial()">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </div>
                <div class="navigation-dots">
                    @foreach ($testimonials as $index => $testimonial)
                        <div class="dot {{ $index === 0 ? 'active' : '' }}" onclick="showTestimonial({{ $index + 1 }})"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
let currentTestimonial = 1;
const totalTestimonials = {{ count($testimonials) }};

function showTestimonial(n) {
    for (let i = 1; i <= totalTestimonials; i++) {
        document.getElementById('testimonial-' + i).classList.add('d-none');
        document.querySelectorAll('.dot')[i - 1].classList.remove('active');
    }
    document.getElementById('testimonial-' + n).classList.remove('d-none');
    document.querySelectorAll('.dot')[n - 1].classList.add('active');
    currentTestimonial = n;
}

function nextTestimonial() {
    currentTestimonial = currentTestimonial >= totalTestimonials ? 1 : currentTestimonial + 1;
    showTestimonial(currentTestimonial);
}

function previousTestimonial() {
    currentTestimonial = currentTestimonial <= 1 ? totalTestimonials : currentTestimonial - 1;
    showTestimonial(currentTestimonial);
}
</script>

</div>

            <!-- Login Form -->
            <div class="col-lg-5">
                <section style="background-color: #D9D9D9;" class="login-form">
                    <h2>Register</h2>
                    <p class="text-muted">Welcome back! Please log in to access your account.</p>

                    <form id="loginForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" placeholder="" required value="{{ old('name') }}">
                            <label for="name">Full Name</label>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" placeholder="" required value="{{ old('email') }}">
                            <label for="email">Email Address</label>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('referral_code') is-invalid @enderror"
                                   id="referral_code" name="referral_code" placeholder=""
                                   value="{{ old('referral_code', request('ref')) }}">
                            <label for="referral_code">Referral Code</label>
                            @error('referral_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Password" required>
                            <button type="button" class="password-toggle btn btn-sm btn-light position-absolute end-0 top-0 mt-2 me-2" onclick="togglePassword()">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password_confirmation" placeholder="Password" required>
                            <button type="button" class="password-toggle btn btn-sm btn-light position-absolute end-0 top-0 mt-2 me-2" onclick="togglePassword()">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <!-- Submit -->
                        <button type="submit" style="background-color: #0E2293;" class="btn btn-primary btn-login">Register</button>
                    </form>

                    <div class="signup-link">
                        <p class="text-muted">You Already have an account? <a href="{{route('login')}}" class="text-decoration-none fw-semibold">Login</a></p>
                    </div>

{{--                    <div class="social-login">--}}
{{--                        <p class="text-muted">Or login using:</p>--}}
{{--                        <div class="social-buttons">--}}
{{--                            <a href="#" class="social-btn" title="Login with Google">--}}
{{--                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>--}}
{{--                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>--}}
{{--                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>--}}
{{--                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="social-btn" title="Login with Apple">--}}
{{--                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">--}}
{{--                                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="social-btn" title="Login with GitHub">--}}
{{--                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">--}}
{{--                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </section>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Testimonial carousel functionality
    let currentTestimonial = 1;
    const totalTestimonials = 3;

    function showTestimonial(num) {
        // Hide all testimonials
        for (let i = 1; i <= totalTestimonials; i++) {
            document.getElementById('testimonial-' + i).classList.add('d-none');
        }

        // Show selected testimonial
        document.getElementById('testimonial-' + num).classList.remove('d-none');

        // Update dots
        document.querySelectorAll('.dot').forEach(dot => dot.classList.remove('active'));
        document.querySelectorAll('.dot')[num - 1].classList.add('active');

        currentTestimonial = num;
    }

    function nextTestimonial() {
        const next = currentTestimonial === totalTestimonials ? 1 : currentTestimonial + 1;
        showTestimonial(next);
    }

    function previousTestimonial() {
        const prev = currentTestimonial === 1 ? totalTestimonials : currentTestimonial - 1;
        showTestimonial(prev);
    }

    // Auto-rotate testimonials every 6 seconds
    setInterval(() => {
        nextTestimonial();
    }, 6000);

    // Password toggle functionality
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleButton = document.querySelector('.password-toggle i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.className = 'bi bi-eye-slash';
        } else {
            passwordField.type = 'password';
            toggleButton.className = 'bi bi-eye';
        }
    }

    // Form submission handling

    // Add loading states to social login buttons
    document.querySelectorAll('.social-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const platform = this.getAttribute('title').split(' ')[2];

            // Add loading effect
            const originalContent = this.innerHTML;
            this.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div>';

            setTimeout(() => {
                alert(`${platform} authentication would be implemented here!`);
                this.innerHTML = originalContent;
            }, 1000);
        });
    });

    // Logo image replacement function
    function setLogoImage(imageSrc) {
        const logoContainer = document.getElementById('logoContainer');
        logoContainer.innerHTML = `<img src="${imageSrc}" alt="Odumaretech Logo" class="logo-image">`;
    }

    // Example: setLogoImage('path/to/your/logo.png');
</script>
</body>
</html>
