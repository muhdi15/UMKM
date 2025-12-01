@extends('seller.layout')
@section('title', 'Laporan Stok Produk')
@section('page-title', 'Laporan Stok Produk')
@section('menu-reports', 'active')

@section('content')
<div class="card p-4">
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->stok }}</td>
                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($product->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
