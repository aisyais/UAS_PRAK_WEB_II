<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\WishlistItem;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['wishlist_item_id', 'reminder_date', 'note'];

    public function wishlistItem()
    {
        return $this->belongsTo(WishlistItem::class);
    }
}
