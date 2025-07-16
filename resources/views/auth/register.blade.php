@extends('layouts.app')

@section('title', 'Register')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .register-container {
        background: #f0f8ff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 50, 0.1);
        margin-top: 50px;
    }

    .register-title {
        color: #001f3f;
        font-weight: bold;
    }

    .form-label {
        color: #001f3f;
        font-weight: 500;
    }

    .btn-navy {
        background-color: #001f3f;
        color: white;
        border: none;
    }

    .btn-navy:hover {
        background-color: #003366;
    }

    .text-link {
        color: #001f3f;
        text-decoration: underline;
    }
</style>

<div class="container d-flex justify-content-center">
    <div class="col-md-8 register-container">
        <h3 class="text-center register-title mb-4"><i class="bi bi-person-plus-fill me-2"></i>Daftar Akun Baru</h3>

        <form method="POST" action="/register" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" class="form-control">
                </div>
                @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                @error('phone') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                </div>
                @error('address') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Profil</label>
                <input type="file" name="photo" class="form-control">
                @error('photo') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Pilih Peran</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                    <select name="role" class="form-control">
                        <option value="dokter">Dokter</option>
                        <option value="adopter">Adopter</option>
                        <option value="pemberi">Pemberi Hibah</option>
                    </select>
                </div>
                @error('role') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="d-grid">
                <button class="btn btn-navy"><i class="bi bi-person-check me-1"></i> Daftar</button>
            </div>

            <p class="text-center mt-3">Sudah punya akun? <a href="/login" class="text-link">Login di sini</a></p>
        </form>
    </div>
</div>
@endsection
