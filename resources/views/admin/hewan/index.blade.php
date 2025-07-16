@extends('layouts.app')

@section('title', 'Data Hewan Adopsi')

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
        background-color: #e6f0ff;
        color: #001f3f;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .table img {
        border-radius: 8px;
        object-fit: cover;
    }

    .badge-success {
        background-color: #4caf50 !important;
    }

    .badge-secondary {
        background-color: #6c757d !important;
    }
</style>

<div class="container">
    <h2 class="page-title"><i class="bi bi-list-ul me-2"></i>Daftar Hewan Open Adopsi</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Ras</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Pemberi</th>
                    <th>Dokter</th>
                    <th>Lepas Adopsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hewan as $h)
                <tr>
                    <td>{{ $h->id }}</td>
                    <td class="fw-semibold text-primary">{{ $h->nama }}</td>
                    <td>{{ $h->jenis }}</td>
                    <td>{{ $h->ras }}</td>
                    <td>
                        @php
                            $tahun = floor($h->usia / 12);
                            $bulan = $h->usia % 12;
                            $usiaText = '';
                            if ($tahun > 0) $usiaText .= $tahun . ' tahun ';
                            if ($bulan > 0) $usiaText .= $bulan . ' bulan';
                        @endphp
                        {{ $usiaText ?: '0 bulan' }}
                    </td>
                    <td>{{ ucfirst($h->jenis_kelamin) }}</td>
                    <td class="text-start">{{ $h->deskripsi }}</td>
                    <td>
                        @if($h->foto)
                            <img src="{{ asset('storage/' . $h->foto) }}" width="60" height="60">
                        @else
                            <em class="text-muted">Tidak ada</em>
                        @endif
                    </td>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($h->status) }}</span></td>
                    <td>{{ $h->pemberi->name ?? '-' }}</td>
                    <td>{{ optional(optional($h->rekamMedis->last())->dokter)->name ?? '-' }}</td>
                    <td>
                        @php
                            $sudahLepas = $h->adoptionRequests
                                ->where('status', 'disetujui')
                                ->isNotEmpty();
                        @endphp
                        <span class="badge bg-{{ $sudahLepas ? 'success' : 'secondary' }}">
                            {{ $sudahLepas ? 'Sudah Lepas Adopsi' : 'Belum Lepas Adopsi' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
