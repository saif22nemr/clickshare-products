<?php

namespace Database\Factories;

use App\Models\User;
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
        $user = @User::get()->random()->id;
        return [
            'name' => fake()->paragraph(1),
            'quantity' => fake()->numberBetween(0 , 2000),
            'description' => fake()->paragraph(4),
            'user_id' => $user,
        ];
    }
}
