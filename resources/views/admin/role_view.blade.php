@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px">
        <section class="section">
            <div class="row">
                <!-- Add Role Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="mb-0 text-white">Add Role</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('role.add') }}" method="post" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label class="form-label">Role Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Role Name">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success w-100">Add Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Manage Roles Table -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h5 class="mb-0 text-white">Manage Roles</h5>
                        </div>
                        <div class="card-body">
                            <table id="my-table" class="table datatable table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <!-- Edit Modal Trigger -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $role->id }}" class="me-2">
                                                <i class="fa fa-edit text-primary"></i>
                                            </a>

                                            <!-- Set Permission Modal Trigger -->
                                            <a href="#" class="badge bg-primary text-white" data-bs-toggle="modal" data-bs-target="#permissionModal{{ $role->id }}">
                                                Set Permission
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modals outside the table -->
    @foreach($roles as $role)
        <!-- Edit Role Modal -->
        <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $role->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $role->id }}">Edit Role - {{ $role->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Role Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Set Permission Modal -->
        <div class="modal fade" id="permissionModal{{ $role->id }}" tabindex="-1" aria-labelledby="permissionModalLabel{{ $role->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionModalLabel{{ $role->id }}">Set Permissions - {{ $role->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('role.permission.set', $role->id) }}" method="post" id="permissionForm{{ $role->id }}">
                            @csrf
                            @php
                                $permissionsFromDB = json_decode($role->permission ?? '[]');
                                $allPermissions = [
                                    'manage_courses', 'manage_cohort', 'manage_blog', 'manage_users',
                                    'manage_instructor', 'manage_faqs', 'manage_masterclass',
                                    'manage_innovation', 'manage_corporate_training'
                                ];
                            @endphp

                            <div class="row">
                                @foreach($allPermissions as $permission)
                                    @php
                                        $label = ucwords(str_replace(['_', '&'], [' ', ' & '], $permission));
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input
                                                class="form-check-input custom-switch"
                                                type="checkbox"
                                                id="{{ $permission }}_{{ $role->id }}"
                                                name="permission[]"
                                                value="{{ $permission }}"
                                                {{ in_array($permission, $permissionsFromDB) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $permission }}_{{ $role->id }}">{{ $label }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="permissionForm{{ $role->id }}" class="btn btn-primary">Save Permissions</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('styles')
    <style>
        .form-switch .form-check-input.custom-switch {
            width: 2.5em;
            height: 1.4em;
            margin-left: -2.5em;
            background-color: #d1d1d1;
            border-radius: 2em;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .form-switch .form-check-input.custom-switch:checked {
            background-color: navy;
        }

        .form-switch .form-check-input.custom-switch:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 128, 0.25);
        }

        .form-switch .form-check-input.custom-switch:before {
            content: "";
            position: absolute;
            top: 2px;
            left: 2px;
            width: 1em;
            height: 1em;
            background-color: #fff;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out;
        }

        .form-switch .form-check-input.custom-switch:checked:before {
            transform: translateX(1em);
        }

        .form-switch {
            position: relative;
            padding-left: 3em;
        }
    </style>
@endpush
