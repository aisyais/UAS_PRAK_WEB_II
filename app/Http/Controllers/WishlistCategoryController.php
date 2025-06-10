<?php

namespace App\Http\Controllers;

use App\Models\WishlistCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistCategoryController extends Controller
{
    // Implement the abstract method from the parent Controller
    protected function processRequest(Request $request)
    {
        // Example: Handle GET requests for the index page
        if ($request->isMethod('get')) {
            return $this->index();
        }

        // Default response for unhandled requests
        return response()->json(['message' => 'Request not handled'], 400);
    }

    public function index()
    {
        // Fetch categories belonging to the authenticated user
        $categories = WishlistCategory::where('user_id', Auth::id())->get();

        // Return the view with categories
        return view('wishlist_categories.index', compact('categories'));
    }

    public function create()
    {
        // Return the view for creating a new category
        return view('wishlist_categories.create');
    }

    public function store(Request $request)
    {
        // Validate the category name
        $request->validate([
            'name' => 'required|string|max:255', // Ensure the name field is required
        ]);

        // Create a new category for the authenticated user
        WishlistCategory::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('wishlist-categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    public function edit(WishlistCategory $wishlistCategory)
    {
        // Ensure the category belongs to the authenticated user
        if ($wishlistCategory->user_id !== Auth::id()) {
            abort(403);
        }

        return view('wishlist_categories.edit', compact('wishlistCategory'));
    }

    public function update(Request $request, WishlistCategory $wishlistCategory)
    {
        // Ensure the category belongs to the authenticated user
        if ($wishlistCategory->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the category
        $wishlistCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('wishlist-categories.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy(WishlistCategory $wishlistCategory)
    {
        // Ensure the category belongs to the authenticated user
        if ($wishlistCategory->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete the category
        $wishlistCategory->delete();

        return redirect()->route('wishlist-categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
