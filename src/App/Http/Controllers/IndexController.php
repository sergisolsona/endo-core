<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 21/08/2019
 * Time: 17:44
 */

namespace Endo\EndoCore\App\Http\Controllers;


class IndexController extends EndoBaseController
{

    public function index()
    {
        return view('EndoCore::admin.index');
    }
}