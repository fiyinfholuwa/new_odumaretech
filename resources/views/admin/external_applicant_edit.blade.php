@extends('admin.app')

@section('content')
<style>
.info-label {
    font-weight: 600;
    color: #333;
}
.info-value {
    display: block;
    padding: 8px 12px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background: #f9f9f9;
    margin-bottom: 12px;
}
.card {
    border-radius: 10px;
}
.card-header h4 {
    margin-bottom: 0;
}
</style>

<div class="row my-4">
    <div class="col-md-12 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary text-white">
                <h4 class="bgc-primary-text">Applicant Details</h4>
            </div>
            <div class="card-body">
                {{-- ✅ Begin Form --}}
                <form action="{{ route('external.applicant.update', $applicant->id) }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Basic Info --}}
                        <div class="col-md-6 mb-3">
                            <span class="info-label">First Name</span>
                            <input type="text" name="first_name" value="{{ $applicant->first_name }}" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span class="info-label">Last Name</span>
                            <input type="text" name="last_name" value="{{ $applicant->last_name }}" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span class="info-label">Email</span>
                            <input type="email" name="email" value="{{ $applicant->email }}" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span class="info-label">Phone Number</span>
                            <input type="text" name="phone_number" value="{{ $applicant->phone_number ?? 'N/A' }}" class="form-control" readonly>
                        </div>

                        {{-- About --}}
                        <div class="col-md-12 mb-3">
                            <span class="info-label">About</span>
                            <textarea class="form-control" rows="3" readonly>{{ $applicant->about }}</textarea>
                        </div>

                        {{-- Course Info --}}
                        <div class="col-md-6 mb-3">
                            <span class="info-label">Course Name</span>
                            <input type="text" name="course_name" value="{{ $applicant->course_name }}" class="form-control" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <span class="info-label">Sample Link</span>
                            @if($applicant->sample_link)
                                <a href="{{ $applicant->sample_link }}" target="_blank" class="btn btn-outline-primary btn-sm">View Link</a>
                            @else
                                <span class="info-value">N/A</span>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <span class="info-label">Description</span>
                            <textarea class="form-control" rows="3" readonly>{{ $applicant->description }}</textarea>
                        </div>

                        {{-- Social Links --}}
                        <div class="col-md-12 mt-3">
                            <h5 class="text-primary">Social / Work Links</h5>
                            <div class="row">
                                @php
                                    $links = [
                                        'LinkedIn' => $applicant->linkedin,
                                        'Twitter' => $applicant->twitter,
                                        'Instagram' => $applicant->instagram,
                                        'YouTube' => $applicant->youtube,
                                        'TikTok' => $applicant->tiktok,
                                        'Portfolio' => $applicant->portfolio,
                                        'GitHub' => $applicant->github,
                                        'Other Work' => $applicant->other_work,
                                    ];
                                @endphp
                                @foreach($links as $key => $url)
                                    <div class="col-md-6 mb-2">
                                        <span class="info-label">{{ $key }}</span><br>
                                        @if($url)
                                            <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-success">Visit {{ $key }}</a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Attachment --}}
                        @if($applicant->attachment)
                            <div class="col-md-12 mb-4">
                                <span class="info-label">Attachment</span><br>
                                <a href="{{ asset($applicant->attachment) }}" target="_blank" class="btn btn-sm btn-danger">
                                    View Attachment
                                </a>
                            </div>
                        @endif

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Validation Status</label>
                            <select required class="form-control" name="status">
                                <option disabled selected value="">Select Action</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                        </div>

                        {{-- Hidden fields --}}
                        <input type="hidden" name="reference" value="{{ $applicant->reference }}">
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">Submit Decision</button>
                    </div>
                </form>
                {{-- ✅ End Form --}}
            </div>
        </div>
    </div>
</div>
@endsection
