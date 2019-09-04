<?php

namespace Endo\EndoCore;

use Endo\EndoCore\App\Console\Commands\CreateAdmin;
use Endo\EndoCore\App\Http\Middleware\Developer;
use Endo\EndoCore\App\Http\Middleware\Locale;
use Endo\EndoCore\App\Models\EndoLanguage;
use Endo\EndoCore\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class EndoCoreServiceProvider extends ServiceProvider
{
    private $middlewareGroup = [
        Locale::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,

    ];

    private $commands = [
        CreateAdmin::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->setUserModel();

        $this->pushMiddlewares();

        // Load more providers
        foreach (glob(__DIR__ . '/App/Providers/*.php') as $filename) {
            $filenameArray = explode('/', $filename);
            $this->app->register(__NAMESPACE__ . '\App\Providers\\' . str_replace('.php', '', end($filenameArray)));
        }

        $this->commands($this->commands);

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'EndoCore');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/endo'),
        ], 'public');

        // Auto publish public files
        if (!file_exists(public_path('vendor/endo/mix-manifest.json'))
            || md5_file(__DIR__ . '/public/mix-manifest.json') !== md5_file(public_path('vendor/endo/mix-manifest.json'))) {
            Artisan::call('vendor:publish', [
                '--tag' => 'public',
                '--force' => 1
            ]);
        }

        $this->loadTranslations();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(__DIR__ . '/config/*.php') as $filename) {
            $configName = str_replace('.php', '', array_reverse(explode('/', $filename))[0]);
            $this->mergeConfigFrom($filename, $configName);
        }
    }


    private function setUserModel()
    {
        if (config('auth.providers.users.model') != User::class) {
            config()->set('auth.providers.users.model', User::class);
        }
    }


    private function pushMiddlewares()
    {
        /** @var Router $router */
        $router = $this->app['router'];

        foreach ($this->middlewareGroup as $middleware) {
            $router->pushMiddlewareToGroup('endo', $middleware);
        }

        $router->aliasMiddleware('dev', Developer::class);
    }


    private function loadTranslations()
    {
        if (Schema::hasTable('endo_languages')) {
            $languages = EndoLanguage::all()->sortByDesc('default');

            $defLanguage = $languages->first();
            $defLanguageFile = __DIR__ . '/resources/lang/' . $defLanguage->code . '.json';

            foreach ($languages as $language) {
                $file = __DIR__ . '/resources/lang/' . $language->code . '.json';
                if (!file_exists($file)) {

                    if (file_exists($defLanguageFile)) {
                        copy($defLanguageFile, $file);
                    } else {
                        file_put_contents($file, json_encode(['Settings' => 'Settings']));
                    }
                }
            }
        }

        $this->loadJsonTranslationsFrom(__DIR__ . '/resources/lang');
    }
}
