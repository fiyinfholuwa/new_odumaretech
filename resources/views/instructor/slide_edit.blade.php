@extends('instructor.app')

@section('content')
<style>
/* Toggle styling for cohort checkboxes */
.custom-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.custom-toggle input[type="checkbox"] {
    display: none;
}

.toggle-slider {
    position: relative;
    width: 42px;
    height: 22px;
    background-color: #ccc;
    border-radius: 34px;
    transition: background-color 0.3s ease;
}

.toggle-slider::before {
    content: "";
    position: absolute;
    left: 3px;
    top: 3px;
    width: 16px;
    height: 16px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s ease;
}

.custom-toggle input[type="checkbox"]:checked + .toggle-slider {
    background-color: #28a745;
}

.custom-toggle input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(18px);
}

.toggle-label {
    font-weight: 500;
    color: #333;
}
</style>

<div class="row my-4">
    <div class="col-md-10 ">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-white">Edit Slide</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('slide.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Slide Title -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Title</label>
                        <input type="text" class="form-control" name="title" required value="{{ $slide->title }}">
                        <small class="text-danger">@error('title') {{ $message }} @enderror</small>
                    </div>

                    <!-- Slide Category -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Category</label>
                        <select class="form-control" name="course_id" required>
                            <option disabled>Select Slide Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $slide->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cohort Visibility -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Cohort Visibility</label>
                        <div class="row">
                            @php $selectedCohorts = is_array($slide->cohort_id) ? $slide->cohort_id : json_decode($slide->cohort_id, true); @endphp
                            @foreach($cohorts as $cohort)
                                <div class="col-md-4 mb-3">
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="cohort_id[]" value="{{ $cohort->id }}"
                                            {{ in_array($cohort->id, $selectedCohorts ?? []) ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                        <span class="toggle-label">{{ $cohort->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide Status -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Status</label>
                        <select class="form-control" name="status" required>
                            <option disabled>Select Slide Status</option>
                            <option value="pending" {{ $slide->status == 'pending' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ $slide->status == 'active' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>

                    <!-- Slide Attachment -->
                    <div class="form-group mb-4">
                        <label class="fw-bold">Slide Attachment</label>
                        <input type="file" class="form-control" name="image">
                        <a target="_blank" rel="noopener noreferrer" class="btn btn-outline-info mt-2" href="{{ asset($slide->image) }}">
                            <i class="fa fa-eye"></i> View Current Slide
                        </a>
                        <small class="text-danger d-block mt-1">@error('image') {{ $message }} @enderror</small>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Update Slide</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
