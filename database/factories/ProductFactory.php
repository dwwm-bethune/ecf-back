<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement(['iPhone X', 'iPhone 11', 'Macbook Air', 'Macbook Pro']),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 0, 1000),
            'slug' => fake()->slug(1),
            'favorite' => fake()->boolean(),
            // 'colors' => fake()->randomElements(['Rouge', 'Vert', 'Bleu'], rand(0, 3)),
            'image' => fake()->imageUrl(),
            'discount' => fake()->randomFloat(2, 0, 100),
            'category_id' => Category::factory(),
        ];
    }
}
