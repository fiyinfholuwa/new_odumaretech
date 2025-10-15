@extends('admin.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bgc-primary border-0 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0 text-primary">Manage All Applied Students</h4>
                    <span class="badge bg-primary rounded-pill">{{ count($applied) }} Total</span>
                </div>

                <div class="card-body bg-light p-4">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped align-middle table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Student ID</th>
                                    <th>Admission Status</th>
                                    <th>Cohort</th>
                                    <th>Course</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($applied as $i => $ap)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td class="fw-semibold">{{ $ap->first_name }} {{ $ap->last_name }}</td>
                                    <td>{{ $ap->email }}</td>
                                    <td>{{ $ap->student_id }}</td>
                                    <td>
                                        @if($ap->admission_status === 'accepted')
                                            <span class="badge bg-success px-3 py-2">{{ ucfirst($ap->admission_status) }}</span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2">{{ ucfirst($ap->admission_status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ap->cohort_name }}</td>
                                    <td>{{ optional($ap->course_name)->title }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#applied_{{ $ap->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#lock_{{ $ap->id }}">
                                                <i class="fa fa-user-lock me-1"></i> Manage
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                @include('admin.modal.update_user_cohort')

                                <!-- Lock/Unlock Modal -->
                                <div class="modal fade" id="lock_{{ $ap->id }}" tabindex="-1" aria-labelledby="lockLabel{{ $ap->id }}" aria-hidden="true">
    <div class="modal-dialog" style="transform: scale(1); transition: all 0.25s ease-out;">
        <form action="{{ route('user.lock.lock', $ap->id) }}" method="POST" 
              class="modal-content" 
              style="background:#fff !important; border-radius:12px; border:none; box-shadow:0 8px 24px rgba(0,0,0,0.15);">
            @csrf

            <div class="modal-header" 
                 style="background:#f8f9fa; border-bottom:1px solid #e9ecef; border-top-left-radius:12px; border-top-right-radius:12px;">
                <h5 class="modal-title text-danger fw-bold" id="lockLabel{{ $ap->id }}">Manage User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="outline:none; box-shadow:none;"></button>
            </div>

            <div style="background:white;" class="modal-body text-center" style="padding:20px;">
                <p class="mb-2" style="font-size:15px;">Are you sure you want to modify this user’s account?</p>
                <p class="fw-semibold text-dark" style="font-weight:600;">{{ $ap->first_name }} {{ $ap->last_name }}</p>
            </div>

            <div class="modal-footer justify-content-between" 
                 style="background:#f8f9fa; border-top:1px solid #e9ecef; border-bottom-left-radius:12px; border-bottom-right-radius:12px;">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal" 
                        style="border-radius:8px; font-size:14px;">Cancel</button>
                <div>
                    <button type="submit" name="lock" class="btn btn-danger btn-sm me-2" 
                            style="border-radius:8px; font-size:14px;">
                        <i class="fa fa-lock me-1"></i> Lock
                    </button>
                    <button type="submit" name="unlock" class="btn btn-success btn-sm" 
                            style="border-radius:8px; font-size:14px;">
                        <i class="fa fa-unlock me-1"></i> Unlock
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
