<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Inline Styling -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #e3f2fd, #f1f5f9);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-header {
            padding: 40px 0 30px;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .page-header img {
            width: 110px;
            margin-bottom: 15px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 26px;
            color: #333;
        }

        .page-header div {
            margin-top: 8px;
            font-size: 14px;
        }

        .page-header a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .page-header a:hover {
            text-decoration: underline;
        }

        /* Contact Container */
        .contact {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 0;
        }

        .contact-form {
            width: 90%;
            max-width: 450px;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            animation: fadeIn 0.5s ease-in-out;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 15px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            font-size: 15px;
            transition: border .3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn {
            background: #007bff;
            color: white;
            padding: 14px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s, transform 0.2s;
        }

        .btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .text-danger {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="page-header">
    <img src="{{ asset('logo.png') }}" alt="Logo">
    <h2>Reset Your Password</h2>
    <div>
        <a href="{{ route('home') }}">Home</a> / Reset Password
    </div>
</div>


<div class="contact">
    <div class="contact-form">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Hidden Email Field -->
            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

<input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Password -->
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <!-- Confirm Password -->
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <!-- Submit Button -->
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</div>

</body>
</html>
