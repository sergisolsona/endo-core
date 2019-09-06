<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:21
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoPermission;
use Endo\EndoCore\App\Models\EndoPostPermission;
use Endo\EndoCore\App\Models\EndoPostType;
use Endo\EndoCore\App\Models\EndoRole;
use Endo\EndoCore\App\Services\EndoRolesService;

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
        $routes = app(EndoRolesService::class)->getAllRouteNames();
        $postTypes = EndoPostType::all();

        return view('EndoCore::admin.roles.edit', compact('routes', 'postTypes'));
    }


    public function store()
    {
        $role = EndoRole::create([
            'name' => request()->input('name'),
            'level' => request()->input('level', 0),
            'is_dev' => request()->input('is_dev') ? 1 : 0
        ]);

        $permissions = request()->input('permissions', []);

        foreach ($permissions as $key => $permission) {
            EndoPermission::create([
                'endo_role_id' => $role->id,
                'route_name' => $key
            ]);
        }

        $postPermissions = request()->input('post_permissions', []);

        foreach ($postPermissions as $key => $postPermission) {
            EndoPostPermission::create([
                'endo_role_id' => $role->id,
                'endo_post_type_id' => $key,
                'create' => isset($postPermission['create']),
                'read' => isset($postPermission['read']),
                'update' => isset($postPermission['update']),
                'delete' => isset($postPermission['delete']),
                'publish' => isset($postPermission['publish'])
            ]);
        }

        return redirect()->route('admin.dev.roles.index')
            ->with('success', __(':item created successfully', ['item' => __('Role')]));
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

        $routes = app(EndoRolesService::class)->getAllRouteNames();
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

        $role->update([
            'name' => request()->input('name'),
            'level' => request()->input('level', 0),
            'is_dev' => request()->input('is_dev') ? 1 : 0
        ]);

        $permissions = request()->input('permissions', []);

        foreach ($permissions as $key => $permission) {
            EndoPermission::firstOrCreate([
                'endo_role_id' => $role->id,
                'route_name' => $key
            ]);
        }

        $postPermissions = request()->input('post_permissions', []);

        foreach ($postPermissions as $key => $postPermission) {
            $endoPostPermission = EndoPostPermission::firstOrNew([
                'endo_role_id' => $role->id,
                'endo_post_type_id' => $key
            ]);

            $upd = [
                'create' => isset($postPermission['create']),
                'read' => isset($postPermission['read']),
                'update' => isset($postPermission['update']),
                'delete' => isset($postPermission['delete']),
                'publish' => isset($postPermission['publish'])
            ];

            if ($endoPostPermission->exists) {
                $endoPostPermission->update($upd);
            } else {
                foreach ($upd as $key => $value) {
                    $endoPostPermission->$key = $value;
                }

                $endoPostPermission->save();
            }
        }

        return redirect()->route('admin.dev.roles.index')
            ->with('success', __(':item updated successfully', ['item' => __('Role')]));
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
}