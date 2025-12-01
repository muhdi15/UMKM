@extends('seller.layout')

@section('title', 'Profil Toko')
@section('page-title', 'Profil Toko')

@section('menu-profile', 'active')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="mb-4 fw-bold">Informasi Toko</h4>

                <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- FOTO TOKO -->
                    <div class="text-center mb-4">
                        <img src="{{ asset($seller->foto_toko ?? 'https://via.placeholder.com/150') }}"
                             class="rounded-circle shadow"
                             width="120" height="120" style="object-fit: cover;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Toko</label>
                        <input type="file" name="foto_toko" class="form-control">
                        @error('foto_toko')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- NAMA TOKO -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Toko</label>
                        <input type="text" class="form-control" name="nama_toko" value="{{ $seller->nama_toko }}" required>
                        @error('nama_toko')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ $seller->deskripsi }}</textarea>
                        @error('deskripsi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ $seller->alamat }}" required>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- TELEPON -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Telepon</label>
                        <input type="text" class="form-control" name="telepon" value="{{ $seller->no_telp }}" required>
                        @error('telepon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary px-4">
                            <i class="fa fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>

@endsection
