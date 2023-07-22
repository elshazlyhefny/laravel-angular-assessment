<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class DataProviderXFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parentAmount' => fake()->numberBetween(100, 1000),
            'Currency' => fake()->randomElement(['USD', 'EUR', 'GBP']),
            'parentEmail' => fake()->unique()->safeEmail,
            'statusCode' => fake()->randomElement([1, 2, 3]),
            'registerationDate' => fake()->date('Y-m-d'),
            'parentIdentification' => fake()->uuid,
        ];
    }
}