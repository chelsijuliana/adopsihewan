@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<div class="container">
    <h2 class="mb-4">📚 Artikel Edukasi</h2>

    <div class="row">
        @foreach ($artikel as $a)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($a->foto)
                        <img src="{{ asset('storage/' . $a->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $a->judul }}</h5>
                        <a href="{{ route('artikel.show', $a->id) }}" class="btn btn-sm btn-primary">Lihat Artikel</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $artikel->links() }} {{-- Pagination --}}
</div>
@endsection
