@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-11 ">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="card-title mb-0"> <h4 class="text-white">Edit Notification</h4> </div>
            </div>
            <div class="card-body">
                <form action="{{ route('notification.update', $notification->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="title">Notification Title</label>
                        <input type="text" class="form-control" name="title" required value="{{ $notification->title }}" placeholder="Enter Notification Title">
                        <small class="text-danger font-weight-bold">@error('title'){{ $message }}@enderror</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="course">Notification Category</label>
                        <select class="form-control" name="course_id" required>
                            <option disabled>Select Notification Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $notification->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="cohorts">Cohort Category</label>
                        @php
                            $selectedCohorts = json_decode($notification->cohort_id, true) ?? [];
                        @endphp

                        <div class="d-flex flex-wrap gap-3">
                            @foreach($cohorts as $cohort)
                                <div class="form-check form-switch" style="min-width: 200px;">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="cohort{{ $cohort->id }}" 
                                        name="cohort_id[]" 
                                        value="{{ $cohort->id }}"
                                        {{ in_array($cohort->id, $selectedCohorts) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cohort{{ $cohort->id }}">{{ $cohort->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Notification Description</label>
                        <textarea class="form-control" id="myTextarea" name="description" rows="5" placeholder="Notification Description">{{ $notification->description }}</textarea>
                        <small class="text-danger font-weight-bold">@error('description'){{ $message }}@enderror</small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="status">Notification Status</label>
                        <select class="form-control" name="status" required>
                            <option disabled>Select Notification Status</option>
                            <option value="pending" {{ $notification->status == 'pending' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ $notification->status == 'active' ? 'selected' : '' }}>Publish</option>
                        </select>
                    </div>

                    <div class="card-action text-end">
                        <button class="btn btn-success px-4">Update Notification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-check-input {
        width: 3rem;
        height: 1.5rem;
        margin-right: 10px;
        cursor: pointer;
    }
    .form-check-label {
        font-weight: 500;
        color: #333;
    }
    .gap-3 {
        gap: 1.5rem !important;
    }
</style>

@endsection
