@extends('admin.app')

@section('content')
<div class="row my-3">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary d-flex justify-content-between align-items-center">
                <h3 class="mb-0 bgc-primary-text">Recorded Session Links</h3>
                <!-- Add Record Button -->
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                    <i class="fa fa-plus me-1"></i> Add Recorded Link
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Course Title</th>
                                <th>Cohort</th>
                                <th>Recorded Session Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($record_link as $index => $link)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $link->title }}</td>
                                <td>{{ $link->name }}</td>
                                <td>
                                    <a href="{{ $link->link }}" target="_blank" class="btn btn-info btn-sm">View</a>
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_record_{{$link->id}}">
                                        <i class="fa fa-pen text-warning"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#record_{{ $link->id }}">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="record_{{ $link->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('record.link.delete', $link->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h3 class="modal-title text-white">Delete Confirmation</h3>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                Are you sure you want to delete this recorded session link?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit_record_{{$link->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('record.link.update', $link->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content shadow">
                                            <div class="modal-header bgc-primary text-white">
                                                <h3 class="modal-title bgc-primary-text">Edit Recorded Link</h3>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label>Course Title</label>
                                                    <select class="form-control" name="course_id" required>
                                                        <option value="">Select Course</option>
                                                        @foreach($courses as $course)
                                                            <option value="{{$course->id}}" {{ $course->id == $link->course_id ? 'selected' : '' }}>
                                                                {{$course->title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Cohort</label>
                                                    <select class="form-control" name="cohort_id" required>
                                                        <option value="">Select Cohort</option>
                                                        @foreach($cohorts as $cohort)
                                                            <option value="{{$cohort->id}}" {{ $cohort->id == $link->cohort_id ? 'selected' : '' }}>
                                                                {{$cohort->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Recorded Session Link</label>
                                                    <input type="text" class="form-control" name="link" value="{{ $link->link }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
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

<!-- Add Record Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('record.link.add') }}" method="POST">
            @csrf
            <div class="modal-content shadow">
                <div class="modal-header bgc-primary text-white">
                    <h3 class="modal-title bgc-primary-text">Add Recorded Link</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Course Title</label>
                        <select required class="form-control" name="course_id">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Cohort</label>
                        <select required class="form-control" name="cohort_id">
                            <option value="">Select Cohort</option>
                            @foreach($cohorts as $cohort)
                                <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Recorded Session Link</label>
                        <input type="text" class="form-control" name="link" placeholder="Enter Recorded Session Link" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
