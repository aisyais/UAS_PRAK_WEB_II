@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Kategori</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('wishlist-categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('wishlist-categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

<style>
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(270deg, #ffe4e6, #fff0f5);
    background-size: 400% 400%;
    animation: backgroundMove 15s ease infinite;
}

@keyframes backgroundMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 40px;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.text-center {
    text-align: center;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: left;
}

.mb-3 {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.btn-primary {
    background-color: #f472b6;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s, box-shadow 0.3s;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #ec4899;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.5);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s, box-shadow 0.3s;
    border: none;
    cursor: pointer;
}

.btn-secondary:hover {
    background-color: #5a6268;
    box-shadow: 0 4px 12px rgba(90, 98, 104, 0.5);
}
</style>
