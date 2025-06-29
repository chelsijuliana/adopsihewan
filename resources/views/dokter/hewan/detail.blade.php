@extends('layouts.app')

@section('title', 'Rekam Medis ' . $hewan->nama)

@section('content')
<div class="container">
    <h2 class="mb-3">🩺 Rekam Medis - {{ $hewan->nama }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <form action="{{ route('dokter.rekam-medis.store', $hewan->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Diagnosa</label>
                <input type="text" name="diagnosa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tindakan</label>
                <input type="text" name="tindakan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Catatan Tambahan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Simpan Rekam Medis</button>
        </form>
    </div>

    <hr>

    <h4 class="mt-4">📋 Riwayat Rekam Medis</h4>
    @forelse ($rekamMedis as $rekam)
        <div class="border p-3 mb-3 rounded shadow-sm">
            <p><strong>Tanggal:</strong> {{ $rekam->created_at->format('d M Y') }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekam->diagnosa }}</p>
            <p><strong>Tindakan:</strong> {{ $rekam->tindakan }}</p>
            <p><strong>Catatan:</strong> {{ $rekam->catatan ?: '-' }}</p>
        </div>
    @empty
        <p class="text-muted">Belum ada rekam medis.</p>
    @endforelse
</div>
@endsection
