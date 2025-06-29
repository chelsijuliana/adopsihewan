@extends('layouts.app')

@section('title', 'Rekam Medis Hewan')

@section('content')
<div class="container">
    <h2>🩺 Rekam Medis Semua Hewan</h2>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Hewan</th>
                <th>Dokter</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekam as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r->hewan->nama ?? '-' }}</td>
                <td>{{ $r->dokter->name ?? '-' }}</td>
                <td>{{ $r->diagnosa }}</td>
                <td>{{ $r->tindakan }}</td>
                <td>{{ $r->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
