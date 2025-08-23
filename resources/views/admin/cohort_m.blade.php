@extends('admin.app')

@section('content')

    <div class="row mx-2">
        <!-- Cohorts With Prices Table -->
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bgc-secondary d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 bgc-secondary-text">All Cohorts With Prices</h4>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCohortPriceModal">
                        <i class="fa fa-plus-circle me-1"></i> Add Cohort With Price
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="table table-striped table-hover align-middle">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Price</th>
                                <th>Course Title</th>
                                <th>Cohort</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cohort_courses as $index => $cohort)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>₦{{ number_format($cohort->price, 2) }}</td>
                                    <td>{{ optional($cohort->course_name)->title }}</td>
                                    <td>{{ optional($cohort->cohort_name)->name }}</td>
                                    <td class="text-center">
                                        <!-- Edit -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $cohort->id }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- Delete -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#cohort_{{ $cohort->id }}" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @include('admin.modal.deletecohortcourse')
                                    </td>
                                </tr>

                                <!-- Edit Cohort Price Modal -->
                                <div class="modal fade" id="editModal_{{ $cohort->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $cohort->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('cohort_m.update', $cohort->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content shadow">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="editModalLabel_{{ $cohort->id }}">
                                                        Edit Cohort ({{ optional($cohort->course_name)->title ?? 'No Course' }})
                                                    </h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Amount (₦)</label>
                                                        <input type="number" name="price" class="form-control" value="{{ $cohort->price }}" required>
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
                                    <td colspan="5" class="text-center text-muted">No cohorts added yet.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Cohort Price Modal -->
    <div class="modal fade" id="addCohortPriceModal" tabindex="-1" aria-labelledby="addCohortPriceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('cohort_m.add') }}" method="POST">
                @csrf
                <div class="modal-content shadow">
                    <div class="modal-header bgc-primary text-white">
                        <h4 class="modal-title bgc-primary-text" id="addCohortPriceLabel">Add Cohort With Price</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="price">Amount (₦)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required placeholder="Enter course cohort price">
                            @error('price')
                            <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="course_id">Course</label>
                            <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="cohort_id">Cohort</label>
                            <select class="form-select @error('cohort_id') is-invalid @enderror" id="cohort_id" name="cohort_id" required>
                                <option value="">Select Cohort</option>
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                            @error('cohort_id')
                            <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus me-1"></i> Add Cohort With Price
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
