<?php

namespace App\Providers;

use App\General\Interfaces\RepositoriesInterface;
use App\General\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RepositoriesInterface::class, UserRepository::class);
    }
}
