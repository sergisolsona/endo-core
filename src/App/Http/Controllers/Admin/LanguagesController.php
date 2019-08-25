<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 25/08/2019
 * Time: 17:31
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoLanguage;

class LanguagesController extends EndoBaseController
{


    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $languages = EndoLanguage::all();

        $languages = $orderDirection == 'asc' ? $languages->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $languages->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        return view('EndoCore::admin.languages.index', compact('orderBy', 'orderDirection', 'languages'));
    }
}