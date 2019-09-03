<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 29/08/2019
 * Time: 18:06
 */

namespace Endo\EndoCore\App\Providers;


use Endo\EndoCore\App\Custom\Translator;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $loader = $this->app['translation.loader'];

        // When registering the translator component, we'll need to set the default
        // locale as well as the fallback locale. So, we'll grab the application
        // configuration so we can easily get both of these values from there.
        $locale = $this->app['config']['app.locale'];

        $this->app->extend('translator', function () use ($loader, $locale) {
            return new Translator($loader, $locale);
        });
    }
}