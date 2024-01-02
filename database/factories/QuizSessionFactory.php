<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        'hostId' => User::factory(),
        'startTime' => $this->faker->dateTime(),
        'endTime' => $this->faker->optional()->dateTime(),
        ];
    }
}
