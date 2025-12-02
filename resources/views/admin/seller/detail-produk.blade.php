@extends('admin.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Detail Produk</h3>
        <a href="{{route('produk')}}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm p-3">
        <div class="row">

            <!-- FOTO PRODUK -->
            <div class="col-md-4 text-center mb-3">
                <div class="border rounded p-2 bg-light">
                    @if($product->foto)
                        <img src="{{ asset($product->foto) }}" class="img-fluid rounded" 
                             style="max-height: 280px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded" 
                             style="max-height: 280px; object-fit: cover;">
                    @endif
                </div>
            </div>

            <!-- DETAIL PRODUK -->
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body">

                        <h4 class="fw-bold">{{ $product->nama_produk }}</h4>
                        <p class="text-muted mb-3">
                            Kategori: <strong>{{ $product->category->nama_kategori ?? '-' }}</strong>
                        </p>

                        <div class="mb-3">
                            <h6 class="fw-bold">Deskripsi Produk</h6>
                            <div class="p-3 bg-light rounded" style="min-height: 100px;">
                                {!! nl2br(e($product->deskripsi)) !!}
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold">Harga</h6>
                                <p class="fs-5 text-primary fw-bold">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold">Stok</h6>
                                <p class="fw-semibold">{{ $product->stok }} Unit</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold">Berat</h6>
                                <p>{{ $product->berat ? $product->berat . ' gram' : 'Tidak dicantumkan' }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold">Status</h6>
                                @if($product->status == 'aktif')
                                    <span class="badge bg-success px-3 py-2">Aktif</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">Nonaktif</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
