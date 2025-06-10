@extends('layouts.app')

@section('title', 'Detail Wishlist Item')

@section('content')
<div class="background-container">
    <div class="content-wrapper">
        <h1 class="main-title">Detail Wishlist Item</h1>

        <div class="card">
            <h2 class="card-title">{{ $wishlistItem->title }}</h2>
            <p class="card-category">Kategori: {{ $wishlistItem->wishlistCategory->name ?? 'Tanpa Kategori' }}</p>
            <p class="card-description">{{ $wishlistItem->description }}</p>
            <p class="card-status">
                Status:
                <span class="badge {{ $wishlistItem->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($wishlistItem->status) }}
                </span>
            </p>
        </div>

        <hr>

        <h3>Reminders</h3>
        @if ($wishlistItem->reminders->isEmpty())
            <p class="text-muted">Belum ada reminder.</p>
        @else
            <ul>
                @foreach ($wishlistItem->reminders as $reminder)
                    <li>{{ \Carbon\Carbon::parse($reminder->reminder_date)->format('d M Y H:i') }}</li>
                @endforeach
            </ul>
        @endif
        {{-- PERBAIKAN DI SINI: tambahkan $wishlistItem sebagai parameter --}}
        {{-- Juga, hidden input wishlist_item_id sudah tidak diperlukan jika menggunakan model binding di controller --}}
        <form action="{{ route('wishlist-items.reminders.store', $wishlistItem) }}" method="POST" class="mt-3">
            @csrf
            {{-- <input type="hidden" name="wishlist_item_id" value="{{ $wishlistItem->id }}"> --}}
            <div class="mb-3">
                <label for="reminder_date" class="form-label">Tanggal & Waktu Reminder</label>
                <input type="datetime-local" name="reminder_date" id="reminder_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-pink">+ Tambah Reminder</button>
        </form>


        <hr>

        <h3>Attachments</h3>
        @if ($wishlistItem->attachments->isEmpty())
            <p class="text-muted">Belum ada attachment.</p>
        @else
            <ul>
                @foreach ($wishlistItem->attachments as $attachment)
                    <li>
                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">
                            {{ basename($attachment->file_path) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        {{-- PERBAIKAN DI SINI: tambahkan $wishlistItem sebagai parameter dan perbaiki @csrfss menjadi @csrf --}}
        {{-- Juga, hidden input wishlist_item_id sudah tidak diperlukan jika menggunakan model binding di controller --}}
        <form action="{{ route('wishlist-items.attachments.store', $wishlistItem) }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf {{-- PERBAIKAN: @csrfss menjadi @csrf --}}
            {{-- <input type="hidden" name="wishlist_item_id" value="{{ $wishlistItem->id }}"> --}}
            <div class="mb-3">
                <label for="file" class="form-label">Upload File</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-pink">+ Tambah Attachment</button>
        </form>


        <div class="mt-4">
            <a href="{{ route('wishlist-items.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('wishlist-items.edit', $wishlistItem) }}" class="btn btn-pink">Edit</a>
        </div>
    </div>
</div>

<style>
.background-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}
.content-wrapper {
    background: #fff0f5;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    width: 100%;
}
.main-title {
    color: #d63384;
    margin-bottom: 30px;
}
.card {
    background: white;
    padding: 20px;
    border-radius: 16px;
    margin-bottom: 20px;
}
.card-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}
.card-category, .card-description, .card-status {
    margin-bottom: 10px;
}
.btn-pink {
    background-color: #f472b6;
    color: white;
    padding: 10px 20px;
    border-radius: 30px;
    text-decoration: none;
    border: none;
}
.btn-pink:hover {
    background-color: #ec4899;
}
</style>
@endsection