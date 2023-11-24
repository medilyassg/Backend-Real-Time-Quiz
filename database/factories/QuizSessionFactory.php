<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Host;
use App\Models\Quiz;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizSession>
 */
class QuizSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'quizId' => Quiz::factory(),
        'hostId' => Host::factory(),
        'startTime' => $this->faker->dateTime(),
        'endTime' => $this->faker->optional()->dateTime(),
        ];
    }
}
