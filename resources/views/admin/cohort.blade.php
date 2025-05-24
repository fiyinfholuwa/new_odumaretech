@extends('admin.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <!-- Add Cohort Form -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">Add Course Cohort</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cohort.add') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Cohort Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" required placeholder="Enter Cohort Name">
                                @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Add Cohort</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List of Cohorts -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0 text-white">All Cohorts</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="my-table" class="table  table-bordered align-middle">
                                <thead class="">
                                <tr>
                                    <th style="width: 5%;">S/N</th>
                                    <th>Name</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @if(isset($cohorts) && count($cohorts))
                                    @foreach($cohorts as $cohort)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $cohort->name }}</td>
                                            <td>
                                                <a href="{{ route('cohort.edit', $cohort->id) }}" class="me-2 text-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#cohort_{{ $cohort->id }}" class="text-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                @include('admin.modal.deletecohort')
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                        <td colspan="" class="text-center text-muted">No cohorts found.</td>
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

    <!-- Optional: Add some spacing below -->
    <div class="mb-5"></div>
@endsection
