<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Ashion Fashion Store</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-wrapper {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
            transition: 0.3s ease;
        }

        .login-wrapper:hover {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .login-logo {
            display: block;
            width: 90px;
            margin: 0 auto 15px auto;
        }

        .login-title {
            text-align: center;
            font-weight: 600;
            color: #222;
            margin-bottom: 25px;
            font-size: 1.6rem;
        }

        .form-label {
            font-weight: 500;
            color: #444;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3f8dd6;
            box-shadow: 0 0 0 0.2rem rgba(255, 111, 97, 0.25);
        }

        .btn-login {
            background-color: #3f8dd6;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #3f8dd6;
            box-shadow: 0 4px 10px rgba(255, 111, 97, 0.3);
            transform: translateY(-1px);
        }

        .text-link {
            color: #3f8dd6;
            text-decoration: none;
            font-weight: 500;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .login-wrapper {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">

        <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" alt="Logo" class="login-logo">
        <h2 class="login-title"></h2>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-dot"></i> {{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white text-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control border-start-0" placeholder="Masukkan email Anda" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-white text-secondary border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
            </button>

            <div class="text-center mt-3">
                <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-link">Daftar Sekarang</a></p>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
