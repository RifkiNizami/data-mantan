@extends('layouts.app')

@section('title', 'Edit Mantan')

@section('content')
    <h3 class="mb-3">Edit Mantan</h3>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('mantan.update', $mantan) }}">
                @csrf
                @method('PUT')
                @include('mantan._form')

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('mantan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
