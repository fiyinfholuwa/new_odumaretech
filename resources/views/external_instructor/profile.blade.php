@extends('external_instructor.app')

@section('content')
<div class="row" style="margin: 10px;">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-primary text-white">
                <h4 class="card-title mb-0 bgc-primary-text">Account Settings</h4>
            </div>

            <div class="card-body">
                {{-- ✅ Tabs Navigation --}}
                <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                            Profile Information
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab">
                            Bank Information
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
                            Change Password
                        </button>
                    </li>
                </ul>

                {{-- ✅ Tabs Content --}}
                <div class="tab-content p-3" id="settingsTabsContent">

                    {{-- 🔹 Profile Info Tab --}}
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="form-group mb-3">
                                <label>About Me</label>
                                <textarea id="myTextarea" class="form-control" name="about_me">{{ Auth::user()->about_me }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">

                                <div>
                                <img style="height:50px; width:50px; border-radius:50%;" src="{{asset(Auth::user()->image) }}"/>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" style="background:navy;border:none;">Update Profile</button>
                            </div>
                        </form>
                    </div>

                    {{-- 🔹 Bank Info Tab --}}
                    <div class="tab-pane fade" id="bank" role="tabpanel">
                        <form action="{{ route('user.bankinfo.update') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" value="{{ $bankInfo['bank_name'] ?? '' }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Account Number / IBAN</label>
                                <input type="text" class="form-control" name="account_number" value="{{ $bankInfo['account_number'] ?? '' }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>SWIFT/BIC Code</label>
                                <input type="text" class="form-control" name="swift_code" value="{{ $bankInfo['swift_code'] ?? '' }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Country</label>
                                <select name="country" class="form-control" required>
                                    <option value="">-- Select Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ (old('country', $bankInfo['country'] ?? '') == $country) ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Bank Address</label>
                                <input type="text" class="form-control" name="bank_address" value="{{ $bankInfo['bank_address'] ?? '' }}">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success" style="background:green;border:none;">Save Bank Info</button>
                            </div>
                        </form>
                    </div>

                    {{-- 🔹 Change Password Tab --}}
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <form action="{{ route('user.password.change') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="old_password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>
                            <div class="form-group mb-4">
                                <label>Confirm New Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" style="background:navy;border:none;">Update Password</button>
                            </div>
                        </form>
                    </div>

                </div> {{-- end tab-content --}}
            </div>
        </div>
    </div>
</div>
@endsection
