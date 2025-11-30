@extends('pembeli.index')
@section('title', 'UMKM')

@section('kategori')
<style>
    .category-carousel-section {
            background: #f8f9fa;
            padding: 80px 0;
        }

        .category-carousel-section .section-title {
            font-size: 28px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 0;
            position: relative;
        }

        .category-carousel-section .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 3px;
            background: #e53637;
        }

        .category-carousel-section .btn-primary {
            background: #111111;
            border-color: #111111;
            padding: 10px 25px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 0;
        }

        .category-carousel-section .btn-dark {
            background: #111111;
            border-color: #111111;
            color: #ffffff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .category-carousel {
            padding: 20px 10px;
        }

        .category-carousel .swiper-slide {
            padding: 15px 0;
        }

        .category-image-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #ffffff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .category-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-title {
            color: #111111;
            font-weight: 500;
            margin-top: 15px;
            font-size: 16px;
        }
        .category-grid-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 30px;
            margin-top: 30px;
        }

        .category-grid-item {
            text-align: center;
        }

        .category-grid-item .category-image-wrapper {
            width: 120px;
            height: 120px;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .category-grid-container {
                grid-template-columns: repeat(4, 1fr);
                gap: 25px;
            }
        }

        @media (max-width: 992px) {
            .category-grid-container {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .category-carousel-section .section-header {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            .category-grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .category-image-wrapper {
                width: 110px;
                height: 110px;
            }
            
            .category-title {
                font-size: 14px;
            }
            
            .category-carousel-section {
                padding: 60px 0;
            }
        }
        
        @media (max-width: 576px) {
            .category-grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            
            .category-image-wrapper {
                width: 90px;
                height: 90px;
            }
            
            .category-title {
                font-size: 13px;
            }
        }

        @media (max-width: 400px) {
            .category-grid-container {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }


</style>
    <!-- Category Grid Section Begin -->
<section class="category-carousel-section py-5 overflow-hidden">
    <div class="container-lg">
        <!-- Search Bar Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="search-bar d-flex justify-content-end">
                    <form action="" method="GET" class="d-flex w-100" style="max-width: 600px;">
                        <input type="text" name="query" class="form-control me-2" placeholder="Cari produk atau kategori..." required>
                        <button type="submit" class="btn btn-primary" style="border-radius: 10px;">
                            <span class="icon_search search-switch"></span>
                        </button>
                    </form>
                </div>
            </div>"
        </div>
       
        <div class="row">
            <div class="col-md-12">
                <!-- Baris 1 - 5 Kategori -->
                <div class="category-grid-container">
                    <!-- Kategori 1 -->

                    @foreach ($data as $item)
                        <a href="category.html" class="category-grid-item nav-link text-center">
                            <div class="category-image-wrapper">
                                <img src="{{ asset('storage/' . $item->foto_toko) }}" class="rounded-circle" alt="{{ $item->nama_toko }}">
                            </div>
                            <h4 class="fs-6 mt-3 fw-normal category-title">{{$item->nama_toko}}</h4>
                        </a>
                    @endforeach
                    
                    
                    <!-- Kategori 2 -->
                    {{-- <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-men.jpg') }}" class="rounded-circle" alt="Men's Fashion">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Men's Fashion</h4>
                    </a>
                    
                    <!-- Kategori 3 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-kids.jpg') }}" class="rounded-circle" alt="Kid's Fashion">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Kid's Fashion</h4>
                    </a>
                    
                    <!-- Kategori 4 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-accessories.jpg') }}" class="rounded-circle" alt="Accessories">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Accessories</h4>
                    </a>
                    
                    <!-- Kategori 5 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-cosmetics.jpg') }}" class="rounded-circle" alt="Cosmetics">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Cosmetics</h4>
                    </a>
                </div>
                
                <!-- Baris 2 - 5 Kategori -->
                <div class="category-grid-container mt-4">
                    <!-- Kategori 6 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-bags.jpg') }}" class="rounded-circle" alt="Bags">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Bags</h4>
                    </a>
                    
                    <!-- Kategori 7 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-shoes.jpg') }}" class="rounded-circle" alt="Shoes">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Shoes</h4>
                    </a>
                    
                    <!-- Kategori 8 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-jewelry.jpg') }}" class="rounded-circle" alt="Jewelry">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Jewelry</h4>
                    </a>
                    
                    <!-- Kategori 9 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-watches.jpg') }}" class="rounded-circle" alt="Watches">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Watches</h4>
                    </a>
                    
                    <!-- Kategori 10 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-sunglasses.jpg') }}" class="rounded-circle" alt="Sunglasses">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Sunglasses</h4>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category Grid Section End -->
@endsection