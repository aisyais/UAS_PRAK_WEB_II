<?php

namespace App\Http\Controllers;

use App\Models\WishlistItem;
use App\Models\WishlistCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistItemController extends Controller
{
    // Implement the abstract method from the parent Controller
    protected function processRequest(Request $request)
    {
        // Example: Handle a specific request type
        if ($request->isMethod('get')) {
            return $this->index();
        }

        // Default response for unhandled requests
        return response()->json(['message' => 'Request not handled'], 400);
    }

    public function index()
    {
       
        $items = WishlistItem::where('user_id', Auth::id())->with('wishlistCategory')->get();
        return view('wishlist_items.index', compact('items'));
    }

    public function create()
    {
        // Fetch categories belonging to the authenticated user
        $categories = WishlistCategory::where('user_id', Auth::id())->get();

        // Pass categories to the view
        return view('wishlist_items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'wishlist_category_id' => 'required|exists:wishlist_categories,id', // Ensure category exists
            'description' => 'nullable|string',
        ]);

        // Create the wishlist item
        WishlistItem::create([
            'user_id' => Auth::id(),
            'wishlist_category_id' => $request->wishlist_category_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('wishlist-items.index')->with('success', 'Wishlist item berhasil dibuat!');
    }

    public function show(WishlistItem $wishlistItem)
    {
        if ($wishlistItem->user_id !== Auth::id()) {
        abort(403);
        }

        $wishlistItem->load(['reminders', 'attachments']); // Pastikan relasi dipanggil

        return view('wishlist_items.show', compact('wishlistItem'));
    }

    public function edit(WishlistItem $wishlistItem)
    {
        if ($wishlistItem->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = WishlistCategory::where('user_id', Auth::id())->get();
        return view('wishlist_items.edit', compact('wishlistItem', 'categories'));
    }

    public function update(Request $request, WishlistItem $wishlistItem)
    {
        if ($wishlistItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'wishlist_category_id' => 'required|exists:wishlist_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $wishlistItem->update([
            'wishlist_category_id' => $request->wishlist_category_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('wishlist-items.index')->with('success', 'Wishlist item berhasil diupdate!');
    }

    public function destroy(WishlistItem $wishlistItem)
    {
        if ($wishlistItem->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlistItem->delete();

        return redirect()->route('wishlist-items.index')->with('success', 'Wishlist item berhasil dihapus!');
    }
}
