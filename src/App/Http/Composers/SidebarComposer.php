<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 25/08/2019
 * Time: 17:12
 */

namespace Endo\EndoCore\App\Http\Composers;

use Illuminate\View\View;

class SidebarComposer
{

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
            $user = auth()->user();

            if ($user->can('view', 'admin.dev')) {
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