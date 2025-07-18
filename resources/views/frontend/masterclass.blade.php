


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
            <h2 style="margin-top: 20px;">Join Our Free Masterclass</h2>
            <p style="margin: 15px 0;">
                Join Our Exclusive Free Masterclass Series – Your Gateway to Professional Knowledge. Seize the Opportunity to Learn Directly from Industry Experts. Reserve Your Spot Now!            </p>
        </div>


    </section>


    <section class="faq py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Side -->
                <div class="col-lg-6">
                    <img src="{{asset('https://d3vtxdl4wke3e9.cloudfront.net/uploads/resized/all/802635/AMS_BITM-header-resized-web_c10be1b993ca978bc3b3470fe60373f5.jpg')}}" class="img-fluid rounded shadow-sm" alt="Services">
                </div>

                <!-- Right Side: Form + Contact Info -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 shadow-sm" style="background-color: #F7F7F7;">
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
        </div>
    </section>

</main>

@endsection
