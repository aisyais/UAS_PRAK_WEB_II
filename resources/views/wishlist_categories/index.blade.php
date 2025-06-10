@extends('layouts.app')

@section('content')
<div class="background-container">
    <div class="content-wrapper">
        <h1 class="main-title">Daftar Kategori Wishlist</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="button-wrapper text-end">
            <a href="{{ route('wishlist-categories.create') }}" class="btn btn-pink">+ Tambah Kategori</a>
        </div>

        @if ($categories->isEmpty())
            <div class="empty-state">
                Belum ada kategori wishlist. Yuk tambahkan!
            </div>
        @else
            <div class="card-grid">
                @foreach ($categories as $category)
                    <div class="card">
                        <div class="icon-circle">
                            <div class="icon">&#9776;</div>
                        </div>
                        <div class="card-title">{{ $category->name }}</div>
                        <div class="card-actions">
                            <a href="{{ route('wishlist-categories.edit', $category) }}" class="btn btn-sm btn-pink">Edit</a>
                            <form action="{{ route('wishlist-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="footer-links mt-4">
            <a href="/wishlist-items" class="link">Ke Wishlist Item</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="link">Logout</button>
            </form>
        </div>
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
    max-width: 900px;
    text-align: center;
}

.main-title {
    font-size: 32px;
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

.button-wrapper {
    margin-bottom: 20px;
}

.btn-pink {
    background-color: #f472b6;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s;
    border: none;
}

.btn-pink:hover {
    background-color: #ec4899;
}

.empty-state {
    margin-top: 50px;
    color: #666;
    font-size: 18px;
}

.card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s;
    text-align: center;
}

.card:hover {
    transform: translateY(-5px);
}

.icon-circle {
    width: 60px;
    height: 60px;
    background: #fce7f3;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px auto;
}

.icon {
    font-size: 24px;
    color: #ec4899;
}

.card-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.card-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 10px;
}

.link {
    color: #ec4899;
    text-decoration: none;
    transition: color 0.3s;
}

.link:hover {
    color: #db2777;
}

.btn-danger {
    background-color: #f87171;
    border: none;
}

.btn-danger:hover {
    background-color: #ef4444;
}

.footer-links {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    gap: 20px;
}
</style>
@endsection
