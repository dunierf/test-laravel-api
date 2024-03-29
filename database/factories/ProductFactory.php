<?php

namespace Database\Factories;

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
        return [
            'name' => implode(' ', fake()->words(4)),
            'price' => fake()->randomFloat(2, 20, 80),
            'image' => fake()->imageUrl(640, 480, 'product', true),
            'description' => implode("\n", fake()->paragraphs())
        ];
    }
}
