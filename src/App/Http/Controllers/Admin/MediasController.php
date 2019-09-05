<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:31
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoMedia;

class MediasController extends EndoBaseController
{
    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $medias = EndoMedia::all();

        $medias = $orderDirection == 'asc' ? $medias->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $medias->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        return view('EndoCore::admin.medias.index', compact(
            'orderBy',
            'orderDirection',
            'medias'
        ));
    }


    public function create()
    {
        return view('EndoCore::admin.medias.edit');
    }


    public function store()
    {

    }


    public function edit($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $media = EndoMedia::find($id);

        if (!$media) {
            abort(404);
        }

        return view('EndoCore::admin.medias.edit', compact('media'));
    }


    public function update($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $media = EndoMedia::find($id);

        if (!$media) {
            abort(404);
        }
    }


    public function destroy($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $media = EndoMedia::find($id);

        if (!$media) {
            abort(404);
        }

        $media->delete();
    }
}