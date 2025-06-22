@extends('instructor.app')

@section('content')
<style>
.custom-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}
.custom-toggle input[type="checkbox"] {
    display: none;
}
.toggle-slider {
    width: 40px;
    height: 20px;
    background: #ccc;
    border-radius: 20px;
    position: relative;
    transition: background 0.3s;
}
.toggle-slider::before {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    background: #fff;
    top: 2px;
    left: 2px;
    border-radius: 50%;
    transition: 0.3s;
}
.custom-toggle input[type="checkbox"]:checked + .toggle-slider {
    background: #28a745;
}
.custom-toggle input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(20px);
}
</style>

<div class="row my-4">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0 text-white">Edit Assignment</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('assignment.update', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-group mb-4">
                        <label>Assignment Title</label>
                        <input type="text" name="title" class="form-control" required value="{{ $assignment->title }}">
                        <small class="text-danger">@error('title') {{ $message }} @enderror</small>
                    </div>

                    <!-- Category -->
                    <div class="form-group mb-4">
                        <label>Assignment Category</label>
                        <select name="course_id" class="form-control" required>
                            <option disabled>Select Assignment Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cohorts -->
                    <div class="form-group mb-4">
                        <label>Cohort Visibility</label>
                        <div class="row">
                            @php
                                $selectedCohorts = is_array($assignment->cohort_id) ? $assignment->cohort_id : json_decode($assignment->cohort_id, true);
                            @endphp
                            @foreach($cohorts as $cohort)
                                <div class="col-md-4 mb-2">
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="cohort_id[]" value="{{ $cohort->id }}"
                                            {{ in_array($cohort->id, $selectedCohorts ?? []) ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                        {{ $cohort->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Attachment -->
                    <div class="form-group mb-4">
                        <label>Assignment Attachment</label>
                        <input type="file" class="form-control" name="image">
                        @if(!is_null($assignment->image))
                            <a href="{{ asset($assignment->image) }}" class="btn btn-outline-info mt-2" target="_blank" rel="noopener noreferrer">
                                View Attachment
                            </a>
                        @endif
                        <small class="text-danger d-block">@error('image') {{ $message }} @enderror</small>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-4">
                        <label>Assignment Description</label>
                        <textarea name="description" rows="5"  id="myTextarea" class="form-control" placeholder="Assignment Description">{{ $assignment->description }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-4">
                        <label>Assignment Status</label>
                        <select name="status" class="form-control" required>
                            <option disabled>Select Assignment Status</option>
                            <option value="pending" {{ $assignment->status == 'pending' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ $assignment->status == 'active' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
