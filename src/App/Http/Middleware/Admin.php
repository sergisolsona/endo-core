<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 05/09/2019
 * Time: 11:30
 */

namespace Endo\EndoCore\App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        $user->load(['endoRole.permissions', 'endoRole.postPermissions']);

        if (!$user->can('view', route_name())) {
            return redirect()->back()->with('error', __('Not allowed'));
        }

        $request->merge(['user' => $user]);

        return $next($request);
    }
}