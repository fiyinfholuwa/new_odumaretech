@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-11">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-primary text-white">
                <h4 class="card-title mb-0  bgc-primary-text">Manage Final Project</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('project.final.add') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="title">Project Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Project Title" required>
                        <small class="text-danger font-weight-bold">@error('title'){{ $message }}@enderror</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="course">Project Category</label>
                        <select class="form-control" name="course_id" required>
                            <option disabled selected>Select Project Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="cohort">Cohort Category</label>
                        <div class="d-flex flex-wrap gap-3">
                            @forelse($cohorts as $cohort)
                                <div class="form-check form-switch" style="min-width: 200px;">
                                    <input class="form-check-input fancy-toggle" type="checkbox" id="cohort{{ $cohort->id }}" name="cohort_id[]" value="{{ $cohort->id }}">
                                    <label class="form-check-label" for="cohort{{ $cohort->id }}">{{ $cohort->name }}</label>
                                </div>
                            @empty
                                <p class="text-muted">No Cohorts Available</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="image">Project Attachment</label>
                        <input type="file" class="form-control" name="image" required>
                        <small class="text-danger font-weight-bold">@error('image'){{ $message }}@enderror</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description">Project Description</label>
                        <textarea class="form-control" id="myTextarea" name="description" rows="5" placeholder="Project Description"></textarea>
                        <small class="text-danger font-weight-bold">@error('description'){{ $message }}@enderror</small>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success px-4">Add Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Extra toggle styling --}}
<style>
    .form-check-input.fancy-toggle {
        width: 3rem;
        height: 1.5rem;
        background-color: #d3d3d3;
        border-radius: 1rem;
        position: relative;
        transition: background-color 0.3s ease-in-out;
    }

    .form-check-input.fancy-toggle:checked {
        background-color: navy;
    }

    .form-check-input.fancy-toggle::before {
        content: "";
        position: absolute;
        top: 3px;
        left: 3px;
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    }

    .form-check-input.fancy-toggle:checked::before {
        transform: translateX(24px);
    }

    .form-check-label {
        margin-left: 10px;
        font-weight: 500;
    }

    .gap-3 {
        gap: 1.5rem !important;
    }
</style>

@endsection
