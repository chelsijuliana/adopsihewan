@extends('layouts.app')

@section('title', 'Detail Hewan')

@section('content')
<div class="container" style="background-color: #f0f8ff; padding: 25px; border-radius: 15px;">
    <h2 class="mb-4">Detail Hewan</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mt-3">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $hewan->foto) }}" class="img-fluid rounded shadow" alt="Foto Hewan">
        </div>
        <div class="col-md-7">
            <table class="table table-borderless">
                <tr>
                    <th><i class="bi bi-patch-question-fill text-primary me-1"></i>Nama</th>
                    <td><strong>{{ $hewan->nama }}</strong></td>
                </tr>
                <tr>
                    <th><i class="bi bi-tag-fill text-secondary me-1"></i>Jenis</th>
                    <td>{{ $hewan->jenis }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-bezier text-secondary me-1"></i>Ras</th>
                    <td>{{ $hewan->ras ?? '-' }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-hourglass-split text-secondary me-1"></i>Usia</th>
                    <td>
                        @php
                            $usiaTahun = floor($hewan->usia / 12);
                            $usiaBulan = $hewan->usia % 12;
                        @endphp
                        @if ($usiaTahun > 0)
                            {{ $usiaTahun }} tahun
                        @endif
                        @if ($usiaBulan > 0)
                            {{ $usiaBulan }} bulan
                        @endif
                    </td>
                </tr>
                <tr>
                    <th><i class="bi bi-gender-ambiguous text-secondary me-1"></i>Jenis Kelamin</th>
                    <td>{{ ucfirst($hewan->jenis_kelamin) }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-chat-left-text-fill text-secondary me-1"></i>Deskripsi</th>
                    <td>{{ $hewan->deskripsi ?? '-' }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-info-circle-fill text-secondary me-1"></i>Status</th>
                    <td>
                        @php
                            $badgeClass = match($hewan->status) {
                                'menunggu' => 'warning text-dark',
                                'diverifikasi' => 'primary',
                                'siap' => 'success',
                                'diadopsi' => 'danger',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($hewan->status) }}</span>
                    </td>
                </tr>
            </table>

            <!-- Form Ubah Status -->
            <form action="{{ route('dokter.hewan.ubah-status', $hewan->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="status" class="form-label fw-semibold"><i class="bi bi-pencil-square me-1"></i>Ubah Status Hewan:</label>
                    <select name="status" class="form-select w-50" required>
                        <option value="menunggu" {{ $hewan->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diverifikasi" {{ $hewan->status === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                        <option value="siap" {{ $hewan->status === 'siap' ? 'selected' : '' }}>Siap</option>
                        <option value="diadopsi" {{ $hewan->status === 'diadopsi' ? 'selected' : '' }}>Diadopsi</option>
                    </select>
                </div>
                <button class="btn btn-outline-primary"><i class="bi bi-check2-square me-1"></i>Update Status</button>
            </form>

            <a href="{{ route('dokter.hewan.index') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left-circle me-1"></i>Kembali</a>
        </div>
    </div>
</div>
@endsection
