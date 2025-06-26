@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container col-md-6">
    <h3 class="mt-4">Daftar Akun</h3>
    <form method="POST" action="/register">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label>Pilih Peran</label>
            <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="dokter">Dokter</option>
                <option value="adopter">Adopter</option>
                <option value="pemberi">Pemberi Hibah</option>
            </select>
            @error('role') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-success">Daftar</button>
        <p class="mt-3">Sudah punya akun? <a href="/login">Login di sini</a></p>
    </form>
</div>
@endsection
