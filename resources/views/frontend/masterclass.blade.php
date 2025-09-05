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
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
    " class="section dark-background">
        <div style="max-width: 700px; margin-top: 80px;">
            <h2 style="margin-top: 20px;">Join Our Free Masterclass</h2>
            <p style="margin: 15px 0;">
                Join Our Exclusive Free Masterclass Series – Your Gateway to Professional Knowledge. 
                Seize the Opportunity to Learn Directly from Industry Experts. Reserve Your Spot Now!
            </p>
        </div>
    </section>

    <section class="faq py-5">
        <div class="container">
            @if(!$master_class || !$master_class->title || !$master_class->image || !$master_class->text_body)
                <div class="text-center py-5">
                    <h3>No Master Class Available</h3>
                </div>
            @else
                <div class="row g-5 align-items-start">
                    <!-- Left Side: Title + Image -->
                    <div class="col-lg-5">
                        <h2 class="mb-3">{{ $master_class->title }}</h2>
                        <img src="{{ asset($master_class->image) }}" class="img-fluid rounded shadow-sm mb-4" alt="Masterclass Image">
                    </div>

                    <!-- Right Side: Text + Form -->
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <p class="text-muted" style="line-height: 1.7;">
                                {!! $master_class->text_body !!}
                            </p>
                        </div>

                        <div class="p-4 rounded-4 shadow-sm" style="background-color: #F7F7F7;">
                            <h5 class="mb-3">Reserve Your Spot</h5>
                            <form enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                    </div>

                                    <div class="col-12">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="phone_number" placeholder="Phone Number">
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select" name="interested_skill">
                                            <option selected disabled>Interested Skill</option>
                                            <option value="web_development">Web Development</option>
                                            <option value="ui_ux_design">UI/UX Design</option>
                                            <option value="data_analysis">Data Analysis</option>
                                            <option value="digital_marketing">Digital Marketing</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-select" name="gender">
                                            <option selected disabled>Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-select" name="career_level">
                                            <option selected disabled>Level of Career</option>
                                            <option value="student">Student</option>
                                            <option value="entry">Entry Level</option>
                                            <option value="mid">Mid Level</option>
                                            <option value="senior">Senior Level</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="location" placeholder="Location">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="subscribe" id="subscribe">
                                            <label class="form-check-label" for="subscribe">
                                                Subscribe to mailing list
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-start">
                                        <button style="background-color: #0E2293; border: none;" type="submit" class="btn btn-primary px-4">
                                            Join Master Class
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

</main>
@endsection
