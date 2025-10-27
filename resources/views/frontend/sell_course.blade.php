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
                                        <div class="invalid-feedback">Enter a valid email</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control required" name="phone_number">
                                        <div class="invalid-feedback">Enter a valid phone number</div>
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
                                        <div class="invalid-feedback">LinkedIn profile is required</div>
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
                                    <p>{!! $tc !!}</p>
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
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("courseForm");
    const steps = ["step1", "step2", "step3"];
    let currentStep = 0;

    const patterns = {
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        phone: /^\d{7,15}$/,
        url: /^(https?:\/\/)?([\w\d-]+\.)+([a-zA-Z]{2,})(\/[^\s]*)?$/
    };

    function showStep(index) {
        index = Math.max(0, Math.min(index, steps.length - 1));
        currentStep = index;
        document.querySelectorAll(".tab-pane").forEach((pane, i) => {
            pane.classList.toggle("show", i === index);
            pane.classList.toggle("active", i === index);
        });
    }

    function showInvalidMessage(input) {
        const feedback = input.parentElement.querySelector(".invalid-feedback");
        if (feedback) feedback.classList.add("d-block");
    }

    function hideInvalidMessage(input) {
        const feedback = input.parentElement.querySelector(".invalid-feedback");
        if (feedback) feedback.classList.remove("d-block");
    }

    function validateField(input) {
        const value = (input.value || '').trim();
        let valid = true;

        // Required check
        if (input.classList.contains("required")) {
            if (input.type === "checkbox") valid = input.checked;
            else if (!value) valid = false;
        }

        // Type-specific validation only if there's a value
        if (value) {
            if (input.type === "email") valid = patterns.email.test(value);
            else if (input.type === "url" || input.name.includes("link") || input.placeholder?.toLowerCase().includes("http")) {
                valid = patterns.url.test(value);
            } else if (input.name === "phone_number") valid = patterns.phone.test(value);
        }

        if (!valid) {
            input.classList.add("is-invalid");
            input.classList.remove("is-valid");
            showInvalidMessage(input);
        } else {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
            hideInvalidMessage(input);
        }

        return valid;
    }

    function validateStep(index) {
        const stepPane = document.getElementById(steps[index]);
        const fields = stepPane.querySelectorAll("input, textarea");
        let validStep = true;

        fields.forEach(input => {
            if (!validateField(input)) validStep = false;
        });

        return validStep;
    }

    // Real-time validation
    form.querySelectorAll("input, textarea").forEach(input => {
        input.addEventListener("input", () => validateField(input));
        input.addEventListener("blur", () => validateField(input));
    });

    // NEXT button — only proceed if step is valid
    document.querySelectorAll(".next-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const ok = validateStep(currentStep);
            if (ok && currentStep < steps.length - 1) {
                showStep(currentStep + 1);
            } else if (!ok) {
                const invalid = document.querySelector(".tab-pane.show .is-invalid");
                if (invalid) invalid.scrollIntoView({ behavior: "smooth", block: "center" });
            }
        });
    });

    // PREVIOUS button
    document.querySelectorAll(".prev-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep > 0) showStep(currentStep - 1);
        });
    });

    // Terms & Conditions checkbox
    const agreeCheck = document.getElementById("agreeCheck");
    const finalSubmit = document.getElementById("finalSubmit");
    if (agreeCheck && finalSubmit) {
        agreeCheck.addEventListener("change", function () {
            finalSubmit.disabled = !this.checked;
            validateField(this);
        });
    }

    // When opening T&C modal, highlight invalids
    const termsModal = document.getElementById("termsModal");
    if (termsModal) {
        termsModal.addEventListener('show.bs.modal', function () {
            for (let i = 0; i < steps.length; i++) validateStep(i);
        });
    }

    // Final form submission
    form.addEventListener("submit", e => {
        let allValid = true;
        for (let i = 0; i < steps.length; i++) {
            if (!validateStep(i)) allValid = false;
        }

        if (!agreeCheck.checked) {
            agreeCheck.classList.add("is-invalid");
            showInvalidMessage(agreeCheck);
            allValid = false;
        }

        if (!allValid) {
            e.preventDefault();
            // Jump to first invalid step
            for (let i = 0; i < steps.length; i++) {
                const invalid = document.getElementById(steps[i]).querySelector(".is-invalid");
                if (invalid) {
                    showStep(i);
                    invalid.focus();
                    break;
                }
            }
        }
    });

    showStep(0);
});
</script>

</main>
@endsection
