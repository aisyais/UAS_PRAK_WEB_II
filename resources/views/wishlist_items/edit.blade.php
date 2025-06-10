@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Wishlist Item</h1>

    <form action="{{ route('wishlist-items.update', $wishlistItem) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="wishlist_category_id" class="form-label">Kategori</label>
            <select name="wishlist_category_id" id="wishlist_category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $wishlistItem->wishlist_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" value="{{ $wishlistItem->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control">{{ $wishlistItem->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
