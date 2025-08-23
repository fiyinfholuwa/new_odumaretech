@extends('instructor.app')

@section('content')
<div class="row my-4">
    <div class="col-md-11">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary text-white">
                <h3 class="card-title mb-0 bgc-primary-text">Add Live Session</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('session.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Session Title --}}
                    <div class="form-group mb-3">
                        <label for="session_title">Session Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="session_title" name="title" value="{{ old('title') }}" placeholder="Enter Session Title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Session Category (Course) --}}
                    <div class="form-group mb-3">
                        <label for="course_id">Session Category</label>
                        <select class="form-control @error('course_id') is-invalid @enderror" name="course_id" id="course_id" required>
                            <option disabled {{ old('course_id') ? '' : 'selected' }}>Select Session Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Cohorts as Toggle Sliders --}}
                    <div class="form-group mb-3">
                        <label class="form-label fw-semibold">Select Cohort(s)</label>
                        <div class="row">
                            @foreach($cohorts as $cohort)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               id="cohort_{{ $cohort->id }}"
                                               name="cohort_ids[]"
                                               value="{{ $cohort->id }}"
                                               {{ is_array(old('cohort_ids')) && in_array($cohort->id, old('cohort_ids')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cohort_{{ $cohort->id }}">
                                            {{ $cohort->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('cohort_ids')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Session Link --}}
                    <div class="form-group mb-3">
                        <label for="description">Session Link</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description" id="description" rows="4" placeholder="Paste session link here..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Session Date and Time --}}
                    <div class="form-group mb-4">
                        <label for="date">Session Time</label>
                        <input type="datetime-local" class="form-control @error('date') is-invalid @enderror"
                               name="date" id="date" value="{{ old('date') }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Add Session</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Optional Custom Toggle Color --}}
<style>
    .form-check-input:checked {
        background-color: #0E2293;
        border-color: #0E2293;
    }
</style>
@endsection
