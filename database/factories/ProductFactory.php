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
            'name'=> fake()->name(),
            'img' => fake()->imageUrl(),
            'description' =>fake()->text(),
            'cost'=>rand(100000,500000),
            'sale'=>rand(1,10),
            'tag_id'=>rand(1,10),
            'category_id'=>rand(1,2),
        ];
    }
}
