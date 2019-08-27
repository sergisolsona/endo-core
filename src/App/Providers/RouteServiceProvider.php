<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 24/08/2019
 * Time: 17:38
 */

namespace Endo\EndoCore\App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $routesFile = 'lang_routes.php';
        if (Schema::hasTable('endo_settings')) {
            $routesFile = endo_setting('domain_locale') ? 'routes.php' : 'lang_routes.php';
        }

        Route::middleware('endo')
            ->namespace('Endo\EndoCore\App\Http\Controllers')
            ->group(__DIR__ . '/../../routes/' . $routesFile);
    }

}