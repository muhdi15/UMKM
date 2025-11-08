<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Ashion Fashion Store</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            /* ✅ Background image setup */
            background: url('https://as2.ftcdn.net/jpg/02/01/88/03/1000_F_201880339_zTcsW58B73gEN6qQaqm0HvYLuUyP53rv.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* Overlay agar teks dan form lebih jelas */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(3px);
        }

        .register-wrapper {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 30px 25px;
            width: 100%;
            max-width: 400px;
            transition: 0.3s ease;
        }

        .register-wrapper:hover {
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.15);
        }

        .register-logo {
            display: block;
            width: 70px;
            margin: 0 auto 12px auto;
        }

        .register-title {
            text-align: center;
            font-weight: 600;
            color: #222;
            margin-bottom: 20px;
            font-size: 1.4rem;
        }

        .form-label {
            font-weight: 500;
            color: #444;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 8px 14px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3f8dd6;
            box-shadow: 0 0 0 0.2rem rgba(255, 111, 97, 0.25);
        }

        .btn-register {
            background-color: #3f8dd6;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .btn-register:hover {
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
            font-size: 0.85rem;
        }

        @media (max-width: 576px) {
            .register-wrapper {
                padding: 25px 18px;
                max-width: 90%;
            }

            .register-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="register-wrapper">
        <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" alt="Logo" class="register-logo">
        <h2 class="register-title">Ashion Fashion Store</h2>

        {{-- ✅ Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ❌ Alert Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ⚠️ Validasi Laravel --}}
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

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email aktif" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>

            <div class="mb-4">
                <label for="role" class="form-label">Daftar Sebagai</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pembeli / Konsumen</option>
                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Penjual (UMKM)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-register w-100 py-2">
                <i class="bi bi-person-plus me-1"></i> Daftar Sekarang
            </button>

            <div class="text-center mt-3">
                <p class="mb-0">Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-link">Masuk Sekarang</a>
                </p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
