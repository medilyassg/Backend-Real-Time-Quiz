<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timer>
 */
class TimerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'startTime' => $this->faker->dateTime(),
            'endTime' => $this->faker->optional()->dateTime(),
            'remainingTime' => $this->faker->numberBetween(0, 3600), // Assuming a maximum of 1 hour
        ];
    }
}
