<?php

namespace App\Providers;

use App\Repository\DBUsersRepository;
use App\RepositoryInterface\StandardRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->when(UsersController::class)
        //   ->needs(StandardRepositoryInterface::class)
        //   ->give(function () {
        //       return new DBUsersRepository;
        //   });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
