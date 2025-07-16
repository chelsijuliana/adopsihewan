@extends('layouts.app')

@section('title', 'Detail Hewan')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🐾 Detail Hewan</h2>

    <div class="row g-4">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $hewan->foto) }}" class="img-fluid rounded shadow" alt="Foto Hewan">
        </div>

        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-start"><i class="bi bi-paw"></i> Nama</th>
                            <td class="text-start fw-bold">{{ $hewan->nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-tags"></i> Jenis</th>
                            <td class="text-start">{{ $hewan->jenis }}</td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-shield"></i> Ras</th>
                            <td class="text-start">{{ $hewan->ras ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-calendar-heart"></i> Usia</th>
                            <td class="text-start">
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
                                @if ($usiaTahun == 0 && $usiaBulan == 0)
                                    0 bulan
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-gender-ambiguous"></i> Jenis Kelamin</th>
                            <td class="text-start">{{ ucfirst($hewan->jenis_kelamin) }}</td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-chat-text"></i> Deskripsi</th>
                            <td class="text-start">{{ $hewan->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-check-circle"></i> Status</th>
                            <td class="text-start">
                                <span class="badge bg-{{ 
                                    $hewan->status == 'menunggu' ? 'warning text-dark' :
                                    ($hewan->status == 'diverifikasi' ? 'primary' :
                                    ($hewan->status == 'siap' ? 'success' : 'danger')) }}">
                                    {{ ucfirst($hewan->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start"><i class="bi bi-person-heart"></i> Pemberi Hibah</th>
                            <td class="text-start">{{ $hewan->pemberi->name ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('adopter.hewan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('adopter.rekam-medis.lihat', $hewan->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-journal-medical"></i> Lihat Rekam Medis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
