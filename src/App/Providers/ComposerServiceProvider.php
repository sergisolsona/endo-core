<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 25/08/2019
 * Time: 17:22
 */

namespace Endo\EndoCore\App\Providers;


use Endo\EndoCore\App\Http\Composers\SidebarComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer('EndoCore::admin.layout.sidebar', SidebarComposer::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}