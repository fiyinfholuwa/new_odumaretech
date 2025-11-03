@extends('admin.app')

@section('content')
<div class="row my-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-secondary">
                <h3 class="card-title mb-0 bgc-secondary-text">All External Courses</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th>S/N</th>
                            <th>Instructor Email</th>
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
                                <td>{{ optional($course->instructor_name)->email }}</td>
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
                                        <a href="{{ route('admin.external.curriculum', $course->id) }}"
                                           class="badge bg-dark text-light d-inline-flex align-items-center"
                                           title="Curriculum">
                                           <i class="fa fa-book me-1"></i> Curriculum
                                        </a>

                                        <a href="{{ route('admin.external.course.view', $course->id) }}"
                                           class="badge bg-primary text-light d-inline-flex align-items-center"
                                           title="View">
                                           <i class="fa fa-eye me-1"></i> View
                                        </a>

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateStatus_{{ $course->id }}"
                                           class="badge bg-warning text-dark d-inline-flex align-items-center"
                                           title="Update Status">
                                           <i class="fa fa-check-circle me-1"></i>Make Changes
                                        </a>
                                    </div>

                                    {{-- Include Modal --}}
                                    <div class="modal fade" id="updateStatus_{{ $course->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                          <form action="{{ route('admin.external.course.updateStatus', $course->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header bgc-primary text-white">
                                              <h5 class="modal-title bgc-primary-text">Update Course Status</h5>
                                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <label class="form-label">Select Status</label>
                                                <select name="admin_status" id="statusSelect_{{ $course->id }}" class="form-select" required>
                                                  <option value="">-- Choose Status --</option>
                                                  <option value="under_review" {{ $course->admin_status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                                  <option value="approved" {{ $course->admin_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                  <option value="declined" {{ $course->admin_status == 'declined' ? 'selected' : '' }}>Declined</option>
                                                  <option value="make_changes" {{ $course->admin_status == 'make_changes' ? 'selected' : '' }}>Needs Changes</option>
                                                </select>
                                              </div>

                                              <div class="mb-3 reasonField" style="display:none;">
                                                <label class="form-label">Reason / Comment</label>
                                                <textarea name="reason" class="form-control" rows="3" placeholder="Enter reason (required for declined or make changes)"></textarea>
                                              </div>

                                              @php
                                                  $logs = json_decode($course->approval_logs ?? '[]', true);
                                              @endphp

                                              @if(count($logs) > 0)
                                                <hr>
                                                <h6 class="fw-bold">Approval History</h6>
                                                <ul class="list-group">
                                                  @foreach(array_reverse($logs) as $log)
                                                    <li class="list-group-item">
                                                      <strong>{{ ucfirst($log['status']) }}</strong> — 
                                                      {{ $log['reason'] ?? 'No reason provided' }}
                                                      <br>
                                                      <small class="text-muted">{{ $log['time'] }}</small>
                                                    </li>
                                                  @endforeach
                                                </ul>
                                              @endif
                                            </div>

                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                              <button type="submit" class="btn btn-primary">Update Status</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>

                                    <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const statusSelect = document.querySelector("#statusSelect_{{ $course->id }}");
                                        const reasonField = document.querySelector("#updateStatus_{{ $course->id }} .reasonField");

                                        function toggleReason() {
                                            const val = statusSelect.value;
                                            reasonField.style.display = (val === "declined" || val === "make_changes") ? "block" : "none";
                                        }

                                        toggleReason();
                                        statusSelect.addEventListener("change", toggleReason);
                                    });
                                    </script>
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
