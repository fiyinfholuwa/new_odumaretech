@extends('admin.app')

@section('content')
<div class="row m-3">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">All Students</h4>

                <!-- Export Form -->
                <form method="POST" action="{{ route('users.export') }}" class="d-flex align-items-center gap-2">
                    @csrf
                    <div class="row g-2 align-items-center">
                        <div class="col-lg-5 col-md-6">
                            <input name="date_from" class="form-control form-control-sm" type="date" required>
                        </div>

                        <div class="col-lg-5 col-md-6">
                            <input name="date_to" class="form-control form-control-sm" type="date" required>
                        </div>

                        <div class="col-lg-2 col-md-12">
                            <button type="submit" class="btn btn-sm btn-secondary w-100">
                                <i class="fa fa-download me-1"></i> Export CSV
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body bg-white">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>S/N</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Student ID</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $i => $user)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->student_id }}</td>
                                <td class="text-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#student_{{ $user->id }}" class="text-danger" title="Delete Student">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('admin.modal.deleteStudent')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
