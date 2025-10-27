<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - UMKM Majene</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: radial-gradient(circle at top left, #0f2027, #203a43, #2c5364);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .form-control, .form-select {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            border-radius: 10px;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,0.25);
            box-shadow: 0 0 8px #00b4d8;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(90deg, #00b4d8, #0077b6);
            border: none;
            border-radius: 10px;
            transition: 0.4s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px #00b4d8;
        }

        .title {
            font-weight: 700;
            letter-spacing: 1px;
            color: #00b4d8;
            text-shadow: 0 0 10px rgba(0,180,216,0.5);
        }

        .form-label {
            font-weight: 500;
            color: #cfe7ff;
        }

        .alert {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left: 5px solid #00b4d8;
            backdrop-filter: blur(5px);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-container {
            min-height: 100vh;
        }

        .neon-glow {
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(0,180,216,0.3), transparent 70%);
            filter: blur(50px);
            animation: pulse 4s infinite alternate;
        }

        @keyframes pulse {
            from { transform: scale(1); opacity: 0.8; }
            to { transform: scale(1.2); opacity: 0.4; }
        }

        @media (max-width: 768px) {
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="register-container d-flex justify-content-center align-items-center position-relative">
        <div class="neon-glow"></div>

        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card p-4">
                        <div class="text-center mb-4">
                            <h3 class="title"><i class="bi bi-shop me-2"></i>UMKM Majene</h3>
                            <p class="text-light mb-1">Daftar Akun Baru</p>
                        </div>

                        {{-- ✅ Pesan sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- ❌ Pesan error --}}
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- ❗ Validasi Laravel --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.post') }}" data-aos="zoom-in" data-aos-duration="800">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap" required value="{{ old('name') }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email aktif" required value="{{ old('email') }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Daftar Sebagai</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Pembeli / Konsumen</option>
                                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Penjual (UMKM)</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 mt-3">
                                <i class="bi bi-person-plus"></i> Daftar Sekarang
                            </button>
                        </form>

                        <p class="mt-4 text-center">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-info text-decoration-none fw-semibold">
                                Login Sekarang
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // animasi smooth alert hilang otomatis
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    </script>
</body>
</html>
