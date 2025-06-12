@extends('admin.app')

@section('content')

    <div class="row mx-2">
        <!-- Add Cohort With Price -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header  bg-primary">
                    <h4 class="card-title mb-0 text-white">Add Cohort With Price</h4>
                </div>
                <form action="{{ route('cohort_m.add') }}" method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="price">Amount (₦)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required placeholder="Enter course cohort price">
                            @error('price')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="course_id">Course</label>
                            <select class="form-control @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="cohort_id">Cohort</label>
                            <select class="form-control @error('cohort_id') is-invalid @enderror" id="cohort_id" name="cohort_id" required>
                                <option value="">Select Cohort</option>
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                            @error('cohort_id')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary"><i class="fa fa-plus me-1"></i>Add Cohort with Price</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- List of Cohorts with Prices -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h4 class="card-title mb-0 text-white">All Cohorts With Prices</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Price</th>
                                <th>Course Title</th>
                                <th>Cohort</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cohort_courses as $index => $cohort)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>₦{{ number_format($cohort->price, 2) }}</td>
                                    <td>{{ optional($cohort->course_name)->title }}</td>
                                    <td>{{ optional($cohort->cohort_name)->name }}</td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $cohort->id }}" class="me-2 text-primary" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#cohort_{{ $cohort->id }}" title="Delete">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                        @include('admin.modal.deletecohortcourse')
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <!-- Edit Cohort Modal -->
                                <div class="modal fade" id="editModal_{{ $cohort->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $cohort->id }}" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <form action="{{ route('cohort_m.update', $cohort->id) }}" method="POST" class="w-100">
                                            @csrf
                                            <div class="modal-content shadow">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white" id="editModalLabel_{{ $cohort->id }}">
                                                        Edit Cohort ({{ optional($cohort->course_name)->title ?? 'No Course' }})
                                                    </h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Amount (#)</label>
                                                        <input type="number" name="price" class="form-control" value="{{ $cohort->price }}" required placeholder="Enter cohort price">
                                                        @error('price')
                                                        <small class="text-danger fw-semibold d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Course</label>
                                                        <select name="course_id" class="form-select" required>
                                                            <option value="">-- Select Course --</option>
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}" {{ $course->id == $cohort->course_id ? 'selected' : '' }}>
                                                                    {{ $course->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('course_id')
                                                        <small class="text-danger fw-semibold d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Cohort</label>
                                                        <select name="cohort_id" class="form-select" required>
                                                            <option value="">-- Select Cohort --</option>
                                                            @foreach($cohorts as $cohort_c)
                                                                <option value="{{ $cohort_c->id }}" {{ $cohort_c->id == $cohort->cohort_id ? 'selected' : '' }}>
                                                                    {{ $cohort_c->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('cohort_id')
                                                        <small class="text-danger fw-semibold d-block mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update Cohort</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @endforeach
                            @if($cohort_courses->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No cohorts added yet.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
