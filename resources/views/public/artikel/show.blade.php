@extends('layouts.app')

@section('title', $a->judul)

@section('content')
<div class="container">
    <a href="{{ route('artikel.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <h2>{{ $a->judul }}</h2>
    <p class="text-muted">Diposting pada {{ $a->created_at->format('d M Y') }}</p>

    @if ($a->foto)
        <img src="{{ asset('storage/' . $a->foto) }}" class="img-fluid mb-3" style="max-height: 400px; object-fit: cover;">
    @endif

    <div>{!! nl2br(e($a->konten)) !!}</div>
</div>
@endsection
