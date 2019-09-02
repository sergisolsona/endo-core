<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 02/09/2019
 * Time: 10:33
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoLanguage;
use Endo\EndoCore\App\Models\EndoPostType;

class PostTypesController extends EndoBaseController
{
    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $postTypes = EndoPostType::all();

        $postTypes = $orderDirection == 'asc' ? $postTypes->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $postTypes->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        return view('EndoCore::admin.post-types.index', compact(
            'orderBy',
            'orderDirection',
            'postTypes'
        ));
    }


    public function create()
    {
        $locales = EndoLanguage::where('active', 1)->orderBy('name', 'asc')->get();

        return view('EndoCore::admin.post-types.edit', compact(
            'locales'
        ));
    }


    public function store()
    {
        EndoPostType::create([

        ]);

        return redirect()->route('admin.dev.post-types.index')->with('success', __(':item created successfully', ['item' => __('Post type')]));
    }


    public function edit($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $postType = EndoPostType::find($id);

        if (!$postType) {
            abort(404);
        }

        $locales = EndoLanguage::where('active', 1)->orderBy('name', 'asc')->get();

        return view('EndoCore::admin.post-types.edit', compact('postType', 'locales'));
    }


    public function update($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $postType = EndoPostType::find($id);

        if (!$postType) {
            abort(404);
        }

        $postType->update([

        ]);

        return redirect()->route('admin.dev.post-types.index')->with('success', __(':item created successfully', ['item' => __('Post type')]));
    }
}