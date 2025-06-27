@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h2>📊 Dashboard Admin</h2>
    <p>Selamat datang, Admin! Di sini kamu bisa melihat ringkasan sistem adopsi.</p>

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Pengguna</h5>
                    <p class="card-text">🧑‍🤝‍🧑</p>
                    <a href="#" class="btn btn-outline-primary btn-sm disabled">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Hewan</h5>
                    <p class="card-text">🐾</p>
                    <a href="#" class="btn btn-outline-primary btn-sm disabled">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center">
                <div class="card-body">
                    <h5 class="card-title">Adopsi</h5>
                    <p class="card-text">📋</p>
                    <a href="#" class="btn btn-outline-primary btn-sm disabled">Lihat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
