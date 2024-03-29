<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $icons = fake()->randomElement(['blog','book' ,'desktop']);
        return [
            'name' => fake()->word(),
            'photo' => fake()->imageUrl(100, 100, 'laptop', true),
            'icon' => $icons,
        ];
    }
}
