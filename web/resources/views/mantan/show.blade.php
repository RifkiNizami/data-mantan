@extends('layouts.app')

@section('title', 'Detail Mantan')

@section('content')
    <h3 class="mb-3">Detail Mantan</h3>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $mantan->id }}</dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $mantan->nama }}</dd>

                <dt class="col-sm-3">No. HP</dt>
                <dd class="col-sm-9">{{ $mantan->no_hp }}</dd>

                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">{{ $mantan->alamat ?: '-' }}</dd>

                <dt class="col-sm-3">Makanan Favorit</dt>
                <dd class="col-sm-9">
                    @if($mantan->makanan_favorit)
                        <span class="badge bg-info text-dark fs-6">🍲 {{ $mantan->makanan_favorit }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </dd>
            </dl>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('mantan.edit', $mantan) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('mantan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
