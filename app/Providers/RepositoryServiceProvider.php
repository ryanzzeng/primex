<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Users\Repositories\UserRepository;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}