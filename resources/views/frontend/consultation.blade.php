

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
            <h2 style="margin-top: 20px;">Ready to Empower your WorkForce</h2>
            <p style="margin: 15px 0;">
                Let's discuss how our corporate training solutions can address your specific needs. Fill out the form below, and one of our training specialists will reach out to schedule a personalized consultation.            </p>
        </div>


    </section>


    <section class="faq py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Side -->
                <div class="col-lg-6">
                    <h3 class="mb-3">Become an Instructor with Us Today!</h3>
                    <img src="{{asset('frontend/assets/img/Container.png')}}" class="img-fluid rounded shadow-sm" alt="Services">
                </div>

                <!-- Right Side: Form + Contact Info -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 shadow-sm" style="background-color: #F7F7F7;">
                        <form enctype="multipart/form-data">
                            <div class="row g-3">

                                <!-- Full Name -->
                                <div class="col-12">
                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
                                </div>

                                <!-- Company Email Address -->
                                <div class="col-12">
                                    <input type="email" class="form-control" name="email" placeholder="Company Email Address" required>
                                </div>

                                <!-- Company Name -->
                                <div class="col-12">
                                    <input type="text" class="form-control" name="company_name" placeholder="Company Name" required>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-12">
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                                </div>

                                <!-- Team Size -->
                                <div class="col-12">
                                    <input type="number" class="form-control" name="team_size" placeholder="Team Size" required>
                                </div>

                                <!-- How Can We Engage You -->
                                <div class="col-12">
                                    <select class="form-select" name="engagement_type" required>
                                        <option selected disabled>How Can We Engage You?</option>
                                        <option value="consultation">Consultation</option>
                                        <option value="project_development">Project Development</option>
                                        <option value="training">Training</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <!-- Short Message -->
                                <div class="col-12">
                                    <textarea class="form-control" name="message" placeholder="Short Message - What are you looking for?" rows="4" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-start">
                                    <button style="background-color: #0E2293; border: none;" type="submit" class="btn btn-primary px-4">
                                        Send Message
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
