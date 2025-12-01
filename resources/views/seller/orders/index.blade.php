@extends('seller.layout')

@section('title', 'Pesanan')
@section('page-title', 'Daftar Pesanan')
@section('menu-orders', 'active')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Order</th>
                    <th>Pembeli</th>
                    <th>Total Harga</th>
                    <th>Status Order</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->kode_order }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if($order->status_order == 'diproses') bg-primary
                            @elseif($order->status_order == 'dikirim') bg-warning
                            @elseif($order->status_order == 'selesai') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($order->status_order) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge 
                            @if($order->status_pembayaran == 'pending') bg-secondary
                            @elseif($order->status_pembayaran == 'dibayar') bg-success
                            @else bg-danger
                            @endif">
                            {{ ucfirst($order->status_pembayaran) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('seller.orders.detail', $order->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
