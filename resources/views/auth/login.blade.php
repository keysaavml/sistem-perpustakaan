<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
    </style>
</head>

<body>
<div class="container login-wrapper d-flex align-items-center justify-content-center py-4">
    <div class="w-100" style="max-width: 420px;">

        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">📚 Perpustakaan</h4>
            <div class="text-muted">Sistem Informasi Perpustakaan</div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Masuk ke akun Anda</h5>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control"
                                   required>
                            <button type="button"
                                    id="togglePassword"
                                    class="btn btn-outline-secondary"
                                    aria-label="Tampilkan password">
                                <i class="bi bi-eye" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const toggleButton  = document.getElementById('togglePassword');
    const toggleIcon    = document.getElementById('togglePasswordIcon');

    toggleButton.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';

        passwordInput.type = isHidden ? 'text' : 'password';
        toggleIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        toggleButton.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
    });
</script>
</body>
</html>