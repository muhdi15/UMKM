@extends('pembeli.index')
@section('kategori')
    <!-- Category Grid Section Begin -->
<section class="category-carousel-section py-5 overflow-hidden">
    <div class="container-lg">
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Shop By Category</h2>
                    
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn btn-primary me-2">View All</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <!-- Baris 1 - 5 Kategori -->
                <div class="category-grid-container">
                    <!-- Kategori 1 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
                        <div class="category-image-wrapper">
                            <img src="{{ asset('img/categories/category-women.jpg') }}" class="rounded-circle" alt="Women's Fashion">
                        </div>
                        <h4 class="fs-6 mt-3 fw-normal category-title">Women's Fashion</h4>
                    </a>
                    
                    <!-- Kategori 2 -->
                    <a href="category.html" class="category-grid-item nav-link text-center">
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
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category Grid Section End -->
@endsection
