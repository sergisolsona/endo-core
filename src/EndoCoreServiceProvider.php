<?php

namespace Endo\EndoCore;

use Endo\EndoCore\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class EndoCoreServiceProvider extends ServiceProvider
{
    private $middlewareGroup = [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*$this->loadRoutesFrom(__DIR__ . '/routes.php');*/
        $this->routing();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'EndoCore');

        $this->setUserModel();

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/endo'),
        ], 'public');

        if (!file_exists(public_path('vendor/endo/mix-manifest.json'))
            || md5_file(__DIR__ . '/public/mix-manifest.json') !== md5_file(public_path('vendor/endo/mix-manifest.json'))) {
            Artisan::call('vendor:publish', [
                '--tag' => 'public',
                '--force' => 1
            ]);
        }
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


    private function routing()
    {
        /** @var Router $router */
        $router = $this->app['router'];

        foreach ($this->middlewareGroup as $middleware) {
            $router->pushMiddlewareToGroup('endo', $middleware);
        }

        Route::middleware('endo')
            ->namespace('Endo\EndoCore\App\Http\Controllers')
            ->group(__DIR__ . '/routes/routes.php');
    }
}
