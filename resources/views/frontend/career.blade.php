

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
            <h2 style="margin-top: 20px;">Join Our Team</h2>
            <p style="margin: 15px 0;">
                You have the knowledge and the expertise, we have the platform. Join us upskill the next generation of tech talents.            </p>
        </div>


    </section>


    <section class="faq py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Side -->
                <div class="col-lg-6">
                    <h3 class="mb-3">Become an Instructor with Us Today!</h3>
                    <img src="{{asset('https://www.cei.se/media/wysiwyg/elearn-banner.jpg')}}" class="img-fluid rounded shadow-sm" alt="Services">
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
                                    <select class="form-select" name="course">
                                        <option selected disabled>Choose Course</option>
                                        <option value="web_dev">Web Development</option>
                                        <option value="ui_ux">UI/UX Design</option>
                                        <option value="data">Data Analysis</option>
                                        <option value="marketing">Digital Marketing</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="resume-upload" class="form-label fw-semibold">Resume Upload</label>
                                    <div class="drop-area" onclick="document.getElementById('resume-upload').click();">
                                        <p class="text-muted m-0">Drag & drop your resume here, or click to select file</p>
                                        <input type="file" name="resume" id="resume-upload" accept=".pdf,.doc,.docx">
                                    </div>
                                </div>

                                <div class="col-12 text-start">
                                    <button style="background-color: #0E2293; border: none;" type="submit" class="btn btn-primary px-4">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <style>
                    .drop-area {
                        border: 2px dashed #0E2293;
                        padding: 40px;
                        border-radius: 10px;
                        text-align: center;
                        background-color: #fff;
                        transition: border-color 0.3s;
                        cursor: pointer;
                    }

                    .drop-area:hover {
                        border-color: #001b6d;
                    }

                    #resume-upload {
                        display: none;
                    }
                </style>

            </div>
        </div>
    </section>

</main>

@endsection
