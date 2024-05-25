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
            'category_id' => $this->faker->numberBetween(1, 2),
            'name' => $this->faker->name,
            'desc' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(640, 480, 'fruits', true),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'criteria' => 'perorangan',
            'status' => 'published',
            'is_favorite' => $this->faker->boolean,
        ];
    }
}
