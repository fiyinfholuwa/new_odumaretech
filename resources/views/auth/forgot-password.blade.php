<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Inline Styling For Independence -->
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

        /* Center the form area */
        .contact {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
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
            transition: border 0.3s;
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
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .success-message {
            background: #e0f7e9;
            color: #1b7d3f;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: 600;
        }

    </style>
</head>
<body>

<div class="page-header">
    <img src="{{ asset('logo.png') }}" alt="Logo">
    <h2>Password Reset</h2>
    <div>
        <a href="{{ route('home') }}">Home</a> / Password Reset
    </div>
</div>

<div class="contact">
    <div class="contact-form">

        @if(session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">Enter Your Email</label>
            <input 
                type="email" 
                class="form-control" 
                name="email" 
                id="email" 
                placeholder="example@email.com" 
                value="{{ old('email') }}"
            >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button class="btn" type="submit">Submit</button>
        </form>

    </div>
</div>

</body>
</html>
