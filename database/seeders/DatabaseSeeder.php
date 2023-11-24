<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Host::factory(5)->create();
        \App\Models\Participant::factory(20)->create();
        \App\Models\Quiz::factory(3)->create();
        \App\Models\Question::factory(15)->create();
        \App\Models\QuizSession::factory(3)->create();
        \App\Models\Scoreboard::factory(30)->create();
        \App\Models\Timer::factory(3)->create();
        \App\Models\Option::factory(50)->create();
    }
}
