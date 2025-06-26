@extends('instructor.app')

@section('content')
<style>
    .form-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .form-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .form-switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #d1d5db;
        transition: 0.4s;
        border-radius: 34px;
        box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .form-switch .slider::before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .form-switch input:checked + .slider {
        background-color: #4caf50;
    }

    .form-switch input:checked + .slider::before {
        transform: translateX(24px);
    }

    .toggle-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f9fafb;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: background 0.3s;
    }

    .toggle-label:hover {
        background: #f3f4f6;
    }
</style>

<div class="row my-4">
    <div class="col-md-11">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Edit Live Session</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('session.update', $session->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Session Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $session->title }}" placeholder="Enter Session Title" required>
                        @error('title')
                            <div class="text-danger small fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Session Category</label>
                        <select class="form-control" name="course_id" required>
                            <option disabled>Select Session Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $session->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    @php
    $selectedCohorts = json_decode($session->cohort_id ?? '[]', true) ?: [];
@endphp

<div class="mb-4">
    <label class="form-label mb-2">Cohort Categories</label>
    <div class="row">
        @foreach($cohorts as $cohort)
            <div class="col-md-6">
                <label class="toggle-label">
                    <span>{{ $cohort->name }}</span>
                    <div class="form-switch">
                        <input type="checkbox" name="cohort_ids[]" value="{{ $cohort->id }}"
                            {{ in_array($cohort->id, $selectedCohorts) ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </div>
                </label>
            </div>
        @endforeach
    </div>
</div>

                    <div class="mb-3">
                        <label class="form-label">Session Link</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Enter session link or description">{{ $session->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Session Time</label>
                        <input type="datetime-local" class="form-control" name="date" value="{{ $session->time }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Session Status</label>
                        <select class="form-control" name="status" required>
                            <option disabled>Select Session Status</option>
                            <option value="pending" {{ $session->status == 'pending' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ $session->status == 'active' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success">Update Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
