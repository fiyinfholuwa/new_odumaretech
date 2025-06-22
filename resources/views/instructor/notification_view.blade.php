@extends('instructor.app')

@section('content')

<div class="row" style="margin:10px">
    <div class="col-md-11">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <div class="card-title mb-0"><h4 class="text-white">Add Notification</h4></div>
            </div>
            <div class="card-body">
                <form action="{{ route('notification.add') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="title">Notification Title</label>
                        <input type="text" class="form-control" id="title" required name="title" placeholder="Enter Notification Title">
                        <small class="text-danger font-weight-bold">
                            @error('title') {{ $message }} @enderror
                        </small>
                    </div>

                    <div class="form-group mb-4">
                        <label for="course">Notification Category</label>
                        <select class="form-control" name="course_id" id="course" required>
                            <option disabled selected>Select Notification Category</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="cohorts">Cohort Category</label>
                        @if(count($cohorts) > 0)
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($cohorts as $cohort)
                                    <div class="form-check form-switch" style="min-width: 200px;">
                                        <input class="form-check-input" type="checkbox" id="cohort{{ $cohort->id }}" name="cohort_id[]" value="{{ $cohort->id }}">
                                        <label class="form-check-label" for="cohort{{ $cohort->id }}">{{ $cohort->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No Cohort Available</p>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <label for="description">Notification Description</label>
                        <textarea class="form-control" name="description" id="myTextarea" rows="5" placeholder="Notification Description"></textarea>
                        <small class="text-danger font-weight-bold">@error('description'){{ $message }}@enderror</small>
                    </div>

                    <div class="card-action text-end">
                        <button class="btn btn-success px-4">Add Notification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Optional extra styles for toggle switches --}}
<style>
    .form-check-input:checked {
        background-color: #4caf50;
        border-color: #4caf50;
    }

    .form-check-input {
        width: 4rem;
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
