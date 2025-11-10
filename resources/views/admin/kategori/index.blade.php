@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">
            <i class="bx bxs-category text-primary"></i> Manajemen Kategori
        </h3>

        <form method="GET" class="d-flex" style="max-width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari kategori..." value="{{ request('search') }}">
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
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold text-secondary mb-0">
                <i class="bx bx-list-ul text-primary"></i> Daftar Kategori
            </h5>

            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class='bx bx-plus'></i> Tambah Kategori
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Dibuat</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $index => $item)
                            <tr>
                                <td>{{ $kategori->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $item->nama_kategori }}</td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                        <i class='bx bx-edit'></i>
                                    </button>

                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('kategori.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Kategori</label>
                                                    <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $item->nama_kategori) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="2">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class='bx bx-category text-secondary' style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2">Belum ada kategori yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $kategori->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan nama kategori" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2" placeholder="Deskripsi kategori (opsional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
