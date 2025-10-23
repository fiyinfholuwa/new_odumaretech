<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .verification-card {
            max-width: 450px;
            margin: 80px auto;
            padding: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .brand-logo img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        .description {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.5;
        }

        .alert-custom {
            font-size: 0.9rem;
        }

        button {
            border-radius: 8px !important;
        }
    </style>
</head>

<body>

    <div class="verification-card">
        <div class="text-center brand-logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
        </div>

        <p class="title text-center">Verify Your Email</p>
        <p class="description">
            Thanks for signing up! Please verify your email address by clicking the link we just emailed you.
            If you didn’t receive the email, click below and we’ll send another one.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success alert-custom mt-3">
                A new verification link has been sent to your email.
            </div>
        @endif

        <div class="mt-4 d-flex justify-content-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm px-3">
                    Resend Email
                </button>
            </form>

            <form method="GET" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary btn-sm px-3">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
