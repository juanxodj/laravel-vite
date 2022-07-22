<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movement>
 */
class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $quantity = fake()->numberBetween(1, 10);
        $amount = fake()->numberBetween(50, 500);

        $movement = [
            'type' => fake()->randomElement(['income', 'expenses']),
            'quantity' => $quantity,
            'amount' => $amount,
            'total' => $quantity * $amount,
            'cash_register_id' => 1,
            'product_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'user_id' => 1
        ];

        return $movement;
    }
}
