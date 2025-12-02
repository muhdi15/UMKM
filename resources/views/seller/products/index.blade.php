@extends('seller.layout')

@section('title', 'Manajemen Produk')
@section('page-title', 'Daftar Produk')

@section('menu-products', 'active')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h5>Daftar Produk</h5>
    <a href="{{ route('seller.products.create') }}" class="btn btn-primary"><i class="fa fa-plus me-2"></i>Tambah Produk</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $index => $item)
                    <tr>
                        <td>{{ $produk->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{asset($item->foto)}}" width="50" height="50" class="rounded me-2" style="object-fit: cover;">
                                <div>{{ $item->nama_produk }}</div>
                            </div>
                        </td>
                        <td>{{ $item->category->nama_kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>
                            <span class="badge {{ $item->status=='aktif'?'bg-success':'bg-secondary' }}">{{ ucfirst($item->status) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('seller.products.edit', $item->id) }}" class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('seller.products.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        {{ $produk->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
