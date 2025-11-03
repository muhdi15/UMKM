@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Header & Tombol Navigasi --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.sellers') }}" class="btn btn-outline-secondary btn-sm">
                <i class='bx bx-arrow-back'></i> Kembali
            </a>
        </div>
    </div>

    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bx bx-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card Data Produk --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="fw-semibold mb-2 mb-md-0 text-secondary">
                
            </h5>

            {{-- Filter Form --}}
            <form method="GET" class="d-flex flex-wrap align-items-center gap-2">
                {{-- Filter Seller --}}
                <select name="seller_id" class="form-select form-select-sm" style="width: 180px;">
                    <option value="">Semua Seller</option>
                    @foreach($sellers as $seller)
                        <option value="{{ $seller->id }}" {{ request('seller_id') == $seller->id ? 'selected' : '' }}>
                            {{ $seller->user->name ?? $seller->nama_toko }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Status --}}
                <select name="status" class="form-select form-select-sm" style="width: 150px;">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>

                {{-- Filter Tanggal Dibuat --}}
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control form-control-sm" style="width: 160px;">

                {{-- Tombol Filter --}}
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class='bx bx-filter'></i> Filter
                </button>

                {{-- Tombol Reset --}}
                <a href="{{ route('produk') }}" class="btn btn-sm btn-outline-secondary">
                    <i class='bx bx-reset'></i> Reset
                </a>
            </form>
        </div>

        {{-- Tabel Produk --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Produk</th>
                            <th>Seller</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $index => $item)
                            <tr>
                                <td>{{ $produk->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://cdn-icons-png.flaticon.com/512/785/785822.png' }}" 
                                            class="rounded border me-2 shadow-sm" width="48" height="48" style="object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $item->nama_produk }}</div>
                                            <small class="text-muted">{{ Str::limit($item->deskripsi, 35) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $item->seller->user->name ?? '-' }}</div>
                                    <small class="text-muted">{{ $item->seller->nama_toko ?? '-' }}</small>
                                </td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2
                                        {{ $item->status === 'aktif' ? 'bg-success' : ($item->status === 'nonaktif' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-sm btn-info text-white" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class='bx bx-show'></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    <i class='bx bx-package text-secondary mb-2' style="font-size: 2.5rem;"></i>
                                    <p class="mb-0">Belum ada produk yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-end">
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
