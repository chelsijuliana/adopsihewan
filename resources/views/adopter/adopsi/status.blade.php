@extends('layouts.app')

@section('title', 'Status Adopsi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📋 Status Permintaan Adopsi Saya</h2>

    @forelse ($permintaan as $req)
        <div class="card mb-4 shadow border-0">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $req->hewan->foto) }}"
                         class="img-fluid rounded-start"
                         style="height: 100%; object-fit: cover;"
                         alt="Foto {{ $req->hewan->nama }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="fw-bold text-primary mb-3">
                            <i class="bi bi-paw-fill me-2"></i>{{ $req->hewan->nama }}
                        </h4>

                        <ul class="list-unstyled mb-3">
                            <li><i class="bi bi-bookmark-heart me-2 text-secondary"></i><strong>Jenis:</strong> {{ $req->hewan->jenis }}</li>
                            <li><i class="bi bi-tags me-2 text-secondary"></i><strong>Ras:</strong> {{ $req->hewan->ras ?? '-' }}</li>
                            <li><i class="bi bi-calendar2-week me-2 text-secondary"></i><strong>Usia:</strong>
                                @php $usiaTotal = $req->hewan->usia; @endphp
                                {{ $usiaTotal >= 12 ? floor($usiaTotal / 12) . ' tahun' : $usiaTotal . ' bulan' }}
                            </li>
                            <li><i class="bi bi-gender-ambiguous me-2 text-secondary"></i><strong>Jenis Kelamin:</strong> {{ ucfirst($req->hewan->jenis_kelamin) }}</li>
                        </ul>

                        <hr>

                        <p><i class="bi bi-chat-dots me-2 text-secondary"></i><strong>Alasan Adopsi:</strong><br>{{ $req->alasan }}</p>
                        <p><i class="bi bi-heart-pulse me-2 text-secondary"></i><strong>Pengalaman:</strong><br>{{ $req->pengalaman ?? '-' }}</p>

                        @php
                            [$label, $cls] = match($req->status) {
                                'menunggu'  => ['Menunggu', 'warning text-dark'],
                                'disetujui' => ['Disetujui', 'success'],
                                'ditolak'   => ['Ditolak', 'danger'],
                                default     => ['Tidak Diketahui', 'secondary'],
                            };
                        @endphp

                        <p class="mt-3">
                            <i class="bi bi-info-circle me-2 text-secondary"></i><strong>Status:</strong>
                            <span class="badge bg-{{ $cls }} px-3 py-2">{{ $label }}</span>
                        </p>

                        @if ($req->status === 'menunggu')
                            <form action="{{ route('adopter.adopsi.batalkan', $req->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2">
                                    <i class="bi bi-x-circle"></i> Batalkan Pengajuan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada permintaan adopsi yang diajukan.</div>
    @endforelse
</div>
@endsection
