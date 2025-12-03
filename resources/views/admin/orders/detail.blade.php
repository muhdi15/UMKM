@extends('admin.layout')

@section('content')
<div class="container py-4">

    <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary mb-3">
        <i class="bx bx-arrow-back"></i> Kembali
    </a>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-0 py-3 px-4">
            <h5 class="fw-bold mb-0">Detail Pesanan #{{ $order->id }}</h5>
        </div>

        <div class="card-body px-4">

            {{-- Informasi Pesanan --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="fw-bold text-secondary">Informasi Pembeli</h6>
                    <p class="mb-1"><strong>Nama:</strong> {{ $order->user->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ $order->alamat_pengiriman }}</p>
                </div>

                <div class="col-md-6">
                    <h6 class="fw-bold text-secondary">Informasi Toko</h6>
                    <p class="mb-1"><strong>Toko:</strong> {{ $order->seller->nama_toko }}</p>
                    <p class="mb-1"><strong>Pemilik:</strong> {{ $order->seller->user->name }}</p>
                </div>
            </div>

            {{-- Produk --}}
            <h6 class="fw-bold text-secondary mb-3">Daftar Produk</h6>

            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($order->details as $detail)
                    <tr>
                        <td>{{ $detail->product->nama_produk }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-end mt-3">
                <h5>Total: 
                    <span class="text-primary">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </span>
                </h5>
            </div>

        </div>
    </div>

</div>
@endsection
