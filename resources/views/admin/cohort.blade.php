@extends('admin.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <!-- List of Cohorts -->
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bgc-secondary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 bgc-secondary-text">All Cohorts</h5>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCohortModal">
                            <i class="fa fa-plus-circle me-1"></i> Add Cohort
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="my-table" class="table table-bordered align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th style="width: 5%;">S/N</th>
                                    <th>Name</th>
                                    <th style="width: 15%;" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @if(isset($cohorts) && count($cohorts))
                                    @foreach($cohorts as $cohort)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $cohort->name }}</td>
                                            <td class="text-center">
                                                <!-- Edit Button -->
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-primary me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCohortModal_{{ $cohort->id }}"
                                                        title="Edit Cohort">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- Delete Button -->
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#cohort_{{ $cohort->id }}" class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                                <!-- Edit Cohort Modal -->
                                                <div class="modal fade" id="editCohortModal_{{ $cohort->id }}" tabindex="-1" aria-labelledby="editCohortLabel_{{ $cohort->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('cohort.update', $cohort->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Cohort</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group mb-3">
                                                                        <label for="cohortName_{{ $cohort->id }}" class="form-label">Cohort Name</label>
                                                                        <input type="text"
                                                                               id="cohortName_{{ $cohort->id }}"
                                                                               name="name"
                                                                               class="form-control @error('name') is-invalid @enderror"
                                                                               value="{{ old('name', $cohort->name) }}"
                                                                               required
                                                                               placeholder="Enter cohort name">
                                                                        @error('name')
                                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Update Cohort</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Modal -->
                                                @include('admin.modal.deletecohort')
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                        <td class="text-center text-muted">No cohorts found.</td>
                                        <td></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Cohort Modal -->
    <div class="modal fade" id="addCohortModal" tabindex="-1" aria-labelledby="addCohortLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cohort.add') }}" method="POST">
                    @csrf
                    <div class="modal-header bgc-primary text-white">
                        <h4 class="modal-title bgc-primary-text" id="addCohortLabel">Add Course Cohort</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Cohort Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" required placeholder="Enter Cohort Name">
                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus-circle me-1"></i> Add Cohort
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
