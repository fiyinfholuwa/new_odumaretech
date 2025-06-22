@extends('admin.app')

@section('content')
<style>
/* Toggle switch styling */
.custom-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    user-select: none;
}

.custom-toggle input[type="checkbox"] {
    display: none;
}

.toggle-slider {
    position: relative;
    width: 45px;
    height: 24px;
    background-color: #ccc;
    border-radius: 34px;
    transition: background-color 0.3s;
}

.toggle-slider::before {
    content: "";
    position: absolute;
    left: 3px;
    top: 3px;
    width: 18px;
    height: 18px;
    background-color: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.custom-toggle input[type="checkbox"]:checked + .toggle-slider {
    background-color: #4caf50;
}

.custom-toggle input[type="checkbox"]:checked + .toggle-slider::before {
    transform: translateX(21px);
}

.toggle-label {
    font-weight: 500;
    color: #333;
}
</style>

<div class="row my-4">
    <div class="col-md-11">
        <div class="card ">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-white">Assess Applicant</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('applicant.update', $applicant->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">First Name</label>
                            <input type="text" class="form-control" readonly name="first_name" value="{{ $applicant->first_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Last Name</label>
                            <input type="text" class="form-control" readonly name="last_name" value="{{ $applicant->last_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Gender</label>
                            <input type="text" class="form-control" readonly  name="gender" value="{{ $applicant->gender }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Email</label>
                            <input type="text" class="form-control" readonly name="email" value="{{ $applicant->email }}">
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="fw-bold">Resume</label><br>
                            <a class="btn btn-sm btn-danger" target="_blank" href="{{ route('applicant.view.resume', $applicant->id) }}">View Resume</a>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="fw-bold">Applicant Selected Courses</label><br>
                            <?php $j = 1; ?>
                            @foreach(json_decode($applicant->course_ids, true) as $course)
                                {{ $j++ }}. {{ $course }}<br>
                            @endforeach
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="fw-bold mb-2">Select Courses for Applicant</label><br>
                            @if(count($courses) > 0)
                                <div class="row">
                                    @foreach($courses as $course)
                                        <div class="col-md-6 mb-3">
                                            <label class="custom-toggle">
                                                <input type="checkbox" name="course_ids[]" value="{{ $course->id }}"
                                                    {{ in_array($course->id, json_decode($applicant->course_ids, true) ?? []) ? 'checked' : '' }}>
                                                <span class="toggle-slider"></span>
                                                <span class="toggle-label">{{ $course->title }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No Courses Available</p>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Validate Applicant</label>
                            <select required class="form-control" name="status">
                                <option disabled selected value="">Select Action</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button class="btn btn-primary px-4">Validate Applicant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
