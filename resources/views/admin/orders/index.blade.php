@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <h4 class="fw-bold text-secondary mb-4">📦 Manajemen Pesanan</h4>

    {{-- Filter --}}
    <div class="card shadow-sm border-0 mb-4 rounded-4">
        <div class="card-header bg-white border-0 py-3">
            <h6 class="fw-bold text-muted mb-0">
                <i class="bx bx-filter-alt me-1 text-primary"></i> Filter Pesanan
            </h6>
        </div>

        <div class="card-body">
            <form method="GET" class="row g-3">

                {{-- Pilih Seller --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">UMKM / Seller</label>
                    <select name="seller_id" class="form-select shadow-sm">
                        <option value="">Semua UMKM</option>
                        @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}"
                                {{ request('seller_id') == $seller->id ? 'selected' : '' }}>
                                {{ $seller->user->name }} — {{ $seller->nama_toko }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-primary shadow-sm px-4 w-100">
                        <i class="bx bx-search"></i> Terapkan
                    </button>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.orders') }}"
                       class="btn btn-outline-secondary shadow-sm w-100">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Pesanan --}}
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Kode Pesanan</th>
                            <th>Pembeli</th>
                            <th>Toko</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $index => $order)
                            <tr>
                                <td class="text-center">{{ $orders->firstItem() + $index }}</td>
                                <td class="fw-bold text-primary">#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->seller->nama_toko }}</td>
                                <td class="fw-semibold">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark px-3 py-2">
                                        {{ ucfirst($order->status_order) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.detail', $order->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="bx bx-show"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="bx bx-package fs-1"></i>
                                    <p class="mt-2">Belum ada pesanan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 py-3">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
