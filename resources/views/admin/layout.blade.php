<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | UMKM Majene</title>

    <!-- Bootstrap 5 -->
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Boxicons -->
    <link href="{{asset('https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css')}}" rel="stylesheet">

    <!-- Google Font -->
    <link href="{{asset('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap')}}" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f6f9fc;
            color: #222;
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, #0a0f24 0%, #02050d 100%);
            color: #fff;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .sidebar .logo {
            text-align: center;
            padding: 25px 10px;
            font-size: 1.3rem;
            font-weight: 600;
            color: #00ffff;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            color: #ccc;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link i {
            font-size: 1.3rem;
            margin-right: 10px;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(0, 255, 255, 0.1);
            color: #00ffff;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
            min-height: 100vh;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .navbar .navbar-brand {
            color: #007bff;
            font-weight: 600;
        }

        .navbar .dropdown-menu {
            border-radius: 10px;
            overflow: hidden;
        }

        .sidebar-toggle {
            display: none;
            cursor: pointer;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 0;
            }

            .sidebar.show {
                width: 250px;
            }

            .content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #888;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class='bx bxs-store-alt'></i> UMKM Majene
    </div>

    <nav class="mt-3">
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class='bx bxs-dashboard'></i> Dashboard
        </a>

        <a href="{{ route('admin.sellers') }}" 
           class="nav-link {{ request()->routeIs('admin.sellers') || request()->routeIs('admin.seller.show') ? 'active' : '' }}">
            <i class='bx bxs-user-badge'></i> Manajemen Seller
        </a>

        <a href="{{ route('admin.konsumen')}}" 
           class="nav-link {{ request()->routeIs('admin.customers') ? 'active' : '' }}">
            <i class='bx bxs-user'></i> Manajemen Konsumen
        </a>

        <a href="{{route('produk')}}" 
           class="nav-link {{ request()->routeIs('produk') ? 'active' : '' }}">
            <i class='bx bxs-box'></i> Produk
        </a>

        <a href="{{route('kategori.index')}}" 
           class="nav-link {{ request()->routeIs('admin.katergori') ? 'active' : '' }}">
            <i class='bx bxs-category'></i> Kategori
        </a>

        <a href="#" 
           class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class='bx bxs-cart-alt'></i> Pesanan
        </a>

        <a href="{{route('admin.laporan')}}" 
           class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
            <i class='bx bxs-bar-chart-alt-2'></i> Laporan
        </a>

        <a href="#" 
           class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <i class='bx bxs-cog'></i> Pengaturan
        </a>
    </nav>
</div>


    <!-- Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg px-3 py-2">
            <div class="container-fluid">
                <span class="sidebar-toggle text-dark me-3" onclick="toggleSidebar()"><i class='bx bx-menu'></i></span>
                <a class="navbar-brand" href="#">Dashboard Admin</a>

                <div class="dropdown ms-auto">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{asset('https://cdn-icons-png.flaticon.com/512/149/149071.png')}}" alt="User" width="35" height="35" class="rounded-circle me-2">
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="{{route('admin.profile')}}">Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <div class="footer">
            &copy; {{ date('Y') }} UMKM Majene — Dibangun dengan ❤️ oleh Tim Dev Majene
        </div>
    </div>

    <!-- Script -->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
