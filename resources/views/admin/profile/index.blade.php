@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 text-center">
                    <h5 class="fw-bold mb-0 text-primary"><i class='bx bxs-user-circle'></i> Profil Admin</h5>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm">
                            <i class="bx bx-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <img src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" 
                                 class="rounded-circle border shadow-sm" width="120" height="120" style="object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password <small class="text-muted">(biarkan kosong jika tidak ingin mengganti)</small></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class='bx bx-save'></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
    