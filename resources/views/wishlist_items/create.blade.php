@extends('layouts.app')

@section('title', 'Tambah Wishlist Item')

@section('content')
<div class="background-container">
    <div class="content-wrapper">
        <h1 class="main-title">Tambah Wishlist Item</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wishlist-items.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Masukkan judul item" required>
            </div>

            <div class="mb-3">
                <label for="wishlist_category_id" class="form-label">Kategori</label>
                <select name="wishlist_category_id" id="wishlist_category_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('wishlist_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Masukkan deskripsi item">{{ old('description') }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-pink">Simpan</button>
                <a href="{{ route('wishlist-items.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<style>
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(270deg, #ffe4e6, #ffc0cb);
    background-size: 400% 400%;
    animation: backgroundMove 15s ease infinite;
}

@keyframes backgroundMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.background-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

.content-wrapper {
    background: rgba(255, 240, 245, 0.9);
    backdrop-filter: blur(10px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    text-align: center;
}

.main-title {
    font-size: 28px;
    color: #d63384;
    margin-bottom: 30px;
    animation: fadeIn 1s ease forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.alert {
    background: #f8d7da;
    color: #842029;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.form-label {
    font-weight: bold;
    color: #555;
}

.form-control {
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control:focus {
    border-color: #ff7eb9;
    box-shadow: 0 0 5px #ffb6c1;
    outline: none;
}

.btn-pink {
    background-color: #f472b6;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.3s;
    border: none;
}

.btn-pink:hover {
    background-color: #ec4899;
    transform: scale(1.05);
}

.btn-secondary {
    background-color: #e0e0e0;
    color: #555;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.3s;
    border: none;
}

.btn-secondary:hover {
    background-color: #d6d6d6;
    transform: scale(1.05);
}
</style>
@endsection
