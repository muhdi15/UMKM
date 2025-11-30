@extends('admin.layout')

@section('produk')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">
            <i class="bx bxs-box text-primary"></i> Manajemen Produk
        </h3>

        <form method="GET" class="d-flex" style="max-width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari produk..." value="{{ request('search') }}">
            <button class="btn btn-sm btn-primary" type="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bx bx-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0">
            <h5 class="fw-semibold text-secondary mb-0">
                <i class="bx bx-list-ul text-primary"></i> Daftar Produk
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Produk</th>
                            <th>Seller</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="text-center" width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $index => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $product->foto ? asset('storage/' . $product->foto) : 'https://via.placeholder.com/50' }}" alt="{{ $product->nama_produk }}" width="40" height="40" class="rounded me-2">
                                        <div>
                                            <div class="fw-semibold">{{ Str::limit($product->nama_produk, 30) }}</div>
                                            <small class="text-muted">{{ Str::limit($product->deskripsi, 20) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->seller->nama_toko }}</td>
                                <td>{{ $product->category->nama_kategori }}</td>
                                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->stok > 10 ? 'success' : ($product->stok > 0 ? 'warning' : 'danger') }}">
                                        {{ $product->stok }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $product->status == 'aktif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $product->id }}">
                                        <i class='bx bx-show'></i>
                                    </button>

                                    <form action="{{ route('admin.products.toggle-status', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-{{ $product->status == 'aktif' ? 'warning' : 'success' }}">
                                            <i class='bx bx-{{ $product->status == 'aktif' ? 'hide' : 'show' }}'></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Detail --}}
                            <div class="modal fade" id="modalDetail{{ $product->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 text-center">
                                                    <img src="{{ $product->foto ? asset('storage/' . $product->foto) : 'https://via.placeholder.com/200' }}" alt="{{ $product->nama_produk }}" class="img-fluid rounded mb-3" style="max-height: 200px;">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="fw-bold">{{ $product->nama_produk }}</h5>
                                                    <p class="text-muted">{{ $product->deskripsi }}</p>
                                                    
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td><strong>Seller</strong></td>
                                                            <td>{{ $product->seller->nama_toko }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Kategori</strong></td>
                                                            <td>{{ $product->category->nama_kategori }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Harga</strong></td>
                                                            <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Stok</strong></td>
                                                            <td>{{ $product->stok }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Berat</strong></td>
                                                            <td>{{ $product->berat }} kg</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Status</strong></td>
                                                            <td>
                                                                <span class="badge bg-{{ $product->status == 'aktif' ? 'success' : 'secondary' }}">
                                                                    {{ ucfirst($product->status) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class='bx bx-box text-secondary' style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2">Belum ada produk yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection