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
        return view('EndoCore::admin.languages.edit');
    }


    public function store()
    {
        EndoLanguage::create([
            'name' => request()->input('name'),
            'code' => request()->input('code'),
            'domain' => request()->input('domain')
        ]);

        return redirect()->route('admin.dev.languages.index')->with('success', __(':item created successfully', ['item' => __('Language')]));
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

        return view('EndoCore::admin.languages.edit', compact('language'));
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

        $language->update([
            'name' => request()->input('name'),
            'code' => request()->input('code'),
            'domain' => request()->input('domain')
        ]);

        return redirect()->route('admin.dev.languages.index')->with('success', __(':item created successfully', ['item' => __('Language')]));
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

        if (!$newStatus && $language->default) {
            $newDefLang = EndoLanguage::where('active', 1)
                ->where('id', '<>', $id)
                ->first();
            if ($newDefLang) {
                $newDefLang->update(['default' => 1]);
            } else {
                abort('403', __('At least one language needed'));
            }
        } elseif ($newStatus && $name == 'default') {
            EndoLanguage::where('default', 1)->update(['default' => 0]);
        }

        $params = [
            $name => $newStatus
        ];

        if ($name != 'default' && !$newStatus) {
            $params['default'] = 0;
        }

        $language->update($params);
    }
}