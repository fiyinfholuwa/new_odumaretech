@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px">
        <!-- Add Record Form -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h3 class="text-white">Manage Recorded Session Link</h3> </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('record.link.add') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="course_id">Course Title</label>
                            <select required class="form-control" name="course_id">
                                <option value="">Select Course Title</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cohort_id">Cohort</label>
                            <select required class="form-control" name="cohort_id">
                                <option value="">Select Cohort</option>
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="link">Recorded Session Link</label>
                            <input type="text" class="form-control" name="link" placeholder="Enter Recorded Session Link" required>
                            @error('link')
                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="card-action">
                            <button class="btn btn-primary">Add Record Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Records Table -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title text-white">Check Recorded Session Link</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Course Title</th>
                                <th>Cohort Name</th>
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
                                        <!-- Edit icon trigger for Bootstrap 5 -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#edit_record_{{$link->id}}">
                                            <i class="fa fa-pen" style="color: orange;"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#record_{{ $link->id }}" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="record_{{ $link->id }}" tabindex="-1" aria-labelledby="deleteModalLabel_{{ $link->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('record.link.delete', $link->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h3 class="modal-title text-white">Delete Confirmation</h3>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    Are you sure you want to delete this recorded session link?
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <!-- Edit Modal for Record Link -->
                                <div class="modal fade" id="edit_record_{{$link->id}}" tabindex="-1" aria-labelledby="editRecordLabel{{$link->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('record.link.update', $link->id) }}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h3 class="modal-title text-white" id="editRecordLabel{{$link->id}}">Edit Recorded Session Link</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label>Course Title</label>
                                                        <select class="form-control" name="course_id" required>
                                                            <option value="">Select Course Title</option>
                                                            @foreach($courses as $course)
                                                                <option value="{{$course->id}}" {{ $course->id == $link->course_id ? 'selected' : '' }}>{{$course->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label>Cohort</label>
                                                        <select class="form-control" name="cohort_id" required>
                                                            <option value="">Select Cohort</option>
                                                            @foreach($cohorts as $cohort)
                                                                <option value="{{$cohort->id}}" {{ $cohort->id == $link->cohort_id ? 'selected' : '' }}>{{$cohort->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label>Recorded Session Link</label>
                                                        <input type="text" class="form-control" name="link" value="{{ $link->link }}" required placeholder="Enter Recorded Session Link">
                                                        <small class="text-danger fw-bold">
                                                            @error('link') {{ $message }} @enderror
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
