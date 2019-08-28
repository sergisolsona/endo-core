<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 28/08/2019
 * Time: 18:50
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;

class EndoSettingsController extends EndoBaseController
{

    public function setSetting()
    {
        $setting = request()->input('setting');
        $value = request()->input('value');

        endo_setting([$setting => $value]);
    }
}