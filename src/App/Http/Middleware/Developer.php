<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 25/08/2019
 * Time: 16:43
 */

namespace Endo\EndoCore\App\Http\Middleware;


use Closure;

class Developer
{

    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->endoRole || !$user->endoRole->is_dev) {
            return redirect()->back()->with('error', __('Not allowed'));
        }

        return $next($request);
    }
}