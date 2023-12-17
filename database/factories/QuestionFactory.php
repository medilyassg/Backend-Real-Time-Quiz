<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Quiz;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'text' => $this->faker->sentence,
        'correctOption' => Option::factory(),
        'points' => $this->faker->numberBetween(1, 10),
        'quizId' => Quiz::factory(),
        ];
    }
}
