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

        $singleLocale = endo_setting('single_locale', 0);
        $domainLocale = endo_setting('domain_locale', 0);

        return view('EndoCore::admin.languages.index', compact(
            'orderBy',
            'orderDirection',
            'languages',
            'domainLocale',
            'singleLocale'
        ));
    }


    public function create()
    {

    }


    public function store()
    {

    }


    public function edit($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $language = EndoLanguage::find($id);

        if (!$language) {
            abort(404);
        }
    }


    public function update($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $language = EndoLanguage::find($id);

        if (!$language) {
            abort(404);
        }
    }


    public function change($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $language = EndoLanguage::find($id);

        if (!$language) {
            abort(404);
        }

        $name = request()->input('name');
        $current = request()->input('current');

        $newStatus = $current ? 0 : 1;

        // TODO: change other status?

        $language->update([
            $name => $newStatus
        ]);
    }
}