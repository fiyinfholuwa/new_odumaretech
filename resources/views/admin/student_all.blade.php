@extends('admin.app')

@section('content')
<div  class="row">
    <div  class="col-md-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div style="padding:20px;"  class="card-header bgc-primary border-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="card-title mb-0 fw-semibold bgc-primary-text">All Students</h4>
                        <small class="text-muted">Total: {{ count($users) }} students</small>
                    </div>

                    <!-- Tools -->
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <!-- Search -->
                        
                        <!-- Export Form -->
                        <form method="POST" action="{{ route('users.export') }}" class="d-flex align-items-center gap-2">
                            @csrf
                            <input name="date_from" class="form-control form-control-sm" type="date" required>
                            <input name="date_to" class="form-control form-control-sm" type="date" required>
                            <button type="submit" class="btn btn-sm btn-secondary">
                                <i class="fa fa-download me-1"></i> Export
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body bg-white p-0">
                <div class="table-responsive">
                    <table id="basic-datatables" class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px;">S/N</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th class="text-center" style="width:80px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $i => $user)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="fw-medium">{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td class="text-muted">{{ $user->email }}</td>
                               
                                <td class="text-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#student_{{ $user->id }}"
                                       class="text-danger" title="Delete Student">
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

{{-- Client-side search --}}

@endsection
