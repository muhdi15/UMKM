@extends('pembeli.index')
@section('title', 'Keranjang')

@section('keranjang')
<section class="shop-cart spad">
    <div class="container">
        <!-- Tabel Keranjang Belanja -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Keranjang</h2>
                    <p>Keranjang Belanja Anda</p>
                </div>
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
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
                                <td class="cart__price">$ 150.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 300.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
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
                                <td class="cart__price">$ 170.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 170.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
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
                                <td class="cart__price">$ 85.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 170.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
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
                                <td class="cart__price">$ 55.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 110.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <!-- Bagian Alamat Pengiriman -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="address-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Alamat Pengiriman</h4>
                        <button class="site-btn btn-sm">Ubah Alamat</button>
                    </div>
                    <div class="address-card">
                        <div class="address-info">
                            <h5 class="font-weight-bold mb-2">John Doe</h5>
                            <p class="mb-2"><i class="fa fa-phone mr-2"></i>+62 812-3456-7890</p>
                            <p class="mb-0">
                                <i class="fa fa-map-marker mr-2 text-danger"></i>
                                Jl. Contoh Alamat No. 123, Kelurahan Contoh, Kecamatan Contoh, Kota Contoh, Provinsi Contoh, 12345
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Belanja -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="checkout-summary">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Ringkasan Belanja</h4>
                    </div>
                    <div class="summary-card">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="summary-details">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal (4 items)</span>
                                        <span class="font-weight-bold">$ 750.0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Biaya Pengiriman</span>
                                        <span class="font-weight-bold">$ 15.0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Diskon</span>
                                        <span class="font-weight-bold text-success">- $ 0.0</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="h5">Total Pembayaran</span>
                                        <span class="h5 text-primary">$ 765.0</span>
                                    </div>
                                    <div class="estimated-delivery">
                                        <small class="text-muted">
                                            <i class="fa fa-clock-o mr-1"></i>
                                            Estimasi tiba: 2-3 hari kerja
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkout-actions text-right">
                                    <button class="site-btn btn-block mb-3" style="padding: 12px;">
                                        <i class="fa fa-credit-card mr-2"></i>Proses Checkout
                                    </button>
                                    <button class="site-btn btn-block" style="padding: 10px; background: #f8f9fa; color: #333;">
                                        <i class="fa fa-shopping-cart mr-2"></i>Lanjut Belanja
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kupon Diskon -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#" class="d-flex">
                        <input type="text" placeholder="Enter your coupon code" class="form-control">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div>
            </div>
        </div> --}}
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