@extends('admin.app')

@section('content')
    <div class="row my-3">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0 text-white">Manage Meeting Link</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('meeting.link.add') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="course_id">Course Title</label>
                            <select class="form-control" name="course_id" id="course_id" required>
                                <option value="">Select Course Title</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="meeting_title">Meeting Title</label>
                            <input type="text" class="form-control" name="meeting_title" id="meeting_title" required placeholder="Enter Meeting Title">
                            <small class="text-danger font-weight-bold">@error('meeting_title') {{ $message }} @enderror</small>
                        </div>

                        <div class="form-group mb-4">
                            <label for="link">Meeting Link</label>
                            <input type="url" class="form-control" name="link" id="link" required placeholder="Enter Meeting Session Link">
                            <small class="text-danger font-weight-bold">@error('link') {{ $message }} @enderror</small>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add Meeting Link</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h3 class="mb-0 text-white">Meeting Session Links</h3>
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
                                    <div class="modal-dialog " role="document">
                                        <form action="{{ route('meeting.link.delete', $link->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title text-white" id="deleteModalLabel_{{ $link->id }}">
                                                        <i class="fa fa-exclamation-triangle mr-2"></i> Delete Confirmation
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p class="mb-0">Are you sure you want to delete this meeting link?</p>
                                                </div>
                                                <div class="modal-footer justify-content-end">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>




                                <div class="modal fade" id="editMeetingModal_{{ $link->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $link->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('meeting.link.update', $link->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h3 class="modal-title text-white" id="editModalLabel_{{ $link->id }}">Edit Meeting Link</h3>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                        @error('meeting_title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="link">Meeting Link</label>
                                                        <input type="text" class="form-control" name="link" value="{{ $link->link }}" required>
                                                        @error('link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
@endsection
