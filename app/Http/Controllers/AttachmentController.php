<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\WishlistItem; // Pastikan ini diimpor untuk digunakan dalam processRequest
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Diperlukan untuk otorisasi, jika ingin menambahkan

class AttachmentController extends Controller // Pastikan mewarisi Controller dasar Anda
{
    /**
     * Implementasi dari metode abstrak processRequest() di Controller dasar.
     * Metode ini akan menjadi titik masuk utama untuk request yang ditangani controller ini.
     */
    protected function processRequest(Request $request)
    {
        // Panggil metode 'store' Anda dari dalam processRequest.
        // Anda perlu mendapatkan objek WishlistItem dari request,
        // karena route Anda menggunakan model binding ({wishlistItem}) dan
        // Anda mengirim wishlist_item_id di form hidden input.

        // Jika Anda masih mengirim wishlist_item_id sebagai hidden input di form:
        $wishlistItemId = $request->input('wishlist_item_id');
        $wishlistItem = WishlistItem::findOrFail($wishlistItemId);

        // Jika Anda sudah mengubah form dan route untuk mengirim wishlist_item_id via URL parameter,
        // seperti yang disarankan sebelumnya untuk pendekatan RESTful:
        // $wishlistItem = $request->route('wishlistItem'); // Ini akan bekerja jika URLnya: /wishlist-items/{id}/attachments

        // ***PENTING: Pilih salah satu dari dua baris di atas sesuai dengan implementasi Anda.***
        // Saya akan menggunakan yang dari hidden input karena sesuai dengan AttachmentController yang Anda berikan.

        // Lakukan otorisasi di sini atau di metode store
        if ($wishlistItem->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengunggah attachment pada item ini.');
        }

        // Sekarang, panggil metode store yang berisi logika validasi dan penyimpanan
        return $this->store($request, $wishlistItem);
    }

    /**
     * Menyimpan attachment baru untuk WishlistItem tertentu.
     * (Metode ini sekarang akan dipanggil dari dalam processRequest)
     */
    public function store(Request $request, WishlistItem $wishlistItem)
    {
        // Validasi data yang masuk
        // 'attachment' di sini sesuai dengan 'name' dari input file di form Blade Anda.
        $validated = $request->validate([
            // 'wishlist_item_id' tidak lagi perlu divalidasi di sini jika Anda sudah mendapatkannya dari parameter
            // atau dari processRequest. Tapi jika Anda masih mengirimkannya sebagai hidden input,
            // validasi ini tetap diperlukan jika Anda belum melakukan pengecekan di processRequest.
            // Saya asumsikan Anda ingin menjaga validasi ini:
            'wishlist_item_id' => 'required|exists:wishlist_items,id', // Jaga ini jika masih ada hidden input
            'attachment' => 'required|file|max:2048', // Pastikan nama input file adalah 'attachment'
        ]);

        // Pastikan file memang ada
        if (!$request->hasFile('attachment')) {
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
        }

        $file = $request->file('attachment');
        // Simpan file ke direktori 'attachments' dalam disk 'public'
        $path = $file->store('attachments', 'public');

        // Buat entri baru di tabel attachments melalui relasi
        $wishlistItem->attachments()->create([
            // 'wishlist_item_id' diambil dari parameter WishlistItem, bukan lagi dari $validated.
            // Anda bisa menghapus $validated['wishlist_item_id'] dan cukup menggunakan $wishlistItem->id.
            'wishlist_item_id' => $wishlistItem->id, // Menggunakan ID dari objek WishlistItem yang sudah terikat
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(), // Simpan nama asli file
            'type' => $file->getClientOriginalExtension(), // Simpan ekstensi file
        ]);

        return redirect()->back()->with('success', 'File berhasil diunggah!');
    }
}