\@extends('external_instructor.app')

@section('content')
<div class="row my-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-secondary">
                <h3 class="card-title mb-0 bgc-secondary-text">All Courses</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Approval Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ optional($course->cat)->name }}</td>
                                    <td>${{ number_format($course->price, 2) }}</td>
                                    <td>{!! Str::limit(strip_tags($course->description), 20, '...') !!}</td>

                                    <td>
                                        @if ($course->admin_status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif ($course->admin_status === 'declined')
                                            <span class="badge bg-danger">Declined</span>
                                        @elseif ($course->admin_status === 'make_changes')
                                            <span class="badge bg-warning text-dark">Needs Changes</span>
                                        @else
                                            <span class="badge bg-secondary">Under Review</span>
                                        @endif
                                    </td>

                                    <td>
                                        <img src="{{ asset($course->image) }}" alt="Course Image" width="40" height="40" class="rounded-circle">
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-2">

                                            <a href="{{ route('in.course.curriculum', $course->id) }}"
                                               class="badge bg-dark text-light d-inline-flex align-items-center"
                                               title="Set Curriculum">
                                                <i class="fa fa-book me-1"></i> Curriculum
                                            </a>

                                            <a href="{{ route('in.course.edit', $course->id) }}"
                                               class="badge bg-primary text-light d-inline-flex align-items-center"
                                               title="Edit">
                                                <i class="fa fa-edit me-1"></i> Edit
                                            </a>

                                            @if ($course->admin_status !== 'declined')
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#course_{{ $course->id }}"
                                                   class="badge bg-danger text-light d-inline-flex align-items-center"
                                                   title="Delete">
                                                   <i class="fa fa-trash me-1"></i> Delete
                                                </a>
                                            @endif

                                            <!-- ✅ New button to view approval logs -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#logsModal_{{ $course->id }}"
                                               class="badge bg-info text-dark d-inline-flex align-items-center"
                                               title="View Approval Logs">
                                               <i class="fa fa-history me-1"></i> View Logs
                                            </a>

                                            @include('external_instructor.modal.deleteCourse')
                                        </div>

                                        <!-- ✅ Approval Logs Modal -->
                                        <div class="modal fade" id="logsModal_{{ $course->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header bgc-secondary text-white">
                                                        <h5 class="modal-title fw-bold bgc-secondary-text">Approval Logs - {{ $course->title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                        @php
                                                            $logs = json_decode($course->approval_logs ?? '[]', true);
                                                        @endphp

                                                        @if(count($logs) > 0)
                                                            <ul class="list-group">
                                                                @foreach(array_reverse($logs) as $log)
                                                                    <li class="list-group-item">
                                                                        <strong>{{ ucfirst($log['status']) }}</strong> — 
                                                                        {{ $log['reason'] ?? 'No reason provided' }}
                                                                        <br>
                                                                        <small class="text-muted">{{ $log['time'] ?? '' }}</small>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-muted mb-0 text-center">No approval logs available yet.</p>
                                                        @endif
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
