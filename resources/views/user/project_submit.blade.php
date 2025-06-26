@extends('user.app')

@section('content')

<style>
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    label {
        font-weight: 500;
        color: #495057;
    }

    .form-control:read-only {
        background-color: #f8f9fa;
    }

    .btn-view {
        background-color: #0dcaf0;
        border: none;
        color: white;
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 4px;
    }

    .btn-view:hover {
        background-color: #0bb8de;
        color: white;
    }

    .card-action {
        border-top: 1px solid #e9ecef;
        padding: 1rem;
        text-align: right;
        background-color: #f9f9f9;
    }
</style>

<div class="row mt-4 mx-2 mb-5">
    <div class="col-lg-10 col-md-11">

        <div class="card shadow-sm">
            <div class="card-header bgc-secondary border-bottom">
                <div class="card-title bgc-secondary-text">🚀 Submit Final Project</div>
            </div>

            <form action="{{ route('project.submit.user', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Project Title -->
                    <div class="mb-3">
                        <label for="projectTitle">Project Title</label>
                        <input type="text" id="projectTitle" class="form-control" value="{{ $project->title }}" readonly>
                    </div>

                    <!-- Project Description -->
                    <div class="mb-3">
    <label for="projectDescription">Project Description</label>
    <div class="form-control" style="height: auto; min-height: 120px;" id="projectDescription">
        {!! html_entity_decode($project->description) !!}
    </div>
</div>

                    <!-- Admin Attachment -->
                    @if(!empty($project->image))
                    <div class="mb-3">
                        <label>Admin Attachment</label><br>
                        <a href="{{ asset($project->image) }}" class="btn btn-view" target="_blank">
                            <i class="fas fa-paperclip me-1"></i> View Attachment
                        </a>
                    </div>
                    @endif

                    <hr class="my-4">
                    <h5 class="text-primary fw-bold mb-3">Submit Your Project</h5>

                    <!-- User Attachment -->
                    <div class="mb-3">
                        <label for="userAttachment">Your File (Optional)</label>
                        <input type="file" id="userAttachment" class="form-control" name="image">
                    </div>

                    <!-- Project Link -->
                    <div class="mb-3">
                        <label for="attachmentLink">Project Attachment Link</label>
                        <textarea class="form-control" id="attachmentLink" name="link" required placeholder="e.g. https://drive.google.com/..."></textarea>
                    </div>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="asessement_id" value="{{ $project->id }}">
                    <input type="hidden" name="course_id" value="{{ $project->course_id }}">
                </div>

                <!-- Submit Button -->
                <div class="card-action">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i> Submit Project
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
