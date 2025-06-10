<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\WishlistItem; // Pastikan ini diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor untuk otorisasi

class ReminderController extends Controller // Pastikan mewarisi Controller dasar Anda
{
    /**
     * Implementasi dari metode abstrak processRequest() di Controller dasar.
     * Metode ini akan menjadi titik masuk utama untuk request yang ditangani controller ini.
     */
    protected function processRequest(Request $request)
    {
        // Ambil wishlist_item_id dari input form (hidden input)
        $wishlistItemId = $request->input('wishlist_item_id');
        $wishlistItem = WishlistItem::findOrFail($wishlistItemId);

        // Otorisasi: Pastikan user yang mencoba menambah reminder adalah pemilik wishlist item
        if ($wishlistItem->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin untuk menambah reminder pada item ini.');
        }

        // Sekarang, panggil metode store yang berisi logika validasi dan penyimpanan
        return $this->store($request, $wishlistItem);
    }

    /**
     * Menyimpan reminder baru untuk WishlistItem tertentu.
     * (Metode ini sekarang akan dipanggil dari dalam processRequest)
     */
    public function store(Request $request, WishlistItem $wishlistItem) // Terima WishlistItem sebagai parameter
    {
        // Otorisasi (bisa dihilangkan dari sini jika sudah di processRequest, tapi tidak ada salahnya sebagai pengaman)
        // if ($wishlistItem->user_id !== Auth::id()) {
        //     abort(403, 'Anda tidak memiliki izin untuk menambah reminder pada item ini.');
        // }

        $validated = $request->validate([
            // wishlist_item_id tidak lagi perlu divalidasi dengan 'exists' di sini
            // karena objek WishlistItem sudah didapatkan di processRequest.
            // Namun, jika Anda tetap mengirimnya via hidden input dan ingin validasi data request,
            // Anda bisa biarkan validasi ini, tapi tidak akan mempengaruhi pencarian WishlistItem di atas.
            'wishlist_item_id' => 'required|exists:wishlist_items,id', // Jaga ini jika masih ada hidden input
            'reminder_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        // Gunakan objek WishlistItem yang sudah ada untuk membuat reminder melalui relasi
        $wishlistItem->reminders()->create([
            'reminder_date' => $validated['reminder_date'],
            'note' => $validated['note'] ?? null, // Gunakan null jika 'note' tidak ada
        ]);

        return redirect()->back()->with('success', 'Reminder berhasil ditambahkan!');
    }
}