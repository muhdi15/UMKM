@extends('seller.layout')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('menu-products', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 row">
                <div class="col-md-4">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" step="0.01" name="berat" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Produk</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="text-end">
                <button class="btn btn-primary"><i class="fa fa-save me-2"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
