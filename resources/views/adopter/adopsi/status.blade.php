@extends('layouts.app')

@section('title', 'Status Adopsi')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Status Permintaan Adopsi Saya</h2>

    @forelse ($permintaan as $req)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $req->hewan->foto) }}" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $req->hewan->nama }} ({{ $req->hewan->jenis_kelamin }})</h5>
                        <p><strong>Jenis:</strong> {{ $req->hewan->jenis }} - {{ $req->hewan->ras }}</p>
                        <p><strong>Alasan:</strong><br> {{ $req->alasan }}</p>
                        <p><strong>Pengalaman:</strong><br> {{ $req->pengalaman ?? '-' }}</p>
                        <p><strong>Status:</strong>
                            @if ($req->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif ($req->status == 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada permintaan adopsi yang diajukan.</p>
    @endforelse
</div>
@endsection
