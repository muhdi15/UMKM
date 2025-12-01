@extends('seller.layout')
@section('title', 'Laporan Pembayaran')
@section('page-title', 'Laporan Pembayaran')
@section('menu-reports', 'active')

@section('content')
<div class="card p-4">
    <table class="table">
        <thead>
            <tr>
                <th>Kode Order</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>{{ $payment->order->kode_order }}</td>
                <td>{{ strtoupper($payment->metode) }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>{{ $payment->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada pembayaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
