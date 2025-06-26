@extends('user.app')

@section('content')

<style>
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #343a40;
    }

    label {
        font-weight: 500;
        color: #495057;
    }

    .form-control:read-only {
        background-color: #f8f9fa;
    }

    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .card-action {
        border-top: 1px solid #dee2e6;
        padding: 1rem;
        text-align: right;
        background-color: #f9f9f9;
    }

    .badge-link {
        display: inline-block;
        margin-top: 6px;
    }

    .go-back-btn {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ccc;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .go-back-btn:hover {
        background-color: #e9ecef;
        color: #000;
        border-color: #bbb;
    }
</style>

<div class="row mt-4 mb-5">
    <div class="col-lg-10 col-md-11">

        <!-- Go Back Button -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="go-back-btn">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>

        <!-- Card -->
        <div class="card">
            <div class="card-header bgc-primary border-bottom">
                <div class="card-title bgc-primary-text">📄 Submit Assignment</div>
            </div>

            <form action="{{ route('assignment.submit.user', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <!-- Assignment Title -->
                    <div class="mb-3">
                        <label for="assignmentTitle">Assignment Title</label>
                        <input type="text"  class="form-control" id="assignmentTitle" value="{{ $assignment->title }}" readonly name="title">
                    </div>

                    <!-- Assignment Description -->
                    <div class="mb-3">
                        <label for="assignmentDescription">Assignment Description</label>
<div class="form-control" style="height: auto; min-height: 120px;">
    {!! $assignment->description !!}
</div>
                    </div>

                    <!-- Attached File (from Admin) -->
                    @if (!is_null($assignment->image))
                        <div class="mb-3">
                            <label>Assignment Attached File</label><br>
                            <a class="badge bg-primary text-white badge-link" target="_blank" href="{{ asset($assignment->image) }}">
                                <i class="fas fa-link me-1"></i> Open Attached File
                            </a>
                        </div>
                    @endif

                    <!-- User's File Upload -->
                    <div class="mb-3">
                        <label for="attachmentFile">Your Attachment (Optional)</label>
                        <input type="file" class="form-control" id="attachmentFile" name="image">
                    </div>

                    <!-- User's Link -->
                    <div class="mb-3">
                        <label for="attachmentLink">Your Attachment Link (Optional)</label>
                        <textarea class="form-control" id="attachmentLink" name="link" placeholder="e.g. https://drive.google.com/..."></textarea>
                    </div>

                    <!-- Hidden Inputs -->
                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                    <input type="hidden" name="course_id" value="{{ $assignment->course_id }}">
                </div>

                <!-- Submit Button -->
                <div class="card-action">
                    <button class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Submit Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
