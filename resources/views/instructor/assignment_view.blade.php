@extends('instructor.app')

@section('content')
<div class="row my-4">
    <div class="col-md-11">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Add Assignment</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('assignment.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Assignment Title --}}
                    <div class="form-group mb-3">
                        <label for="title">Assignment Title</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Enter Assignment Title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Assignment Category --}}
                    <div class="form-group mb-3">
                        <label for="course_id">Assignment Category</label>
                        <select class="form-control @error('course_id') is-invalid @enderror" name="course_id" id="course_id" required>
                            <option disabled {{ old('course_id') ? '' : 'selected' }}>Select Assignment Category</option>
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

                    {{-- Cohort Visibility as Sliders --}}
                    <div class="form-group mb-3">
                        <label>Cohort Visibility</label>
                        <div class="row">
                            @foreach($cohorts as $cohort)
                                <div class="col-md-4 col-lg-3 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               id="cohort_{{ $cohort->id }}"
                                               name="cohort_id[]"
                                               value="{{ $cohort->id }}"
                                               {{ is_array(old('cohort_id')) && in_array($cohort->id, old('cohort_id')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cohort_{{ $cohort->id }}">{{ $cohort->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('cohort_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Assignment Description --}}
                    <div class="form-group mb-3">
                        <label for="description">Assignment Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description"
                                  id="myTextarea"
                                  rows="6"
                                  placeholder="Assignment Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Assignment Attachment --}}
                    <div class="form-group mb-4">
                        <label for="image">Assignment Attachment</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4">Add Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
