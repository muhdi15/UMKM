@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class='bx bxs-store me-2'></i> Detail Seller
        </h3>
        <a href="{{ route('admin.sellers') }}" class="btn btn-secondary">
            <i class='bx bx-arrow-back'></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 mb-4">
        <div class="card-body">
            <div class="row g-4 align-items-center">
                <div class="col-md-4 text-center">
                    <img src="{{ $seller->foto_toko ? asset('storage/'.$seller->foto_toko) : 'https://cdn-icons-png.flaticon.com/512/4359/4359963.png' }}"
                         alt="Foto Toko"
                         class="img-fluid rounded-3 shadow-sm mb-3"
                         style="max-width: 220px;">
                    <div class="mt-3">
                        @if($seller->status == 'aktif')
                            <span class="badge bg-success px-3 py-2">Aktif</span>
                        @elseif($seller->status == 'nonaktif')
                            <span class="badge bg-secondary px-3 py-2">Nonaktif</span>
                        @else
                            <span class="badge bg-warning text-dark px-3 py-2">Menunggu Verifikasi</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 class="fw-semibold text-primary">{{ $seller->nama_toko }}</h4>
                    <div class="mt-2">
                        <p><strong>Pemilik:</strong> {{ $seller->user->name ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $seller->user->email ?? '-' }}</p>
                        <p><strong>No. Telepon:</strong> {{ $seller->no_telp ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $seller->alamat ?? '-' }}</p>
                        <p><strong>Deskripsi:</strong> {{ $seller->deskripsi ?? '-' }}</p>
                    </div>

                    {{-- Tombol Aksi Status --}}
                    <div class="mt-4 d-flex flex-wrap gap-2">
                        @if($seller->status != 'aktif')
                            <form action="{{ route('admin.seller.updateStatus', ['id' => $seller->id, 'status' => 'aktif']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class='bx bx-check-circle'></i> Aktifkan Seller
                                </button>
                            </form>
                        @endif

                        @if($seller->status == 'aktif')
                            <form action="{{ route('admin.seller.updateStatus', ['id' => $seller->id, 'status' => 'nonaktif']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning text-dark">
                                    <i class='bx bx-block'></i> Nonaktifkan Seller
                                </button>
                            </form>
                        @endif

                        @if($seller->status == 'menunggu')
                            <form action="{{ route('admin.seller.updateStatus', ['id' => $seller->id, 'status' => 'ditolak']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">
                                    <i class='bx bx-x-circle'></i> Tolak Pendaftaran
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Produk Seller --}}
    <div class="card shadow border-0">
        <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
            <span>Daftar Produk</span>
            <span class="badge bg-primary">{{ $seller->products->count() }} Produk</span>
        </div>
        <div class="card-body">
            @if($seller->products->isEmpty())
                <p class="text-muted text-center mb-0">Belum ada produk yang dijual oleh seller ini.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($seller->products as $i => $product)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td>{{ $product->stok }}</td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
