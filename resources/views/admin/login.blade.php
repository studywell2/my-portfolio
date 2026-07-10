<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — {{ config('app.name') }}</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%230a0a0a'/><text x='50' y='68' font-size='52' font-weight='bold' text-anchor='middle' fill='%23d4af37' font-family='monospace'>&lt;/&gt;</text></svg>">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 20% 50%, rgba(212,175,55,0.08) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(59,130,246,0.08) 0%, transparent 50%);
        }
        .login-card {
            max-width: 420px;
            width: 100%;
            padding: 2.5rem;
            border-radius: 16px;
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            box-shadow: 0 8px 40px rgba(0,0,0,0.4);
        }
        .login-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            letter-spacing: -0.5px;
        }
        .form-control {
            background: #121212;
            border-color: #2a2a2a;
            color: #e0e0e0;
        }
        .form-control:focus {
            background: #121212;
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.15);
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="login-brand text-gradient-gold mb-2">Abideen.dev</div>
            <p class="text-muted mb-0">Sign in to your admin dashboard</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="admin@abideen.dev" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label text-muted" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn btn-gold w-100 py-2 mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>

            <div class="text-center">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left me-1"></i>Back to Website
                </a>
            </div>
        </form>
    </div>
</body>
</html>
