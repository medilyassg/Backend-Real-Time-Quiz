<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\QuizRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(QuizRepository::class, function () {
            return new QuizRepository();
        });
    }
}
