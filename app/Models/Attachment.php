<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\WishlistItem;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['wishlist_item_id', 'file_path', 'type'];

    public function wishlistItem()
    {
        return $this->belongsTo(WishlistItem::class);
    }
}
