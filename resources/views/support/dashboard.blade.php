<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Portal - OdumareTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-sm border-0" style="max-width: 520px; width: 100%;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                    <div>
                        <h1 class="h3 mb-1">Support Portal</h1>
                        <p class="text-muted mb-0">Enter a student email to start a temporary support session.</p>
                    </div>
                    <form method="POST" action="{{ route('support.logout') }}">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm" type="submit">Logout</button>
                    </form>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger mt-4">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('support.impersonate') }}" class="mt-4">
                    @csrf
                    <label for="student_email" class="form-label">Student email</label>
                    <div class="input-group">
                        <input id="student_email" name="email" type="email" class="form-control" placeholder="student@example.com" required autofocus>
                        <button class="btn btn-primary" type="submit">Access Account</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
