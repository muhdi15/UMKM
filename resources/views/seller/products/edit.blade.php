@extends('seller.layout')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('menu-products', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $product->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 row">
                <div class="col-md-4">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $product->stok }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" step="0.01" name="berat" class="form-control" value="{{ $product->berat }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Produk</label>
                <input type="file" name="foto" class="form-control">
                @if($product->foto)
                    <img src="{{ $product->foto }}" width="100" class="mt-2" style="object-fit: cover;">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="aktif" {{ $product->status=='aktif'?'selected':'' }}>Aktif</option>
                    <option value="nonaktif" {{ $product->status=='nonaktif'?'selected':'' }}>Nonaktif</option>
                </select>
            </div>

            <div class="text-end">
                <button class="btn btn-primary"><i class="fa fa-save me-2"></i>Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
