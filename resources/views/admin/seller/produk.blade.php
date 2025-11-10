@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Header & Navigasi --}}
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h4 class="fw-bold text-secondary mb-0">
             DATA PRODUK
        </h4>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-4">
        <a href="{{ route('admin.sellers') }}" class="btn btn-outline-primary btn-sm">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>



    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3">
            <i class="bx bx-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card Utama --}}
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h6 class="fw-semibold text-muted mb-0">
                <i class="bx bx-filter-alt me-1 text-primary"></i> Filter Produk
            </h6>

            {{-- Filter Form --}}
            <form method="GET" class="d-flex flex-wrap align-items-center gap-2">
                {{-- Filter Seller --}}
                <select name="seller_id" class="form-select form-select-sm shadow-sm" style="width: 180px;">
                    <option value="">Semua Seller</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}" {{ request('seller_id') == $seller->id ? 'selected' : '' }}>
                            {{ $seller->user->name ?? $seller->nama_toko }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Status --}}
                <select name="status" class="form-select form-select-sm shadow-sm" style="width: 150px;">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>

                {{-- Filter Tanggal --}}
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                       class="form-control form-control-sm shadow-sm" style="width: 160px;">

                {{-- Tombol Filter --}}
                <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                    <i class="bx bx-filter-alt"></i> Terapkan
                </button>

                {{-- Tombol Reset --}}
                <a href="{{ route('produk') }}" class="btn btn-sm btn-outline-secondary shadow-sm">
                    <i class="bx bx-reset"></i> Reset
                </a>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Produk</th>
                            <th>Seller</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $index => $item)
                            <tr class="border-bottom">
                                <td class="text-center text-muted">{{ $produk->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://cdn-icons-png.flaticon.com/512/785/785822.png' }}" 
                                            class="rounded-3 border me-3 shadow-sm" width="52" height="52" style="object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $item->nama_produk }}</div>
                                            <small class="text-muted">{{ Str::limit($item->deskripsi, 40) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $item->seller->user->name ?? '-' }}</div>
                                    <small class="text-muted">{{ $item->seller->nama_toko ?? '-' }}</small>
                                </td>
                                <td class="fw-semibold text-dark">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 
                                        {{ $item->status === 'aktif' ? 'bg-success' : ($item->status === 'nonaktif' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td><small>{{ $item->created_at->format('d M Y') }}</small></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-sm btn-info text-white" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bx bx-package text-secondary mb-2" style="font-size: 2.5rem;"></i>
                                    <p class="text-muted mb-0">Belum ada produk yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-end py-3 px-4">
            {{ $produk->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection
