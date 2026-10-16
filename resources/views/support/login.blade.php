<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Login - OdumareTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-sm border-0" style="max-width: 430px; width: 100%;">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 mb-2">Support Login</h1>
                <p class="text-muted mb-4">Sign in to access a student account for troubleshooting.</p>

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('support.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Support email</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Support password</label>
                        <input id="password" name="password" type="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Continue</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
