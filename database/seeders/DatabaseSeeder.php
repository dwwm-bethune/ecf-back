<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::factory(10)->create();
        $colors = Color::factory(10)->create();

        Product::factory(100)->afterCreating(function (Product $product) use ($categories, $colors) {
            $product->category()->associate($categories->random(1)->first())->save();
            $product->colors()->attach($colors->random(rand(0, 5))->pluck('id')->all());
        })->create(['category_id' => null]);
    }
}
