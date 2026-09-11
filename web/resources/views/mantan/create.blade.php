@extends('layouts.app')

@section('title', 'Tambah Mantan')

@section('content')
    <h3 class="mb-3">Tambah Mantan</h3>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('mantan.store') }}">
                @csrf
                @include('mantan._form')

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mantan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
