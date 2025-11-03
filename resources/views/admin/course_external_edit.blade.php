@extends('admin.app')

@section('content')
<div class="row" style="margin:10px">
    <div class="col-md-11">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary">
                <h3 class="card-title mb-0 bgc-primary-text">View Course</h3>
            </div>

            <div class="card-body">
                <!-- Course Title -->
                <div class="mb-3">
                    <label class="fw-bold">Course Title:</label>
                    <p class="form-control-plaintext">{{ $course->title }}</p>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="fw-bold">Category:</label>
                    <p class="form-control-plaintext">{{ optional($course->cat)->name ?? 'N/A' }}</p>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="fw-bold">Description:</label>
                    <div class="border rounded p-2 bg-light">
                        {!! $course->description !!}
                    </div>
                </div>

                <!-- Admission Requirements -->
                <div class="mb-3">
                    <label class="fw-bold">Admission Requirements:</label>
                    <div class="border rounded p-2 bg-light">
                        {!! $course->requirement !!}
                    </div>
                </div>

                <!-- Career Outcome -->
                <div class="mb-3">
                    <label class="fw-bold">Career Outcome:</label>
                    <div class="border rounded p-2 bg-light">
                        {!! $course->outcome !!}
                    </div>
                </div>

                <!-- Level, Duration, Language -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Course Level:</label>
                        <p class="form-control-plaintext">{{ $course->level }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Duration (Hours):</label>
                        <p class="form-control-plaintext">{{ $course->duration }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Language:</label>
                        <p class="form-control-plaintext">{{ $course->language }}</p>
                    </div>
                </div>

                <!-- Price and Discount -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Price ($):</label>
                        <p class="form-control-plaintext">${{ number_format($course->price, 2) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Discount (%):</label>
                        <p class="form-control-plaintext">{{ $course->discount ?? 0 }}%</p>
                    </div>
                </div>

                <!-- Admin Status -->
                <div class="mb-3">
                    <label class="fw-bold">Approval Status:</label><br>
                    @if ($course->admin_status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif ($course->admin_status === 'declined')
                        <span class="badge bg-danger">Declined</span>
                    @elseif ($course->admin_status === 'make_changes')
                        <span class="badge bg-warning text-dark">Needs Changes</span>
                    @else
                        <span class="badge bg-secondary">Under Review</span>
                    @endif
                </div>

                <!-- Course Image -->
                <div class="mb-3">
                    <label class="fw-bold">Course Image:</label><br>
                    @if($course->image)
                        <img src="{{ asset($course->image) }}" alt="Course Image" class="rounded shadow-sm" width="120" height="120">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <!-- Back button -->
                <div class="text-end mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
