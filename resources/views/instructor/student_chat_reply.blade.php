@extends('instructor.app')

@section('content')

<div class="row  mt-4">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bgc-primary text-white d-flex justify-content-between align-items-center rounded-top">
                <h5 class="mb-0 bgc-primary-text"> Reply to Student Message</h5>
                <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                    ⬅ Go Back
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('instructor.student.chat.reply.add', $chat->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Original Message -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Student's Message</label>
                        <div class="p-3 bg-light border rounded">
                            <span class="text-muted">{{ $chat->user_message }}</span>
                        </div>
                    </div>

                    <!-- Reply Message -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Your Reply</label>
                        <textarea class="form-control shadow-sm" name="message" rows="6" placeholder="Type your reply here..."></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            🚀 Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
