@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container col-md-4">
    <h3 class="mt-4">Login</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="/login">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary">Login</button>
        <p class="mt-3">Belum punya akun? <a href="/register">Daftar di sini</a></p>
    </form>
</div>
@endsection
