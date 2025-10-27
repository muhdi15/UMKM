<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UMKM Majene</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 50% 20%, #0a0f24, #02050d);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.2);
            transition: all 0.4s ease;
            animation: fadeInUp 1s ease;
        }

        .login-card:hover {
            box-shadow: 0 0 40px rgba(0, 255, 255, 0.4);
            transform: scale(1.02);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
        }

        .form-control:focus {
            box-shadow: 0 0 10px #00ffff;
            border: 1px solid #00ffff;
        }

        .btn-login {
            background: linear-gradient(90deg, #00ffff, #0077ff);
            border: none;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            box-shadow: 0 0 15px #00ffff;
            transform: scale(1.05);
        }

        .title {
            text-align: center;
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #00ffff;
            letter-spacing: 1px;
        }

        .footer-text {
            margin-top: 15px;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer-text a {
            color: #00ffff;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .logo {
            display: block;
            margin: 0 auto 15px auto;
            width: 80px;
            filter: drop-shadow(0 0 10px #00ffff);
            animation: pulseLogo 3s infinite ease-in-out;
        }

        @keyframes pulseLogo {
            0% { transform: scale(1); filter: drop-shadow(0 0 10px #00ffff); }
            50% { transform: scale(1.1); filter: drop-shadow(0 0 25px #00ffff); }
            100% { transform: scale(1); filter: drop-shadow(0 0 10px #00ffff); }
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }
            .title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-card animate__animated animate__fadeInUp">
        <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" alt="Logo" class="logo">
        <h2 class="title">UMKM Majene</h2>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Alert Error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-dot"></i> {{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label text-info">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent text-info"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-info">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent text-info"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 py-2 fw-bold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
            </button>

            <div class="footer-text mt-3">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
