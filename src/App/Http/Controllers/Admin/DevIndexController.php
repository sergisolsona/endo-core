<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 24/08/2019
 * Time: 18:22
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;

class DevIndexController extends EndoBaseController
{

    public function index()
    {
        return view('EndoCore::admin.index');
    }
}