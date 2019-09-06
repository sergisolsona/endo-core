<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 05/09/2019
 * Time: 17:15
 */

namespace Endo\EndoCore\App\Services;

use Illuminate\Support\Facades\Route;

class EndoRolesService
{

    public function getAllRouteNames()
    {
        $routes = Route::getRoutes()->getRoutesByName();

        $adminRoutes = [];
        foreach ($routes as $key => $route) {
            if (strpos($key, 'admin') === 0 && strpos($key, 'admin.dev') === false) {
                $r = str_replace('admin.', '', $key);
                $adminRoutes[explode('.', $r)[0]][] = ['name' => $key, 'text' => $r];
            }
        }

        return $adminRoutes;
    }
}