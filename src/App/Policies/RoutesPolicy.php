<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 24/08/2019
 * Time: 18:10
 */

namespace Endo\EndoCore\App\Policies;


use Endo\EndoCore\Models\User;

class RoutesPolicy
{
    public function view(User $user, $routeName = null)
    {
        if ($user->endoRole->is_dev) {
            return true;
        }

        if (!$routeName) {
            $routeName = route_name();
        }

        if ($user->endoRole->permissions->where('route_name', $routeName)->first()) {
            return true;
        }
        // TODO checks

        return false;
    }
}