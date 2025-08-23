@extends('instructor.app')

@section('content')
<style>
/* Toggle switch styling for cohort checkboxes */
.custom-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    user-select: none;
}

.custom-toggle input[type="checkbox"] {
    display: none;
}

.toggle-slider {
    position: relative;
    width: 45px;
    height: 24px;
    background-color: #ccc;
    border-radius: 34px;
    transition: background-color 0.3s;
}

.toggle-slider::before {
    content: "";
    position: absolute;
    left: 3px;
    top: 3px;
    width: 18px;
    height: 18px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.custom-toggle input[type="checkbox"]:checked + .toggle-slider {
    background-color: #28a745;
}

.custom-toggle input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(21px);
}

.toggle-label {
    font-weight: 500;
    color: #333;
}
</style>

<div class="row my-4">
    <div class="col-md-10">
        <div class="card ">
            <div class="card-header bgc-primary ">
                <h4 class="mb-0 bgc-primary-text">Add Slide</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('slide.add') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Slide Title -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Slide Title" required>
                        <small class="text-danger font-weight-bold">
                            @error('title') {{ $message }} @enderror
                        </small>
                    </div>

                    <!-- Slide Category -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Category</label>
                        <select class="form-control" name="course_id" required>
                            <option disabled selected>Select Slide Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cohort Visibility (with toggles) -->
                    <div class="form-group mb-4">
                        <label class="fw-bold d-block mb-2">Cohort Visibility</label>
                        <div class="row">
                            @foreach($cohorts as $cohort)
                                <div class="col-md-4 mb-3">
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="cohort_id[]" value="{{ $cohort->id }}">
                                        <span class="toggle-slider"></span>
                                        <span class="toggle-label">{{ $cohort->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide Attachment -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Attachment</label>
                        <input type="file" class="form-control" name="image" required>
                        <small class="text-danger font-weight-bold">
                            @error('image') {{ $message }} @enderror
                        </small>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Add Slide</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
