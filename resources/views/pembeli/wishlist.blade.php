@extends('pembeli.index')
@section('title', 'Wishllist')

@section('keranjang')
<section class="shop-cart spad">
    <div class="container">
        <!-- Tabel Keranjang Belanja -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>My Wishlist</h2>
                    <p>Produk yang Anda simpan untuk dibeli nanti</p>
                </div>
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('img/shop-cart/cp-1.jpg')}}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Chain bucket bag</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="wishlist__price">$ 150.0</td>
                                <td class="wishlist__stock">
                                    <span class="in-stock">In Stock</span>
                                </td>
                                <td class="wishlist__btn">
                                    <a href="#" class="primary-btn">Add to Cart</a>
                                </td>
                                <td class="wishlist__close">
                                    <span class="icon_heart" style="color: #ff6b6b;"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('img/shop-cart/cp-2.jpg')}}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Zip-pockets pebbled tote briefcase</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="wishlist__price">$ 85.0</td>
                                <td class="wishlist__stock">
                                    <span class="out-of-stock">Out of Stock</span>
                                </td>
                                <td class="wishlist__btn">
                                    <a href="#" class="primary-btn disabled">Notify Me</a>
                                </td>
                                <td class="wishlist__close">
                                    <span class="icon_heart" style="color: #ff6b6b;"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('img/shop-cart/cp-3.jpg')}}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Black jean</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="wishlist__price">$ 150.0</td>
                                <td class="wishlist__stock">
                                    <span class="in-stock">In Stock</span>
                                </td>
                                <td class="wishlist__btn">
                                    <a href="#" class="primary-btn">Add to Cart</a>
                                </td>
                                <td class="wishlist__close">
                                    <span class="icon_heart" style="color: #ff6b6b;"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('img/shop-cart/cp-4.jpg')}}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Cotton Shirt</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="wishlist__price">$ 150.0</td>
                                <td class="wishlist__stock">
                                    <span class="in-stock">In Stock</span>
                                </td>
                                <td class="wishlist__btn">
                                    <a href="#" class="primary-btn">Add to Cart</a>
                                </td>
                                <td class="wishlist__close">
                                    <span class="icon_heart" style="color: #ff6b6b;"></span>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .section-title {
    text-align: center;
    margin-bottom: 40px;
    }

    .section-title h2 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .section-title p {
        color: #666;
        font-size: 16px;
    }
 
    .in-stock {
        color: #7fad39;
        font-weight: 600;
    }

    .out-of-stock {
        color: #dc3545;
        font-weight: 600;
    }

    /* PERBAIKAN: Styling untuk primary button */
    .wishlist__btn .primary-btn {
        padding: 10px 20px;
        font-size: 14px;
        background: #ca1515;
        color: white !important;
        text-decoration: none;
        border: none;
        border-radius: 50px;
        transition: all 0.3s ease;
        display: inline-block;
        font-weight: 600;
        cursor: pointer;
    }

    .wishlist__btn .primary-btn:hover {
        /* background: #6b8c2e; */
        color: white !important;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .wishlist__btn .primary-btn.disabled {
        background: #ccc;
        color: #666 !important;
        cursor: not-allowed;
        pointer-events: none;
    }

    .wishlist__btn .primary-btn.disabled:hover {
        background: #ccc;
        color: #666 !important;
        transform: none;
        box-shadow: none;
    }

    .wishlist__close span {
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .wishlist__close span:hover {
        color: #dc3545 !important;
        transform: scale(1.1);
    }

    .wishlist__stats {
        font-size: 16px;
        color: #666;
    }

    .section-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title h2 {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .section-title p {
        color: #666;
        font-size: 16px;
    }

    /* Pastikan tidak ada styling biru dari browser */
    a.primary-btn:focus,
    a.primary-btn:active,
    a.primary-btn:visited {
        color: white !important;
        text-decoration: none !important;
    }
</style>
<!-- CSS tambahan -->
{{-- <style>
.address-section {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.address-card {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-left: 4px solid #7fad39;
}

.checkout-summary {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.summary-card {
    background-color: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.address-info h5 {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.address-info p {
    margin-bottom: 5px;
    color: #666;
}

.summary-details {
    color: #333;
}

.summary-details hr {
    margin: 15px 0;
    border-top: 2px solid #e9ecef;
}

.estimated-delivery {
    padding-top: 10px;
    border-top: 1px dashed #dee2e6;
}

.btn-sm {
    padding: 8px 20px;
    font-size: 14px;
}

.primary-btn {
    background: #666666;
    border: none;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.primary-btn:hover {
    background: #6b8c2e;
    color: white;
    transform: translateY(-2px);
}

.site-btn {
    background: #333;
    color: white;
    border: none;
    transition: all 0.3s ease;
}

.site-btn:hover {
    background: #555;
    color: white;
}

.text-primary {
    color: #7fad39 !important;
}
</style> --}}
<!-- Shop Cart Section End -->
@endsection