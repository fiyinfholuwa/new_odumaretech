@extends('user.app')

@section('content')
<div class="row  my-4">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-primary">
                <h4 class="mb-0 bgc-primary-text">Send Message</h4>
            </div>
            <form action="{{ route('chat.user.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group mb-4">
                        <label for="course_id" class="form-label">Select Course</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            <option value="" selected disabled>Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="6" placeholder="Write your message..."></textarea>
                    </div>

                </div>
                <div class="card-footer bg-light text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-2"></i> Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
