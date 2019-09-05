<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:21
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoPostType;
use Endo\EndoCore\App\Models\EndoRole;
use Illuminate\Support\Facades\Route;

class RolesController extends EndoBaseController
{

    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $roles = EndoRole::all();

        $roles = $orderDirection == 'asc' ? $roles->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $roles->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        return view('EndoCore::admin.roles.index', compact(
            'orderBy',
            'orderDirection',
            'roles'
        ));
    }


    public function create()
    {
        $routes = $this->getAllRouteNames();
        $postTypes = EndoPostType::all();

        return view('EndoCore::admin.roles.edit', compact('routes', 'postTypes'));
    }


    public function store()
    {

    }


    public function edit($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $role = EndoRole::find($id);

        if (!$role) {
            abort(404);
        }

        $role->load(['permissions', 'postPermissions']);

        $routes = $this->getAllRouteNames();
        $postTypes = EndoPostType::all();

        return view('EndoCore::admin.roles.edit', compact('role', 'routes', 'postTypes'));
    }


    public function update($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $role = EndoRole::find($id);

        if (!$role) {
            abort(404);
        }
    }


    public function destroy($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $role = EndoRole::find($id);

        if (!$role) {
            abort(404);
        }

        $role->delete();
    }


    private function getAllRouteNames()
    {
        $routes = Route::getRoutes()->getRoutesByName();

        $adminRoutes = [];
        foreach ($routes as $key => $route) {
            if (strpos($key, 'admin') === 0 && strpos($key, 'admin.dev') === false) {
                $r = str_replace('admin.', '', $key);
                $adminRoutes[explode('.', $r)[0]][] = $r;
            }
        }

        return $adminRoutes;
    }
}