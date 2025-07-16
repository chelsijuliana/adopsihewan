@extends('layouts.app')

@section('title', 'Rekam Medis Hewan')

@section('content')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .page-title {
        color: #001f3f;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .table thead {
        background-color: #f0f8ff;
        color: #001f3f;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        text-align: left !important;
    }

    .table img {
        object-fit: cover;
    }
</style>

<div class="container">
    <h2 class="page-title"><i class="bi bi-file-medical me-2"></i>Rekam Medis Semua Hewan</h2>

    @if($rekam->isEmpty())
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-2"></i>Belum ada data rekam medis yang tersedia.
        </div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Hewan</th>
                    <th>Jenis</th>
                    <th>Ras</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Kondisi</th>
                    <th>Vaksinasi</th>
                    <th>Hasil Pemeriksaan</th>
                    <th>Dokter</th>
                    <th>Tanggal Pemeriksaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekam as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold text-primary">{{ $r->hewan->nama ?? '-' }}</td>
                        <td>{{ $r->hewan->jenis ?? '-' }}</td>
                        <td>{{ $r->hewan->ras ?? '-' }}</td>

                        @php
                            $usia = $r->hewan->usia ?? 0;
                            $usiaTahun = floor($usia / 12);
                            $usiaBulan = $usia % 12;
                        @endphp
                        <td>
                            @if ($usiaTahun > 0)
                                {{ $usiaTahun }} tahun
                            @endif
                            @if ($usiaBulan > 0)
                                {{ $usiaBulan }} bulan
                            @endif
                            @if ($usiaTahun == 0 && $usiaBulan == 0)
                                -
                            @endif
                        </td>

                        <td>{{ ucfirst($r->hewan->jenis_kelamin ?? '-') }}</td>
                        <td>{{ $r->kondisi ?? '-' }}</td>
                        <td>{{ $r->vaksinasi ?? '-' }}</td>

                        <td>
                            @if($r->file_hasil)
                                <a href="{{ asset('storage/' . $r->file_hasil) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $r->file_hasil) }}" alt="Hasil" width="80" height="80" class="rounded shadow-sm">
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        <td>{{ $r->dokter->name ?? '-' }}</td>
                        <td>{{ $r->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
