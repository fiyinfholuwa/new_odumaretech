@extends('admin.app')

@section('content')
<div class="row my-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary d-flex justify-content-between align-items-center">
                <h3 class="mb-0 bgc-primary-text">Meeting Session Links</h3>
                <!-- Trigger Modal -->
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addMeetingModal">
                    <i class="fa fa-plus me-1"></i> Add Meeting Link
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Course Title</th>
                            <th>Meeting Title</th>
                            <th>Meeting Link</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meeting_link as $i => $link)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $link->title }}</td>
                                <td>{{ $link->meeting_title }}</td>
                                <td>
                                    <a href="{{ $link->link }}" target="_blank" class="btn btn-sm btn-info">
                                        View Link
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-primary mx-1" data-bs-toggle="modal" data-bs-target="#editMeetingModal_{{ $link->id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#meeting_{{ $link->id }}" class="text-danger mx-1">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="meeting_{{ $link->id }}" tabindex="-1" aria-labelledby="deleteModalLabel_{{ $link->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('meeting.link.delete', $link->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title text-white" id="deleteModalLabel_{{ $link->id }}">
                                                    <i class="fa fa-exclamation-triangle me-2"></i> Delete Confirmation
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Are you sure you want to delete this meeting link?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editMeetingModal_{{ $link->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $link->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('meeting.link.update', $link->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content shadow">
                                            <div class="modal-header bgc-primary text-white">
                                                <h3 class="modal-title bgc-primary-text" id="editModalLabel_{{ $link->id }}">Edit Meeting Link</h3>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group mb-3">
                                                    <label for="course_id">Course Title</label>
                                                    <select class="form-control" name="course_id" required>
                                                        <option value="">Select Course Title</option>
                                                        @foreach($courses as $course)
                                                            <option value="{{ $course->id }}" {{ $course->id == $link->course_id ? 'selected' : '' }}>
                                                                {{ $course->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="meeting_title">Meeting Title</label>
                                                    <input type="text" class="form-control" name="meeting_title" value="{{ $link->meeting_title }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="link">Meeting Link</label>
                                                    <input type="url" class="form-control" name="link" value="{{ $link->link }}" required>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update Meeting Link</button>
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

<!-- Add Meeting Modal -->
<div class="modal fade" id="addMeetingModal" tabindex="-1" aria-labelledby="addMeetingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('meeting.link.add') }}" method="POST">
            @csrf
            <div class="modal-content shadow">
                <div class="modal-header bgc-primary">
                    <h3 class="modal-title bgc-primary-text" id="addMeetingModalLabel">Add Meeting Link</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="course_id">Course Title</label>
                        <select class="form-control" name="course_id" required>
                            <option value="">Select Course Title</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="meeting_title">Meeting Title</label>
                        <input type="text" class="form-control" name="meeting_title" required placeholder="Enter Meeting Title">
                    </div>

                    <div class="form-group mb-3">
                        <label for="link">Meeting Link</label>
                        <input type="url" class="form-control" name="link" required placeholder="Enter Meeting Session Link">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Meeting Link</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
