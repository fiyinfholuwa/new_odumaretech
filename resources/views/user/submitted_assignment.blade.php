@extends('user.app')

@section('content')

<style>
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .badge-status {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 12px;
        text-transform: capitalize;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-review {
        background-color: #17a2b8;
        color: white;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>

<div class="row mt-4 mx-2">
    <div class="col-12">
        <div class="card shadow-sm">
            <div style="background: #E9ECFF;" class="card-header border-bottom">
                <h4 class="card-title mb-0" style="color:#0E2293;">All Submitted Assignments</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="my-table" class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>Course</th>
                                <th>Assignment Title</th>
                                <th>Status</th>
                                <th>Review</th>
                                <th>Grade</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($assignments as $index => $assignment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $assignment->course_name->title }}</td>
                                <td>{{ $assignment->assignment_name->title }}</td>

                                <td>
                                    @if($assignment->status == "pending")
                                        <span class="badge badge-status badge-pending">Under Review</span>
                                    @else
                                        <span class="badge badge-status badge-success">{{ $assignment->status }}</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#review_{{ $assignment->id }}">
                                        <button class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye me-1"></i> View Comment
                                        </button>
                                    </a>
                                </td>

                                <td>
                                    @if($assignment->status_in == 0 || $assignment->status_in == "0")
                                        <span class="badge badge-status badge-pending">Under Review</span>
                                    @else
                                        <span class="badge badge-status badge-success">{{ $assignment->status_in }}</span>
                                    @endif
                                </td>
                            </tr>

                            @include('user.modal.reviewassignment')
                            @endforeach

                            @if(count($assignments) === 0)
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
