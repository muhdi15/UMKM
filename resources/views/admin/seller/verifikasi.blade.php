@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Judul Halaman --}}
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">
         Verifikasi Seller
        </h3>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-4">
        <a href="{{ route('admin.sellers') }}" class="btn btn-secondary btn-sm">
            <i class='bx bx-arrow-back'></i> Kembali ke Daftar Seller
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
                <i class='bx bx-list-check text-primary'></i> Daftar Seller Menunggu Verifikasi
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Toko</th>
                            <th>Pemilik</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sellers as $index => $seller)
                            <tr>
                                <td>{{ $sellers->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $seller->foto_toko ? asset('storage/'.$seller->foto_toko) : 'https://cdn-icons-png.flaticon.com/512/4359/4359963.png' }}" 
                                             class="rounded me-2" width="40" height="40" style="object-fit: cover;">
                                        <div>
                                            <strong>{{ $seller->nama_toko }}</strong><br>
                                            <small class="text-muted">{{ Str::limit($seller->deskripsi, 30) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $seller->user->name ?? '-' }}</td>
                                <td>{{ $seller->user->email ?? '-' }}</td>
                                <td>{{ $seller->no_telp ?? '-' }}</td>
                                <td>{{ $seller->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        {{-- Tombol Terima --}}
                                        <form action="{{ route('admin.seller.updateStatus', ['id' => $seller->id, 'status' => 'aktif']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class='bx bx-check-circle'></i> Terima
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak --}}
                                        <form action="{{ route('admin.seller.updateStatus', ['id' => $seller->id, 'status' => 'ditolak']) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class='bx bx-x-circle'></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class='bx bx-store text-secondary' style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2">Tidak ada seller yang menunggu verifikasi.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $sellers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
