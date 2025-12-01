@extends('seller.layout')
@section('title', 'Laporan Penjualan Bulanan')
@section('page-title', 'Laporan Penjualan Bulanan')
@section('menu-reports', 'active')

@section('content')
<div class="card p-4">
    <h5>Total Pesanan: {{ $totalPesanan }}</h5>
    <h5>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Kode Order</th>
                <th>Pembeli</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Status Order</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $order)
            <tr>
                <td>{{ $order->kode_order }}</td>
                <td>{{ $order->user->name }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($order->status_pembayaran) }}</td>
                <td>{{ ucfirst($order->status_order) }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data penjualan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
