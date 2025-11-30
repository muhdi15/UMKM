
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'UMKM Majene')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="{{route('user.dashboard')}}"><img src="https://beritawarganet.com/wp-content/uploads/2022/08/Logo-Kabupaten-Majene.png" alt=""  style="max-height: 50px; width: auto;"></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="{{route('login')}}">Login</a>
            <a href="{{route('register')}}">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row  align-item-center">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="{{route('user.dashboard')}}">
                            <img src="https://beritawarganet.com/wp-content/uploads/2022/08/Logo-Kabupaten-Majene.png" alt="Logo Majene"  style="max-height: 40px; width: auto;">
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul class="text-center">
                            <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                                <a href="{{route ('user.dashboard')}}">Home</a>
                            </li>
                            <li class="{{ request()->routeIs('user.umkm') ? 'active' : '' }}">
                                <a href="{{route ('user.umkm')}}">umkm</a>
                            </li>
                            <li class="{{ request()->routeIs('user.about') ? 'active' : '' }}">
                                <a href="{{route ('user.about')}}">About</a>
                            </li>
                            {{-- <li><a href="./shop.html">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="./product-details.html">Product Details</a></li>
                                    <li><a href="./shop-cart.html">Shop Cart</a></li>
                                    <li><a href="./checkout.html">Checkout</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li> --}}
                            <li class="{{ request()->routeIs('user.contact') ? 'active' : '' }}">
                                <a href="{{route ('user.contact')}}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            @guest
                                {{-- Jika user BELUM login --}}
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            @endguest
                
                            @auth
                                {{-- Jika user SUDAH login --}}
                                {{-- <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                    </a>
                                </div> --}}
                            @endauth
                        </div>
                
                        <ul class="header__right__widget">
                            <!-- Icon Keranjang -->
                            <li>
                                <a href="{{ route('user.keranjang') }}">
                                    <i class="fas fa-bell"></i>
                                    
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('user.keranjang') }}">
                                    <span class="icon_bag_alt"></span>
                                </a>
                            </li>
                
                            <!-- Icon Wishlist -->
                            <li>
                                <a href="{{ route('user.wishlist') }}">
                                    <span class="icon_heart_alt"></span>
                                </a>
                            </li>
                
                            <!-- Dropdown Profil User -->
                            @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    {{-- <li>
                                        <div class="dropdown-header px-3 py-2">
                                            <small>Selamat datang,</small>
                                            <div class="fw-bold text-truncate">{{ Auth::user()->name }}</div>
                                        </div>
                                    </li> --}}
                                    {{-- <li><hr class="dropdown-divider"></li> --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.profil') }}">
                                        Profil Saya
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.history') }}">
                                        Riwayat Pesanan
                                            <span class="badge bg-danger float-end">5</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                        Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>   
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    @yield('profil')
    @yield('home')
    @yield('kategori')
    @yield('about')
    @yield('contact')
    @yield('keranjang')
    @yield('history')
    @yield('wishlist')


<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./index.html">
                            <img src="https://beritawarganet.com/wp-content/uploads/2022/08/Logo-Kabupaten-Majene.png" 
                                 alt="Logo Majene" 
                                 style="max-height: 50px; width: auto;">
                        </a>
                    </div>
                    <p>Toko online terpercaya di Majene. Menyediakan berbagai produk berkualitas dengan pelayanan terbaik untuk masyarakat Majene.</p>
                    <div class="footer__payment">
                        <div class="cod-badge">
                            <i class="fa fa-money"></i>
                            <span>Cash on Delivery (COD)</span>
                        </div>
                        <div class="payment-desc">
                            <small>Bayar ketika pesanan sampai di tempat Anda</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Tautan Cepat</h6>
                    <ul>
                        <li>
                            <a href="{{route ('user.dashboard')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route ('user.umkm')}}">umkm</a>
                        </li>
                        <li>
                            <a href="{{route ('user.about')}}">About</a>
                        </li>
                        <li>
                            <a href="{{route ('user.contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Akun</h6>
                    <ul>
                        <li>
                            <a href="{{ route('user.profil') }}">
                            Profil Saya
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.keranjang') }}">Keranjang
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.wishlist') }}">
                                Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.history') }}">
                            Riwayat Pesanan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <p>Berlangganan untuk mendapatkan promo dan update terbaru</p>
                    <form action="#">
                        <input type="text" placeholder="Alamat Email">
                        <button type="submit" class="site-btn">Berlangganan</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | UMKM Majene</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

   <!-- Js Plugins -->
   <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
   <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('js/mixitup.min.js') }}"></script>
   <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
   <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
   <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
   <script src="{{ asset('js/main.js') }}"></script>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>