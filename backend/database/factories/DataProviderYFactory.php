<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class DataProviderYFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balance' => fake()->numberBetween(500, 5000),
            'currency' => fake()->randomElement(['AED', 'USD', 'EUR']),
            'email' => fake()->unique()->safeEmail,
            'status' => fake()->randomElement([100, 200, 300]),
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'id' => fake()->uuid,
        ];
    }
}