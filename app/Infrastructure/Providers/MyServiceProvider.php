<?php

namespace App\Infrastructure\Providers;

use App\Domain\Interfaces\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
