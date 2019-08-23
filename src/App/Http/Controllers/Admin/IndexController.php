<?php


namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;

class IndexController extends EndoBaseController
{

    public function index()
    {
        return view('EndoCore::admin.index');
    }
}