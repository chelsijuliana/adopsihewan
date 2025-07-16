@extends('layouts.app')

@section('title', 'Pengajuan Adopsi')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pengajuan Adopsi Hewan Anda</h2>

    @forelse ($pengajuan as $req)
        <div class="card mb-4 shadow-sm border-start border-4 border-primary">
            <div class="card-body">
                <h5 class="fw-bold mb-2"><i class="bi bi-paw text-primary me-1"></i>{{ $req->hewan->nama }}</h5>

                <p class="mb-1">
                    <i class="bi bi-tag-fill text-secondary me-1"></i>
                    <strong>Jenis:</strong> {{ $req->hewan->jenis }} |
                    <strong>Ras:</strong> {{ $req->hewan->ras ?? '-' }}
                </p>

                <p class="mb-1">
                    <i class="bi bi-person-fill text-info me-1"></i>
                    <strong>Pengaju:</strong> {{ $req->adopter->name }}
                </p>

                <p class="mb-1">
                    <i class="bi bi-chat-left-dots-fill text-warning me-1"></i>
                    <strong>Alasan Adopsi:</strong><br>
                    <span class="text-muted">{{ $req->alasan }}</span>
                </p>

                <p class="mb-3">
                    <i class="bi bi-journal-text text-success me-1"></i>
                    <strong>Pengalaman:</strong><br>
                    <span class="text-muted">{{ $req->pengalaman }}</span>
                </p>

                <p class="mb-3">
                    <i class="bi bi-clipboard-check text-dark me-1"></i>
                    <strong>Status Saat Ini:</strong> 
                    <span class="badge 
                        {{ 
                            $req->status === 'menunggu' ? 'bg-warning text-dark' : 
                            ($req->status === 'disetujui' ? 'bg-success' : 'bg-danger') 
                        }}">
                        {{ ucfirst($req->status) }}
                    </span>
                </p>

                @if ($req->status === 'menunggu')
                <div class="d-flex gap-2">
                    <form action="{{ route('pemberi.adopsi.setujui', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-check-circle me-1"></i>Setujui
                        </button>
                    </form>

                    <form action="{{ route('pemberi.adopsi.tolak', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-x-circle me-1"></i>Tolak
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill me-2"></i>
            Belum ada pengajuan adopsi dari adopter.
        </div>
    @endforelse
</div>
@endsection
