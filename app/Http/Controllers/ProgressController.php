<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\WishlistItem;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function create(WishlistItem $wishlistItem)
    {
        return view('progresses.create', compact('wishlistItem'));
    }

    public function store(Request $request, WishlistItem $wishlistItem)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'progress_date' => 'required|date',
        ]);

        $wishlistItem->progresses()->create($request->only('description', 'progress_date'));

        return redirect()->route('wishlist-items.show', $wishlistItem)->with('success', 'Progress berhasil ditambahkan.');
    }

    public function destroy(Progress $progress)
    {
        $wishlistItem = $progress->wishlistItem;
        $progress->delete();

        return redirect()->route('wishlist-items.show', $wishlistItem)->with('success', 'Progress berhasil dihapus.');
    }
}
