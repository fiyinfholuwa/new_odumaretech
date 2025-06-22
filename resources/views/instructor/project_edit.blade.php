@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-11">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary  text-white">
                <h4 class="card-title mb-0 text-white">Edit Final Project</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('project.update', $project->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Project Title</label>
                        <input type="text" class="form-control" name="title" required value="{{ $project->title }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Project Category</label>
                        <select class="form-control" name="course_id" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $project->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Toggle Sliders for Cohorts --}}
                    <div class="form-group mb-4">
                        <label>Select Cohorts</label>
                        <div class="d-flex flex-wrap gap-3">
                            @php
                                $selectedCohorts = json_decode($project->cohort_id, true) ?? [];
                            @endphp

                            @foreach($cohorts as $cohort)
                                <div class="custom-toggle">
                                    <label class="switch">
                                        <input type="checkbox" name="cohort_id[]" value="{{ $cohort->id }}"
                                            {{ in_array($cohort->id, $selectedCohorts) ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="label-text">{{ $cohort->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Project Status</label>
                        <select class="form-control" name="status" required>
                            <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Project Attachment</label>
                        <input type="file" class="form-control" name="image">
                        @if($project->image)
                            <div class="mt-2">
                                <a href="{{ asset($project->image) }}" target="_blank" class="btn btn-info btn-sm">
                                    View Current File
                                </a>
                            </div>
                        @endif
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Project Description</label>
                        <textarea class="form-control" id="myTextarea" name="description" rows="5">{{ $project->description }}</textarea>
                    </div>

                    <div class="card-footer bg-white text-end">
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- Toggle Slider Styles --}}
<style>
    .custom-toggle {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        margin-right: 20px;
    }

    .label-text {
        margin-left: 10px;
        font-weight: 500;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 25px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 19px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    .switch input:checked + .slider {
        background-color: #28a745;
    }

    .switch input:checked + .slider:before {
        transform: translateX(24px);
    }
</style>

@endsection
