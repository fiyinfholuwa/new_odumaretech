@extends('admin.app')

@section('content')
<style>
    .page-container {
        max-width: 800px;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        color: #fff;
        padding: 20px;
        font-size: 20px;
        font-weight: 600;
        border-bottom: none;
    }

    .card-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: #333;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: #2a9d8f;
        box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.2);
    }

    small {
        display: block;
        margin-top: 4px;
    }

    

    .btn-primary:hover {
        background: linear-gradient(90deg, #21867a, #1f3e3a);
        transform: scale(1.03);
    }

    @media (max-width: 600px) {
        .page-container {
            margin: 10px;
        }

        .card-body {
            padding: 15px;
        }
    }
</style>

<div class="page-container">
    <div class="card">
        <div  class="card-header bgc-secondary bgc-secondary-text">Add User</div>

        <div class="card-body">
            <form action="{{ route('admin.user.add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" required placeholder="Enter First Name">
                    <small style="color:red; font-weight:500">
                        @error('first_name') {{ $message }} @enderror
                    </small>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" required placeholder="Enter Last Name">
                    <small style="color:red; font-weight:500">
                        @error('last_name') {{ $message }} @enderror
                    </small>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" required placeholder="Enter Email">
                    <small style="color:red; font-weight:500">
                        @error('email') {{ $message }} @enderror
                    </small>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" required placeholder="Enter Password">
                    <small style="color:red; font-weight:500">
                        @error('password') {{ $message }} @enderror
                    </small>
                </div>

                <div class="form-group">
                    <label>Select Course Category</label>
                    <select name="course_id" required>
                        <option value="">Select Course Category</option>
                        @forelse($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @empty
                            <option disabled>No Course</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Course Cohort</label>
                    <select name="cohort_id" required>
                        <option value="">Select Course Cohort</option>
                        @forelse($cohorts as $cohort)
                            <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                        @empty
                            <option disabled>No Cohort</option>
                        @endforelse
                    </select>
                </div>

                <div class="card-action" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
