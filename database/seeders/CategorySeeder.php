<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Fruits & Vegetables',
            'Dairy & Breakfast',
            'Snacks & Munchies',
            'Cold Drinks & Juices',
            'Instant Food',
            'Meat & Seafood',
            'Baby Care',
            'Personal Care',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'status' => true,
            ]);
        }
    }
}
