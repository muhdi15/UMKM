@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">
            <i class="bx bxs-store-alt text-primary"></i> Manajemen Seller
        </h3>
    </div>

    {{-- Navigasi Sub Menu --}}
    <div class="mb-4 d-flex flex-wrap gap-2">
        <a href="{{ route('admin.sellers') }}" class="btn btn-sm btn-primary">
            <i class='bx bx-list-ul'></i> Daftar Seller
        </a>
        <a href="{{route('admin.seller.verifikasi')}}" class="btn btn-sm btn-outline-secondary">
            <i class='bx bx-user-check'></i> Verifikasi Seller
        </a>
        <a href="{{route('produk')}}" class="btn btn-sm btn-outline-secondary">
            <i class='bx bx-package'></i> Produk Seller
        </a>
        <a href="{{route('admin.seller.map')}}" class="btn btn-sm btn-outline-secondary">
            <i class='bx bx-map'></i> Peta Lokasi
        </a>
        <a href="#" class="btn btn-sm btn-outline-secondary">
            <i class='bx bx-cart'></i> Pesanan
        </a>
        <a href="#" class="btn btn-sm btn-outline-secondary">
            <i class='bx bx-export'></i> Export Data
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bx bx-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card Utama --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0 text-secondary">
                <i class='bx bx-list-ul text-primary'></i> Daftar Seller
            </h5>
            <form class="d-flex" role="search" style="max-width: 250px;">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Cari seller..." aria-label="Search">
                <button class="btn btn-sm btn-primary" type="submit">
                    <i class='bx bx-search'></i>
                </button>
            </form>
        </div>

        <div class="card-body p-0">
            {{-- Table Responsif --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Toko</th>
                            <th>Pemilik</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sellers as $index => $seller)
                            <tr class="border-bottom">
                                <td>{{ $sellers->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $seller->foto_toko ? asset('storage/'.$seller->foto_toko) : 'https://cdn-icons-png.flaticon.com/512/4359/4359963.png' }}" 
                                             class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                        <div>
                                            <span class="fw-semibold">{{ $seller->nama_toko }}</span><br>
                                            <small class="text-muted">{{ Str::limit($seller->deskripsi, 25) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $seller->user->name ?? '-' }}</td>
                                <td>{{ $seller->user->email ?? '-' }}</td>
                                <td>{{ $seller->no_telp ?? '-' }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 {{ $seller->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($seller->status) }}
                                    </span>
                                </td>
                                <td>{{ $seller->created_at ? $seller->created_at->format('d M Y') : '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.seller.show', $seller->id) }}" class="btn btn-sm btn-info text-white" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class='bx bx-show'></i>
                                        </a>
                                        <form action="{{ route('admin.seller.destroy', $seller->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus seller ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus Seller">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class='bx bx-store text-secondary' style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2">Belum ada data seller yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $sellers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Tooltip Script --}}
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush

@endsection
