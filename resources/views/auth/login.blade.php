@extends('layouts.app')

@section('title', 'Login')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .login-container {
        background: #f0f8ff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 50, 0.1);
        margin-top: 60px;
    }

    .login-title {
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

    .input-group-text {
        background-color: #e6f0ff;
        border: 1px solid #ced4da;
        color: #001f3f;
    }
</style>

<div class="container d-flex justify-content-center">
    <div class="col-md-6 login-container">
        <h3 class="text-center login-title mb-4"><i class="bi bi-box-arrow-in-right me-2"></i>Login ke Akun Anda</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
                @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>

            <div class="d-grid">
                <button class="btn btn-navy"><i class="bi bi-unlock me-1"></i> Login</button>
            </div>

            <p class="text-center mt-3">Belum punya akun? <a href="/register" class="text-link">Daftar di sini</a></p>
        </form>
    </div>
</div>
@endsection
