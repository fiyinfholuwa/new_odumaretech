@extends('admin.app')

@section('content')
<div class="row" style="margin:10px">
    <section class="section">
        <div class="row">
            <!-- Manage Roles Table -->
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bgc-secondary">
                        <h4 class="mb-0 bgc-secondary-text">Manage Roles</h5>
                        <!-- Add Role Modal Trigger -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            <i class="fa fa-plus"></i> Add Role
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="my-table" class="table table-striped table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    @php
                                        $permissionsFromDB = json_decode($role->permission ?? '[]');
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $role->name }}</strong></td>
                                        <td>
                                            @forelse($permissionsFromDB as $perm)
                                                <span class="badge bg-info text-dark me-1">{{ ucwords(str_replace('_',' ', $perm)) }}</span>
                                            @empty
                                                <span class="badge bg-secondary">No Permissions</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <!-- Edit Modal Trigger -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $role->id }}" 
                                               class="btn btn-sm btn-outline-primary me-2" title="Edit Role">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Set Permission Modal Trigger -->
                                            <a href="#" class="btn btn-sm btn-outline-success" 
                                               data-bs-toggle="modal" data-bs-target="#permissionModal{{ $role->id }}" 
                                               title="Set Permissions">
                                                <i class="fa fa-shield-alt"></i>
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
        </div>
    </section>
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('role.add') }}" method="post" class="row g-3">
            @csrf
            <div class="modal-content">
                <div class="modal-header bgc-primary text-white">
                    <h4 class="modal-title bgc-primary-text">Add Role</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Role Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="form-control @error('name') is-invalid @enderror" placeholder="Role Name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Add Role</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modals outside the table -->
@foreach($roles as $role)
    <!-- Edit Role Modal -->
    <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bgc-primary text-white">
                        <h4 class="modal-title bgc-primary-text">Edit Role - {{ $role->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Set Permission Modal -->
    <div class="modal fade" id="permissionModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h4 class="modal-title text-white">Set Permissions - {{ $role->name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('role.permission.set', $role->id) }}" method="post" id="permissionForm{{ $role->id }}">
                    @csrf
                    @php
                        $permissionsFromDB = json_decode($role->permission ?? '[]');
                        $allPermissions = [
                            'manage_courses', 'manage_cohort', 'manage_blog', 'manage_users',
                            'manage_instructor', 'manage_masterclass',
                            'manage_innovation', 'manage_corporate_training'
                        ];
                    @endphp
                    <div class="modal-body">
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
                                        <label class="form-check-label fw-bold" for="{{ $permission }}_{{ $role->id }}">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="permissionForm{{ $role->id }}" class="btn btn-primary btn-sm">Save Permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
