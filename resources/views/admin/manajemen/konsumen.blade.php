@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">
            <i class="bx bxs-user text-primary"></i> Manajemen Konsumen
        </h3>

        <form method="GET" class="d-flex" style="max-width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari konsumen..." value="{{ request('search') }}">
            <button class="btn btn-sm btn-primary" type="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bx bx-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0">
            <h5 class="fw-semibold text-secondary mb-0">
                <i class="bx bx-list-ul text-primary"></i> Daftar Konsumen
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Total Order</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $index => $customer)
                            <tr>
                                <td>{{ $customers->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="{{ $customer->name }}" width="35" height="35" class="rounded-circle me-2">
                                        <div>
                                            <div class="fw-semibold">{{ $customer->name }}</div>
                                            <small class="text-muted">ID: {{ $customer->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $customer->status == 'accepted' ? 'success' : ($customer->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($customer->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $customer->orders_count }} order</span>
                                </td>
                                <td>{{ $customer->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $customer->id }}">
                                        <i class='bx bx-show'></i>
                                    </button>

                                    @if($customer->status == 'pending')
                                        <form action="{{ route('admin.konsumen.approve', $customer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class='bx bx-check'></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.konsumen.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus konsumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class='bx bx-user text-secondary' style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2">Belum ada konsumen yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $customers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Modal Details - DI LUAR CARD DAN LOOP --}}
@foreach($customers as $customer)
<div class="modal fade" id="modalDetail{{ $customer->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $customer->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Konsumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4 text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="{{ $customer->name }}" width="80" height="80" class="rounded-circle mb-3">
                        <h6 class="fw-bold">{{ $customer->name }}</h6>
                    </div>
                    <div class="col-8">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    <span class="badge bg-{{ $customer->status == 'accepted' ? 'success' : ($customer->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($customer->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total Order</strong></td>
                                <td>{{ $customer->orders_count }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Review</strong></td>
                                <td>{{ $customer->reviews_count }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terdaftar</strong></td>
                                <td>{{ $customer->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection