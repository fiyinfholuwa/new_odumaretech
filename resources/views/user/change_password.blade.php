@extends('user.app')

@section('content')

<div class="row" style="margin: 10px;">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Change Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.password.change') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="old_password">Current Password</label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" placeholder="Enter current password" required>
                        @error('old_password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="Enter new password" required>
                        @error('new_password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm new password" required>
                        @error('new_password_confirmation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" style="background:navy;border:none;" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
