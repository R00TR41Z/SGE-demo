<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'ref'=>"EST-". strtoupper(substr(bin2hex(random_bytes(6)), 0, 6)) . '/'.now()->year,
            'birthday'=>now()->subYears(rand(1,15))->toDateString()
        ];
    }
}
