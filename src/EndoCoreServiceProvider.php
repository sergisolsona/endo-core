<?php

namespace Endo\EndoCore;

use Endo\EndoCore\Models\User;
use Illuminate\Support\ServiceProvider;

class EndoCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'EndoCore');

        $this->setUserModel();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    private function setUserModel()
    {
        if (config('auth.providers.users.model') != User::class) {
            config()->set('auth.providers.users.model', User::class);
        }
    }
}
