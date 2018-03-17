<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
        $this->app->bind(\App\Repositories\SystemRepository::class, \App\Repositories\SystemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentsRepository::class, \App\Repositories\StudentsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClassesRepository::class, \App\Repositories\ClassesRepositoryEloquent::class);
    }
}
