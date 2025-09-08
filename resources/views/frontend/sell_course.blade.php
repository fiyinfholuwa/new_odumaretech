@extends('frontend.layout.app')

@section('content')
<main class="main">

    <!-- Hero Section -->
    <section class="section dark-background d-flex flex-column align-items-center justify-content-center text-center text-white py-5"
             style="height: 40vh; background: linear-gradient(45deg, #041845, #0a3d62, #041845); background-size: 400% 400%; animation: animateBackground 10s ease infinite;">
        <div class="container mt-5" style="max-width: 700px;">
            <h2 class="mt-3">Become a Course Creator with Us</h2>
            <p class="mt-3">
                Share your expertise, social media presence, and past works. 
                Our team will review your application and get in touch to discuss publishing your course. 
            </p>
        </div>
    </section>

   <section class="faq py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="p-4 rounded-4 shadow-sm bg-light">

                    <form id="courseForm" action="{{ route('content.creator.store') }}" method="POST">
                        @csrf

                        <!-- Step Content -->
                        <div class="tab-content" id="wizard-content">

                            <!-- Step 1 -->
                            <div class="tab-pane fade show active" id="step1">
                                <h5 class="mb-3">Step 1: Personal Info</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control required" name="first_name">
                                        <div class="invalid-feedback">First name is required</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control required" name="last_name">
                                        <div class="invalid-feedback">Last name is required</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control required" name="email">
                                        <div class="invalid-feedback">Valid email is required</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control required" name="phone_number">
                                        <div class="invalid-feedback">Valid phone number is required</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Tell Us About Yourself</label>
                                        <textarea class="form-control required" name="about" rows="3"></textarea>
                                        <div class="invalid-feedback">This field is required</div>
                                    </div>
                                </div>
                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="tab-pane fade" id="step2">
                                <h5 class="mb-3">Step 2: Social Links</h5>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">LinkedIn Profile <span class="text-danger">*</span></label>
                                        <input type="url" class="form-control required" name="linkedin" placeholder="LinkedIn Profile">
                                        <div class="invalid-feedback">LinkedIn is required</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Other Social Media (Optional)</label>
                                        <input type="url" class="form-control mb-2" name="twitter" placeholder="Twitter/X Profile">
                                        <input type="url" class="form-control mb-2" name="instagram" placeholder="Instagram Profile">
                                        <input type="url" class="form-control mb-2" name="youtube" placeholder="YouTube Channel">
                                        <input type="url" class="form-control mb-2" name="tiktok" placeholder="TikTok Profile">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Links to Your Work (Optional)</label>
                                        <input type="url" class="form-control mb-2" name="portfolio" placeholder="Portfolio/Website">
                                        <input type="url" class="form-control mb-2" name="github" placeholder="GitHub/Project Link">
                                        <input type="url" class="form-control mb-2" name="other_work" placeholder="Other Relevant Link">
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-primary next-btn">Next</button>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="tab-pane fade" id="step3">
                                <h5 class="mb-3">Step 3: Course Details</h5>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Proposed Course Title</label>
                                        <input type="text" class="form-control required" name="course_name">
                                        <div class="invalid-feedback">Course title is required</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Course Description</label>
                                        <textarea class="form-control required" name="message" rows="4"></textarea>
                                        <div class="invalid-feedback">Description is required</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Sample Work Link (Optional)</label>
                                        <input type="url" class="form-control" name="sample_link" placeholder="Paste link to sample work">
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-btn">Previous</button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#termsModal">
                                        Proceed
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Terms Modal -->
                    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Terms & Conditions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                    <p><strong>Agreement:</strong> By proceeding, you agree to our platform's terms and conditions, including compliance with guidelines, quality standards, and professional conduct as an instructor.</p>
                                    <p>Lorem ipsum text for the terms... (replace with real terms)</p>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input required" type="checkbox" id="agreeCheck">
                                        <label class="form-check-label" for="agreeCheck">
                                            I have read and agree to the Terms & Conditions
                                        </label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="finalSubmit" form="courseForm" disabled>
                                        Submit Application
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("courseForm");
    const steps = ["step1", "step2", "step3"];
    let currentStep = 0;

    function showStep(index) {
        document.querySelectorAll(".tab-pane").forEach((pane, i) => {
            pane.classList.remove("show", "active");
            if (i === index) {
                pane.classList.add("show", "active");
            }
        });
    }

    function validateStep(index) {
        let valid = true;
        let stepPane = document.getElementById(steps[index]);
        let requiredFields = stepPane.querySelectorAll(".required");

        requiredFields.forEach(input => {
            if (!input.value.trim() || (input.type === "checkbox" && !input.checked)) {
                input.classList.add("is-invalid");
                valid = false;
            } else {
                input.classList.remove("is-invalid");
            }

            // Email check
            if (input.name === "email" && input.value) {
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(input.value)) {
                    input.classList.add("is-invalid");
                    valid = false;
                }
            }

            // Phone check
            if (input.name === "phone_number" && input.value) {
                let phonePattern = /^\d{7,15}$/;
                if (!phonePattern.test(input.value)) {
                    input.classList.add("is-invalid");
                    valid = false;
                }
            }

            // LinkedIn required
            if (input.name === "linkedin" && !input.value.trim()) {
                input.classList.add("is-invalid");
                valid = false;
            }
        });

        return valid;
    }

    // Next button
    document.querySelectorAll(".next-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    // Previous button
    document.querySelectorAll(".prev-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            currentStep--;
            showStep(currentStep);
        });
    });

    // Checkbox in modal enables submit
    document.getElementById("agreeCheck").addEventListener("change", function () {
        document.getElementById("finalSubmit").disabled = !this.checked;
    });

    // Submit validation
    form.addEventListener("submit", function (e) {
        if (!validateStep(currentStep)) {
            e.preventDefault();
        }
    });
});
</script>

</main>

{{-- JavaScript Wizard Validation --}}

@endsection
