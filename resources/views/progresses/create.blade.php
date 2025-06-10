@extends('layouts.app')

@section('title', 'Tambah Progress')

@section('content')
<div class="card">
    <div class="card-header">
        Tambah Progress untuk: <strong>{{ $wishlistItem->title }}</strong>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('progresses.store', $wishlistItem) }}">
            @csrf
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="progress_date" class="form-label">Tanggal Progress</label>
                <input type="date" class="form-control @error('progress_date') is-invalid @enderror" id="progress_date" name="progress_date" value="{{ old('progress_date') }}" required>
                @error('progress_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
