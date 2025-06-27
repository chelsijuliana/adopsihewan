@extends('layouts.app')

@section('title', 'Hewan Saya')

@section('content')
<div class="container">
    <h2>🐾 Daftar Hewan Saya</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="/pemberi/hewan/tambah" class="btn btn-primary mb-3">+ Tambah Hewan</a>

    <div class="row">
        @foreach ($hewan as $h)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <img src="{{ asset('storage/' . $h->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $h->nama }} ({{ $h->jenis_kelamin }})</h5>
                    <p class="card-text">{{ $h->jenis }} - {{ $h->ras }}</p>
                    <p class="text-muted">Usia: {{ $h->usia }} tahun</p>
                    
                    <div class="d-flex justify-content-between">
                        <a href="/pemberi/hewan/edit/{{ $h->id }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/pemberi/hewan/delete/{{ $h->id }}" method="POST" onsubmit="return confirm('Hapus hewan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
