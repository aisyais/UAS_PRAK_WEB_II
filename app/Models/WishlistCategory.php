<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    // Define relationship with WishlistItem
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }
}
