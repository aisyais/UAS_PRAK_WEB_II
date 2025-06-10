<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = ['wishlist_item_id', 'note'];

    public function wishlistItem()
    {
        return $this->belongsTo(WishlistItem::class);
    }
}
