
@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section style="
  height: 40vh;
  background: linear-gradient(45deg, #041845, #0a3d62, #041845);
  background-size: 400% 400%;
  animation: animateBackground 10s ease infinite;
  color: #fff;
  display: flex;
  flex-direction: column; /* Stack items vertically */
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
" class="section dark-background">

        <div style="max-width: 700px; margin-bottom: 20px; margin-top: 100px;">
            <h2 style="margin-top: 20px;">Get in Touch</h2>
            <p style="margin: 15px 0;">
                We're here to assist you.            </p>
        </div>


    </section>


    <section class="faq py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Side -->
                <div class="col-lg-6">
                    <h3 class="mb-3">More than just Another Educational Platform</h3>
                    <p>We are your dedicated partner in mastering digital skills. Our approach combines rigorous learning with practical experience, setting us apart.</p>
                    <img style="height: 300px;" src="{{asset('https://sonim-tech.transforms.svdcdn.com/production/general/Heroes/header-contact.png?w=1241&h=524&auto=compress%2Cformat&fit=crop&dm=1727991844&s=5db54b57192867c3e5b95d2f9f1feacb')}}" class="img-fluid rounded shadow-sm" alt="Services">
                </div>

                <!-- Right Side: Form + Contact Info -->
                <div class="col-lg-6">
                    <div class="p-5 rounded-4 shadow-sm" style="background-color: #F7F7F7;">
                        <form method="POST" action="{{ route('contact.save') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}">
            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="col-md-6">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}">
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
            @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Subject" value="{{ old('subject') }}">
            @error('subject')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="col-12">
            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="4" placeholder="Your Message">{{ old('message') }}</textarea>
            @error('message')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="col-12 text-start">
            <button style="background-color: #0E2293; border:none;" type="submit" class="btn btn-primary px-4">Send Message</button>
        </div>
    </div>
</form>

                        <!-- Contact Info -->
                        <div class="mt-4">
                            <div class="d-flex align-items-start bg-warning-subtle p-3 rounded-3 mb-3">
                                <i class="bi bi-envelope-fill fs-4 text-warning me-3"></i>
                                <div>
                                    <h6 class="mb-1">Email Address</h6>
                                    <p class="mb-0">contact@odumaretech.com</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start bg-warning-subtle p-3 rounded-3 mb-3">
                                <i class="bi bi-envelope-fill fs-4 text-warning me-3"></i>
                                <div>
                                    <h6 class="mb-1">Phone Number</h6>
                                    <p class="mb-0">+447784927399</p>
                                </div>
                            </div>

                            <!-- Socials -->
                            <div class="bg-primary-subtle p-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="fw-semibold">Follow us on:</span>
                                <div class="d-flex gap-3 fs-5">
                                    <i  style="color: white; background-color: #0E2293;padding: 10px;" class="bi bi-facebook"></i>
                                    <i style="color: white; background-color: #0E2293; padding: 10px;" class="bi bi-twitter-x"></i>
                                    <i style="color: white; background-color: #0E2293;padding: 10px;" class="bi bi-instagram"></i>
                                    <i style="color: white; background-color: #0E2293;padding: 10px;" class="bi bi-linkedin"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection
