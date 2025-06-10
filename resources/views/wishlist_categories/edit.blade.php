<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori Wishlist</title>
</head>
<body>
    <h1>Edit Kategori Wishlist</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('wishlist-categories.update', $wishlistCategory) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Nama Kategori:</label>
            <input type="text" name="name" value="{{ old('name', $wishlistCategory->name) }}" required>
        </div>
        <button type="submit">Update</button>
    </form>

    <a href="{{ route('wishlist-categories.index') }}">Kembali</a>
</body>
</html>
