@extends('seller.layout')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')
@section('menu-orders', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h5>Kode Order: {{ $order->kode_order }}</h5>
        <p>Pembeli: {{ $order->user->name }}</p>
        <p>Alamat: {{ $order->alamat_pengiriman }}</p>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $item)
                <tr>
                    <td>{{ $item->product->nama_produk ?? '-' }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <form action="{{ route('seller.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Update Status Order</label>
                    <select name="status_order" class="form-select">
                        <option value="diproses" @if($order->status_order=='diproses') selected @endif>Diproses</option>
                        <option value="dikirim" @if($order->status_order=='dikirim') selected @endif>Dikirim</option>
                        <option value="selesai" @if($order->status_order=='selesai') selected @endif>Selesai</option>
                        <option value="dibatalkan" @if($order->status_order=='dibatalkan') selected @endif>Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-save me-2"></i>Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection
