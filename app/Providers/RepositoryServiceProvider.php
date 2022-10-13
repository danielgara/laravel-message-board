<?php

namespace App\Providers;

use App\Interfaces\ThreadRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ThreadRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ThreadRepositoryInterface::class, ThreadRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
