<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 5; $i++) {
                $name = $category->name . ' Product ' . $i;
                Product::create([
                    'category_id' => $category->id,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => 'This is a description for ' . $name,
                    'price' => rand(100, 1000),
                    'discount_price' => rand(50, 90) / 100 * 1000,
                    'stock' => rand(10, 100),
                    'sku' => strtoupper(Str::random(8)),
                    'status' => true,
                    'featured' => rand(0, 1),
                ]);
            }
        }
    }
}
