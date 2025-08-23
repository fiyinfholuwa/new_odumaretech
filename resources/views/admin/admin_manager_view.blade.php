@extends('admin.app')

@section('title', 'Manage Manager')
@section('page', 'Manage Manager')

@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}
.switch input { opacity: 0; width: 0; height: 0; }
.slider {
  position: absolute; cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc; transition: 0.4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute; content: "";
  height: 20px; width: 20px;
  left: 3px; bottom: 3px;
  background-color: white; transition: 0.4s;
  border-radius: 50%;
}
.switch input:checked + .slider { background-color: #4CAF50; }
.switch input:checked + .slider:before { transform: translateX(24px); }
.switch-label { font-weight: 500; }
</style>

<main id="main" class="main">
    <section class="section">
        <div class="row">

            <!-- Manage Admin Managers -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bgc-secondary text-white">
                        <h4 class="mb-0 bgc-secondary-text">Manage Admin Managers</h5>
                        <!-- Add Button -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#addManagerModal">
                            <i class="fa fa-plus"></i> Add Manager
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="my-table" class="table table-striped datatable">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @php
                                            $userRoleIds = json_decode($user->user_role ?? '[]', true);
                                        @endphp
                                        @foreach($userRoleIds as $roleId)
                                            @if(isset($roles[$roleId]))
                                                <span class="badge bg-success mb-1 d-inline-block">
                                                    <i class="bi bi-check-circle me-1"></i> {{ $roles[$roleId]->name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <!-- Edit -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $user->id }}">
                                            <i class="fa fa-edit text-primary me-2"></i>
                                        </a>
                                        <!-- Delete -->
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#user_delete_{{ $user->id }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>

                                        @include('admin.modal.manager', ['user' => $user])

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal_{{ $user->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('admin.admin_manager.update', $user->id) }}">
                                                        @csrf
                                                        <div class="modal-header bgc-primary text-white">
                                                            <h4 class="modal-title bgc-primary-text">Edit Admin Manager</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">First Name</label>
                                                                <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Last Name</label>
                                                                <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Phone</label>
                                                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Select Roles</label>
                                                                <div class="row">
                                                                    @php $selectedRoles = json_decode($user->user_role ?? '[]', true); @endphp
                                                                    @foreach($roles as $role)
                                                                        <div class="col-md-6 mb-2">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <span>{{ $role->name }}</span>
                                                                                <label class="switch">
                                                                                    <input type="checkbox" name="user_roles[]" value="{{ $role->id }}"
                                                                                        {{ in_array($role->id, $selectedRoles) ? 'checked' : '' }}>
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Edit Modal -->
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
</main>

<!-- Add Manager Modal -->
<div class="modal fade" id="addManagerModal" tabindex="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{ route('admin.admin_manager.save') }}" class="row g-3">
                @csrf
                <div class="modal-header bgc-primary text-white">
                    <h5 class="modal-title bgc-primary-text">Add Admin Manager</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                        <p class="text-danger small fw-bold">@error('first_name') {{ $message }} @enderror</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                        <p class="text-danger small fw-bold">@error('last_name') {{ $message }} @enderror</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        <p class="text-danger small fw-bold">@error('email') {{ $message }} @enderror</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="number" name="phone" value="{{ old('phone') }}" class="form-control">
                        <p class="text-danger small fw-bold">@error('phone') {{ $message }} @enderror</p>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Select Roles</label>
                        <div class="row">
                            @foreach($roles as $role)
                                <div class="col-md-6 mb-2">
                                    <label class="switch-label d-flex justify-content-between align-items-center">
                                        <span>{{ $role->name }}</span>
                                        <label class="switch">
                                            <input type="checkbox" name="user_roles[]" value="{{ $role->id }}">
                                            <span class="slider round"></span>
                                        </label>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-danger small fw-bold">@error('user_roles') {{ $message }} @enderror</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Add Manager</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
