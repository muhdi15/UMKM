@extends('pembeli.index')
@section('title', 'Riwayat')

@section('history')
<section class="order-history spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Order History</h2>
                    <p>Riwayat pesanan dan pengiriman Anda</p>
                </div>

                <!-- Filter Orders -->
                <div class="order-filter mb-4">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <select class="form-control">
                                <option>Semua Status</option>
                                <option>Menunggu Pembayaran</option>
                                <option>Diproses</option>
                                <option>Dikirim</option>
                                <option>Selesai</option>
                            </select>
                        </div>
                        {{-- <div class="col-lg-3 col-md-6">
                            <input type="month" class="form-control">
                        </div> --}}
                        {{-- <div class="col-lg-6 text-right">
                            <div class="search-order">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari no. invoice...">
                                    <div class="input-group-append">
                                        <button class="site-btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <!-- Order List -->
                <div class="order-list">
                    <!-- Order 1 -->
                    <div class="order-card">
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="order-info">
                                        <h6>INV/2024/001/2345</h6>
                                        <small class="text-muted">Dibuat: 15 Jan 2024, 14:30</small>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="order-status status-completed">Selesai</span>
                                    <span class="order-total">$ 765.0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-items">
                            <div class="order-item">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="product-info">
                                            <img src="{{asset('img/shop-cart/cp-1.jpg')}}" alt="Product" width="60">
                                            <div class="product-details">
                                                <h6>Chain bucket bag</h6>
                                                <small>Qty: 2</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="item-price">$ 300.0</span>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button class="btn-review">Beri Ulasan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="order-item">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="product-info">
                                            <img src="{{asset('img/shop-cart/cp-2.jpg')}}" alt="Product" width="60">
                                            <div class="product-details">
                                                <h6>Zip-pockets pebbled tote</h6>
                                                <small>Qty: 1</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="item-price">$ 170.0</span>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button class="btn-review">Beri Ulasan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-footer">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <small class="text-muted">Total: 3 items</small>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn-detail">Detail Order</button>
                                    <button class="btn-buy-again">Beli Lagi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order 2 -->
                    <div class="order-card">
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="order-info">
                                        <h6>INV/2024/001/2346</h6>
                                        <small class="text-muted">Dibuat: 10 Jan 2024, 09:15</small>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="order-status status-shipped">Dikirim</span>
                                    <span class="order-total">$ 425.0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-items">
                            <div class="order-item">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="product-info">
                                            <img src="{{asset('img/shop-cart/cp-3.jpg')}}" alt="Product" width="60">
                                            <div class="product-details">
                                                <h6>Black jean</h6>
                                                <small>Qty: 2</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="item-price">$ 170.0</span>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button class="btn-track">Lacak Pengiriman</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-footer">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <small class="text-muted">Total: 1 item</small>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn-detail">Detail Order</button>
                                    <button class="btn-buy-again">Beli Lagi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order 3 -->
                    <div class="order-card">
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="order-info">
                                        <h6>INV/2024/001/2347</h6>
                                        <small class="text-muted">Dibuat: 5 Jan 2024, 16:45</small>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="order-status status-pending">Menunggu Pembayaran</span>
                                    <span class="order-total">$ 280.0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-items">
                            <div class="order-item">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="product-info">
                                            <img src="{{asset('img/shop-cart/cp-4.jpg')}}" alt="Product" width="60">
                                            <div class="product-details">
                                                <h6>Cotton Shirt</h6>
                                                <small>Qty: 2</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <span class="item-price">$ 110.0</span>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button class="btn-pay">Bayar Sekarang</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="order-footer">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <small class="text-muted">Total: 1 item</small>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn-detail">Detail Order</button>
                                    <button class="btn-cancel">Batalkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="pagination__links text-center">
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.order-card {
    background: #fff;
    border-radius: 50px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.order-header {
    padding: 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.order-items {
    padding: 20px;
}

.order-item {
    padding: 15px 0;
    border-bottom: 1px solid #f1f1f1;
}

.order-item:last-child {
    border-bottom: none;
}

.order-footer {
    padding: 15px 20px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.product-info {
    display: flex;
    align-items: center;
}

.product-info img {
    border-radius: 5px;
    margin-right: 15px;
}

.product-details h6 {
    margin-bottom: 5px;
    font-weight: 600;
}

.order-status {
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin-right: 10px;
}

.status-completed {
    background: #d4edda;
    color: #155724;
}

.status-shipped {
    background: #cce7ff;
    color: #004085;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-processing {
    background: #d1ecf1;
    color: #0c5460;
}

.order-total {
    font-weight: 700;
    font-size: 18px;
    color: #7fad39;
}

.item-price {
    font-weight: 600;
    color: #333;
}

.btn-detail, .btn-buy-again, .btn-review, .btn-track, .btn-pay, .btn-cancel {
    padding: 6px 15px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 50px;
    font-size: 12px;
    margin-left: 5px;
    transition: all 0.3s ease;
}

.btn-buy-again {
    background: #7fad39;
    color: white;
    border-color: #7fad39;
}

.btn-review {
    background: #17a2b8;
    color: white;
    border-color: #17a2b8;
}

.btn-track {
    background: #ffc107;
    color: #212529;
    border-color: #ffc107;
}

.btn-pay {
    background: #28a745;
    color: white;
    border-color: #28a745;
}

.btn-cancel {
    background: #dc3545;
    color: white;
    border-color: #dc3545;
}

.btn-detail:hover, .btn-buy-again:hover, .btn-review:hover, .btn-track:hover, .btn-pay:hover, .btn-cancel:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.order-filter .form-control {
    margin-bottom: 10px;
}

.pagination__links {
    margin-top: 30px;
}

.pagination__links a {
    display: inline-block;
    height: 40px;
    width: 40px;
    border: 1px solid #e1e1e1;
    border-radius: 50%;
    font-size: 14px;
    color: #111111;
    font-weight: 700;
    line-height: 40px;
    text-align: center;
    margin-right: 6px;
    transition: all 0.3s;
}

.pagination__links a.active {
    background: #7fad39;
    border-color: #7fad39;
    color: #ffffff;
}

.pagination__links a:hover {
    background: #7fad39;
    border-color: #7fad39;
    color: #ffffff;
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
</style>
@endsection