@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold text-secondary">
            <i class="bx bx-file me-2"></i> Laporan UMKM / Seller
        </h4>
    </div>

    {{-- Filter Laporan --}}
    <div class="card border-0 shadow-lg rounded-4 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.laporan.filter') }}" method="GET">

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="fw-semibold">Pilih UMKM / Seller</label>
                        <select name="seller_id" class="form-select">
                            <option value="">Semua Seller</option>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}" 
                                    {{ (isset($sellerId) && $sellerId == $seller->id) ? 'selected' : '' }}>
                                    {{ $seller->nama_toko }} - ({{ $seller->user->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="fw-semibold">Bulan</label>
                        <select name="bulan" class="form-select" required>
                            @foreach(range(1,12) as $b)
                                <option value="{{ $b }}" {{ (isset($bulan) && $bulan == $b) ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m',$b)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="fw-semibold">Tahun</label>
                        <input type="number" name="tahun" class="form-control" 
                               value="{{ $tahun ?? date('Y') }}" required>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            <i class="bx bx-search"></i> Tampilkan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @isset($orders)

    {{-- Statistik Laporan --}}
    <div class="row g-4 mb-4">

        {{-- Total Pesanan --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center py-4">
                    <h6 class="text-muted mb-1">Total Pesanan</h6>
                    <h3 class="fw-bold">{{ $totalPesanan }}</h3>
                </div>
            </div>
        </div>

        {{-- Total Pendapatan --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center py-4">
                    <h6 class="text-muted mb-1">Total Pendapatan</h6>
                    <h3 class="fw-bold text-success">Rp {{ number_format($totalPendapatan,0,',','.') }}</h3>
                </div>
            </div>
        </div>

        {{-- Produk Terjual --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center py-4">
                    <h6 class="text-muted mb-1">Produk Terjual</h6>
                    <h3 class="fw-bold">{{ $totalProdukTerjual }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel Detail Pesanan --}}
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-white py-3 px-4">
            <h6 class="fw-semibold text-secondary mb-0">
                <i class="bx bx-list-ul me-1 text-primary"></i> Detail Pesanan
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Pembeli</th>
                            <th>UMKM/Seller</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $i => $order)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $order->kode_pesanan }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->seller->nama_toko }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($order->status_order) }}</span>
                            </td>
                            <td>Rp {{ number_format($order->total_harga,0,',','.') }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @endisset

</div>
@endsection
