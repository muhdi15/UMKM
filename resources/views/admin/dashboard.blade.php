@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">

    <!-- Judul Halaman -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    </div>

    <!-- Statistik Utama -->
    <div class="row">

        <!-- Total Admin -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Admin
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAdmin }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Seller -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Seller
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSeller }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Pengguna
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Produk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Produk
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProduk }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Pesanan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPesanan }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Total Kategori
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKategori }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Baris Data Baru -->
    <div class="row">

        <!-- Seller Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Seller Terbaru</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                {{-- <th>Tanggal Bergabung</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentSellers as $seller)
                                <tr>
                                    <td>{{ $seller->name }}</td>
                                    <td>{{ $seller->email }}</td>
                                    {{-- <td>{{ $seller->created_at->format('d M Y') }}</td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada seller baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold">Pesanan Terbaru</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Pemesan</th>
                                {{-- <th>Tanggal</th> --}}
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $badgeColors = [
                                    'diproses'   => 'primary',
                                    'dikirim'    => 'info',
                                    'dibatalkan' => 'danger',
                                    'selesai'    => 'success',
                                ];
                            @endphp

                            @forelse ($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    {{-- <td>{{ $order->created_at->format('d M Y') }}</td> --}}
                                    <td>
                                        <span class="badge bg-{{ $badgeColors[$order->status_order] ?? 'secondary' }}">
                                            {{ ucfirst($order->status_order) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Belum ada pesanan baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
