<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WishlistCategory;

class WishlistCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Travel', 'user_id' => 1],
            ['name' => 'Books', 'user_id' => 1],
            ['name' => 'Gadgets', 'user_id' => 1],
            ['name' => 'Fitness', 'user_id' => 1],
            ['name' => 'Clothing', 'user_id' => 1],
        ];

        foreach ($categories as $category) {
            WishlistCategory::create($category);
        }
    }
}
