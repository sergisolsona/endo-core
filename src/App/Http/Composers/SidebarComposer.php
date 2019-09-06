<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 25/08/2019
 * Time: 17:12
 */

namespace Endo\EndoCore\App\Http\Composers;

use Endo\EndoCore\App\Models\EndoPostType;
use Endo\EndoCore\App\Services\EndoRolesService;
use Illuminate\View\View;

class SidebarComposer
{

    private $faIcons = [
        'admin' => 'fa-th-large',
        'users' => 'fa-users'
    ];

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menuItems = [];

        if (strpos(route_name(), 'admin.dev') !== false) {
            $menuItems[] = [
                'active_class' => strpos(route_name(), 'admin.dev.post-types.') !== false,
                'name' => __('Post types'),
                'route' => route('admin.dev.post-types.index'),
                'fa_name' => 'fa-archive'
            ];

            $menuItems[] = [
                'active_class' => strpos(route_name(), 'admin.dev.custom-fields.') !== false,
                'name' => __('Custom fields'),
                'route' => route('admin.dev.custom-fields.index'),
                'fa_name' => 'fa-plus-square'
            ];

            $menuItems[] = [
                'active_class' => strpos(route_name(), 'admin.dev.roles.') !== false,
                'name' => __('Roles'),
                'route' => route('admin.dev.roles.index'),
                'fa_name' => 'fa-lock'
            ];

            $menuItems[] = [
                'active_class' => strpos(route_name(), 'admin.dev.languages.') !== false,
                'name' => __('Languages'),
                'route' => route('admin.dev.languages.index'),
                'fa_name' => 'fa-flag'
            ];

            $menuItems[] = [
                'active_class' => strpos(route_name(), 'admin.dev.settings') !== false,
                'name' => __('General settings'),
                'route' => route('admin.dev.settings'),
                'fa_name' => 'fa-cog'
            ];

            $menuItems[] = [
                'active_class' => false,
                'name' => __('Back to admin'),
                'route' => route('admin'),
                'fa_name' => 'fa-cogs'
            ];
        } else {
            $user = request('user', auth()->user());

            if ($user->endoRole->is_dev) {
                $routes = app(EndoRolesService::class)->getAllRouteNames();

                foreach ($routes as $key => $routeGroup) {
                    $index = $routeGroup[0]['name'];

                    foreach ($routeGroup as $route) {
                        if (strpos($route['name'], '.index') !== false) {
                            $index = $route['name'];
                            break;
                        }
                    }

                    $menuItems[] = [
                        'active_class' => strpos(route_name(), str_replace('index', '', $index)) !== false,
                        'name' => __(ucfirst($key)),
                        'route' => route($index),
                        'fa_name' => $this->faIcons[$key]
                    ];
                }
            } else {
                foreach ($user->endoRole->permissions as $permission) {
                    $routeNameExploded = explode('.', str_replace('admin.', '', $permission->route_name));

                    if (last($routeNameExploded) == 'index') {
                        $key = $routeNameExploded[0];

                        $menuItems[] = [
                            'active_class' => strpos(route_name(), str_replace('index', '', $permission->route_name)) !== false,
                            'name' => __(ucfirst($key)),
                            'route' => route($permission->route_name),
                            'fa_name' => $this->faIcons[$key]
                        ];
                    }
                }
            }

            $postTypes = EndoPostType::with(['translations'])->get();

            $postTypeRoutes = [];
            foreach ($postTypes as $postType) {
                $postType->fillTranslation();

                $postTypeRoutes[] = [
                    'active_class' => false, // TODO
                    'name' => isset($postType->title_plural) ? $postType->title_plural : __(ucfirst($postType->name)),
                    'route' => '', // TODO
                ];
            }

            if (count($postTypeRoutes)) {
                $menuItems[] = [
                    'active_class' => false, // TODO
                    'name' => __('Content'),
                    'routes' => $postTypeRoutes,
                    'fa_name' => 'fa-newspaper-o'
                ];
            }

            if ($user->endoRole->is_dev) {
                $menuItems[] = [
                    'active_class' => false,
                    'name' => __('Dev menu'),
                    'route' => route('admin.dev'),
                    'fa_name' => 'fa-code'
                ];
            }
        }

        $view->with('menuItems', $menuItems);
    }
}