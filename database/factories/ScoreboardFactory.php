<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Participant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scoreboard>
 */
class ScoreboardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'participantId' => Participant::factory(),
            'score' => $this->faker->numberBetween(0, 100),
        ];
    }
}
