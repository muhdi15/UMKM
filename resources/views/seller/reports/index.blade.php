@extends('seller.layout')
@section('title', 'Laporan')
@section('page-title', 'Dashboard Laporan')
@section('menu-reports', 'active')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row g-4">

    <!-- Card Ringkasan -->
    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-primary">
            <h6 class="text-muted">Pendapatan Bulan Ini</h6>
            <h3 class="fw-bold text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <p class="text-muted small mt-1"><i class="fa fa-arrow-up text-success"></i> Stabil dari bulan lalu</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-info">
            <h6 class="text-muted">Total Pesanan</h6>
            <h3 class="fw-bold">{{ $totalPesanan }}</h3>
            <p class="text-muted small mt-1"><i class="fa fa-clock"></i> Update realtime</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-warning">
            <h6 class="text-muted">Produk Terlaris</h6>
            <h3 class="fw-bold">{{ $topProducts->first()->nama_produk ?? '-' }}</h3>
            <p class="text-muted small mt-1"><i class="fa fa-star text-warning"></i> Top 5 produk</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-danger">
            <h6 class="text-muted">Produk Habis / Stok Rendah</h6>
            <h3 class="fw-bold">{{ $lowStockCount ?? 0 }}</h3>
            <p class="text-muted small mt-1"><i class="fa fa-exclamation-triangle text-danger"></i> Perlu restock</p>
        </div>
    </div>

</div>

<!-- Chart Penjualan -->
<div class="mt-4 card shadow-sm border-0">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-3">Grafik Penjualan 6 Bulan Terakhir</h5>
        <canvas id="salesChart" height="120"></canvas>
    </div>
</div>

<div class="row mt-4">

    <!-- Top Produk -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title fw-bold mb-3">Top 5 Produk Terlaris</h5>
                <ul class="list-group list-group-flush">
                    @forelse($topProducts as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $product->nama_produk }}
                            <span class="badge bg-primary rounded-pill">{{ $product->total_terjual }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center">Tidak ada produk terlaris</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Laporan Cepat -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title fw-bold mb-3">Akses Cepat Laporan</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('seller.reports.sales') }}" class="btn btn-outline-primary">Laporan Penjualan</a>
                    <a href="{{ route('seller.reports.stock') }}" class="btn btn-outline-success">Laporan Stok Produk</a>
                    <a href="{{ route('seller.reports.payments') }}" class="btn btn-outline-warning">Laporan Pembayaran</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($monthlyLabels), // ["Jan", "Feb", ...]
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json($monthlySales), // [1000000, 2000000, ...]
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString(); } }
                }
            }
        }
    });
</script>
@endpush
