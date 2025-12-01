<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f6fa;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #1f2937;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 0;
            color: white;
            transition: 0.3s;
        }

        .sidebar .brand {
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar .menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #cbd5e1;
            font-size: 15px;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar .menu a:hover,
        .sidebar .menu a.active {
            background: #374151;
            color: #fff;
        }

        .sidebar .menu a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .content-area {
            margin-left: 260px;
            padding: 25px;
            min-height: 100vh;
            background: #f8fafc;
            transition: 0.3s;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 25px;
        }

        .profile-dropdown img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .dropdown-menu {
            font-size: 14px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-store me-2"></i> Seller Panel
        </div>

         <div class="menu">
            <a href="{{ route('seller.dashboard') }}" class="@yield('menu-dashboard')">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>

            <a href="{{route('seller.profile')}}" class="@yield('menu-profile')">
                <i class="fa-solid fa-user-gear"></i> Profil Toko
            </a>

            <a href="{{route('seller.products')}}" class="@yield('menu-products')">
                <i class="fa-solid fa-box"></i> Manajemen Produk
            </a>

            <a href="{{route('seller.orders')}}" class="@yield('menu-orders')">
                <i class="fa-solid fa-cart-shopping"></i> Pesanan
            </a>

            <a href="{{route('reviews')}}" class="@yield('menu-reviews')">
                <i class="fa-solid fa-star"></i> Ulasan
            </a>

            <a href="" class="@yield('menu-reports')">
                <i class="fa-solid fa-file-invoice"></i> Laporan
            </a>

            <a href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content-area">

        <!-- Topbar -->
        <div class="topbar">
            <h4>@yield('page-title')</h4>

            <div class="dropdown profile-dropdown">
                <a href="#" data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->seller->foto_toko ?? 'https://via.placeholder.com/150' }}" alt="Profile">
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                     <li><a class="dropdown-item" href=""><i
                                class="fa fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                class="fa fa-right-from-bracket me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Dynamic Page Content -->
        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
