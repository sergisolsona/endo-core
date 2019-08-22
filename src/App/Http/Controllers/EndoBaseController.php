<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 21/08/2019
 * Time: 17:43
 */

namespace Endo\EndoCore\App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EndoBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        view()->share('user', auth()->user());

        return parent::callAction($method, $parameters);
    }
}