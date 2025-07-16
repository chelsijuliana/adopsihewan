@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .edit-container {
        background-color: #f0f8ff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .form-label {
        color: #001f3f;
        font-weight: 500;
    }

    .form-control:focus {
        border-color: #4a70a7;
        box-shadow: 0 0 0 0.2rem rgba(74, 112, 167, 0.25);
    }

    .btn-navy {
        background-color: #001f3f;
        color: white;
        border: none;
    }

    .btn-navy:hover {
        background-color: #003366;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #001f3f;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #bbb;
    }

    .page-title {
        color: #001f3f;
        font-weight: bold;
        margin-bottom: 25px;
    }
</style>

<div class="container col-md-8">
    <div class="edit-container">
        <h3 class="page-title"><i class="bi bi-pencil-square me-2"></i>Edit Data Pengguna</h3>

        <form method="POST" action="{{ route('admin.pengguna.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="dokter" {{ $user->role === 'dokter' ? 'selected' : '' }}>Dokter</option>
                    <option value="adopter" {{ $user->role === 'adopter' ? 'selected' : '' }}>Adopter</option>
                    <option value="pemberi" {{ $user->role === 'pemberi' ? 'selected' : '' }}>Pemberi Hibah</option>
                </select>
                @error('role') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto (opsional)</label><br>
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto" width="80" class="mb-2 rounded shadow-sm">
                @endif
                <input type="file" name="photo" class="form-control">
                @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Password (opsional, isi jika ingin ubah)</label>
                <input type="text" name="password" class="form-control">
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <button class="btn btn-navy">
                    <i class="bi bi-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
