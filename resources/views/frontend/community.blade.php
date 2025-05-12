


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
            <h2 style="margin-top: 20px;">Join Our Learning Community</h2>
            <p style="margin: 15px 0;">
                We're excited that you're considering joining our diverse community of learners from around the world. Our platform offers access to over 2,000 expert-led courses, personalized learning paths, and recognized certifications that can help advance your career or personal development goals.            </p>
        </div>


    </section>


    <section class="faq py-5">
        <div class="container">
            <div class="row g-5 align-items-center">

                <!-- Right Side: Form + Contact Info -->
                <div class="col-lg-12">

                    <div class="p-4 rounded-4 shadow-sm" style="background-color: #F7F7F7;">
                        <h3 class="mb-4">Bio Data</h3>
                        <form enctype="multipart/form-data">
                            <div class="row g-3">

                                <!-- First Name -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                </div>


                                <!-- Email Address -->
                                <div class="col-12">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-12">
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" required>
                                </div>

                                <!-- Age -->
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="age" placeholder="Age" required>
                                </div>

                                <!-- Marital Status -->
                                <div class="col-md-6">
                                    <select class="form-select" name="marital_status" required>
                                        <option selected disabled>Marital Status</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </div>


                                <!-- Contact Information -->
                                <div class="col-12">
                                    <h5 class="mt-4">Contact Information</h5>
                                </div>

                                <!-- Address 1 -->
                                <div class="col-12">
                                    <input type="text" class="form-control" name="address1" placeholder="Address 1" required>
                                </div>

                                <!-- Country -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="country" placeholder="Country" required>
                                </div>

                                <!-- State -->
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="state" placeholder="State" required>
                                </div>

                                <!-- City -->
                                <div class="col-12">
                                    <input type="text" class="form-control" name="city" placeholder="City" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-start">
                                    <button style="background-color: #0E2293; border: none;" type="submit" class="btn btn-primary px-4">
                                        Submit
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
