<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'wishlist_category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(WishlistCategory::class, 'wishlist_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }

    // Define the relationship with WishlistCategory
    public function wishlistCategory()
    {
        return $this->belongsTo(WishlistCategory::class, 'wishlist_category_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
 
}
