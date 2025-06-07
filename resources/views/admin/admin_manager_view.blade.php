@extends('admin.app')

@section('title',  'Manage Manager')
@section('page',  'Manage Manager')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <!-- Add Admin Manager -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0 text-white">Add Admin Manager</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.admin_manager.save') }}" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First Name">
                                    <p class="text-danger small fw-bold">@error('first_name') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name">
                                    <p class="text-danger small fw-bold">@error('last_name') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                    <p class="text-danger small fw-bold">@error('email') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone Number">
                                    <p class="text-danger small fw-bold">@error('phone') {{ $message }} @enderror</p>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Select Role</label>
                                    <select class="form-control" name="user_role">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger small fw-bold">@error('user_role') {{ $message }} @enderror</p>
                                </div>
                                <div>
                                    <button style="background-color: navy" type="submit" class="btn btn-primary w-100">Add Admin Manager</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Manage Admin Managers -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0 text-white">Manage Admin Managers</h5>
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
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ optional($user->role_name)->name }}
                                        </span>
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $user->id }}">
                                                <i class="fa fa-edit text-primary me-2"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#user_delete_{{ $user->id }}">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>

                                            <!-- Include Delete Modal -->
                                            @include('admin.modal.manager', ['user' => $user])

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal_{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel_{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form method="post" action="{{ route('admin.admin_manager.update', $user->id) }}">
                                                            @csrf
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title text-white" id="editModalLabel_{{ $user->id }}">Edit Admin Manager</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                    <label class="form-label">Select Role</label>
                                                                    <select name="user_role" class="form-control">
                                                                        @foreach($roles as $role)
                                                                            <option value="{{ $role->id }}" {{ $user->user_role == $role->id ? 'selected' : '' }}>
                                                                                {{ $role->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
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
@endsection
