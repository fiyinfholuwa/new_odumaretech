

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
                    <h3 class="mb-3">Empower Your Workforce with Our Corporate Training Solutions!</h3>
                    <img src="{{asset('https://epaouydin3q.exactdn.com/wp-content/uploads/2024/02/Corporate-Training-Personalization.jpg?strip=all&lossy=1&ssl=1')}}" class="img-fluid rounded shadow-sm" alt="Services">
                </div>

                <!-- Right Side: Form + Contact Info -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 shadow-sm" style="background-color: #F7F7F7;">
    <form action="{{ route('company.training.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">

            <!-- Full Name -->
            <div class="col-12">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" class="form-control" name="full_name" placeholder="Enter your full name" required>
            </div>

            <!-- Company Email Address -->
            <div class="col-12">
                <label for="email" class="form-label">Company Email Address</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your company email" required>
            </div>

            <!-- Company Name -->
            <div class="col-12">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Enter your company name" required>
            </div>

            <!-- Phone Number -->
            <div class="col-12">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" id="phone_number" class="form-control" name="phone_number" placeholder="Enter your phone number" required>
            </div>

            <!-- Team Size -->
            <div class="col-12">
                <label for="team_size" class="form-label">Team Size</label>
                <input type="number" id="team_size" class="form-control" name="team_size" placeholder="Enter your team size" required>
            </div>

            <!-- Available Course -->
            <div class="col-12">
                <label for="course_name" class="form-label">Available Course</label>
                <select id="course_name" class="form-select" name="course_name">
                    <option disabled {{ request('course_url') ? '' : 'selected' }}>Select a course</option>
                    @foreach ($courses as $course )
                        <option value="{{ $course->title }}" {{ request('course_url') == $course->title ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Engagement Type -->
            <div class="col-12">
                <label for="engagement_type" class="form-label">How Can We Engage You?</label>
                <select id="engagement_type" class="form-select" name="engagement_type" required>
                    <option selected disabled>Select engagement type</option>
                    <option value="consultation">Consultation</option>
                    <option value="project_development">Project Development</option>
                    <option value="training">Training</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <!-- Short Message -->
            <div class="col-12">
                <label for="message" class="form-label">Short Message</label>
                <textarea id="message" class="form-control" name="message" placeholder="What are you looking for?" rows="4" required></textarea>
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
