@extends('seller.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('menu-dashboard', 'active')

@section('content')

<div class="row g-4">

    <!-- Total Produk -->
    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm">
            <h5 class="text-muted">Total Produk</h5>
            <h2 class="fw-bold">{{ $totalProduk }}</h2>
        </div>
    </div>

    <!-- Total Pesanan -->
    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm">
            <h5 class="text-muted">Total Pesanan</h5>
            <h2 class="fw-bold">{{ $totalPesanan }}</h2>
        </div>
    </div>

    <!-- Pesanan Baru -->
    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm">
            <h5 class="text-muted">Pesanan Baru</h5>
            <h2 class="fw-bold text-primary">{{ $pesananBaru }}</h2>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm">
            <h5 class="text-muted">Pendapatan (dibayar)</h5>
            <h2 class="fw-bold text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
        </div>
    </div>

</div>

@endsection
