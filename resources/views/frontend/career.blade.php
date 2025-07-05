

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
                        <form enctype="multipart/form-data" method="POST" action="{{ route('instructor.add') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
        </div>

        <div class="col-12">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">
        </div>

        <div class="col-md-6">
            <select class="form-select" name="gender">
                <option disabled {{ old('gender') ? '' : 'selected' }}>Gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="col-md-6">
            <select class="form-select" name="career_level">
                <option disabled {{ old('career_level') ? '' : 'selected' }}>Level of Career</option>
                <option value="student" {{ old('career_level') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="entry" {{ old('career_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                <option value="mid" {{ old('career_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                <option value="senior" {{ old('career_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
            </select>
        </div>

        <div class="col-12">
            <label class="form-label fw-semibold">Select Course(s)</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($courses as $course)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" 
                               id="course_{{ $course->title }}" 
                               name="courses[]" 
                               value="{{ $course->title }}"
                               {{ is_array(old('courses')) && in_array($course->title, old('courses')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="course_{{ $course->title }}">
                            {{ $course->title }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('courses')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="resume-upload" class="form-label fw-semibold">Resume Upload</label>
            <div class="drop-area" onclick="document.getElementById('resume-upload').click();">
                <p class="text-muted m-0">Drag & drop your resume here, or click to select file</p>
                <input type="file" name="resume" id="resume-upload" accept=".pdf,.doc,.docx" hidden>
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
<script>
    const fileInput = document.getElementById('resume-upload');
    const dropArea = document.querySelector('.drop-area');

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            dropArea.innerHTML = '<p class="text-success m-0">' + fileInput.files[0].name + '</p>';
        }
    });
</script>

</main>

@endsection
