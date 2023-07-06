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
    public function definition(): array
    {
        $categorys = Category::get();
        return [
            'name' => fake()->sentence(3),
            'price' => fake()->randomFloat(2, 1, 100),
            'description' => fake()->sentence(10),
            'image' => fake()->imageUrl(640, 480, 'food'),
            'preparation_time' => fake()->numberBetween(5, 60),
            'callories' => fake()->numberBetween(100, 1000),
            'weight' => fake()->randomFloat(2, 0.1, 10),
            'ingredients' => fake()->sentence(6),
            'category_id' => fake()->randomElement($categorys),
        ];
    }
}
