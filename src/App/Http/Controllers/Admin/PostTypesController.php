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
use Endo\EndoCore\App\Models\EndoPostTypeTranslation;

class PostTypesController extends EndoBaseController
{
    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $postTypes = EndoPostType::with('translations')->get();

        $postTypes = $orderDirection == 'asc' ? $postTypes->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $postTypes->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        $postTypes->each(function ($posType) {
            $posType->fillTranslation();
        });

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
        $translatable = request()->input('translatable') ? 1 : 0;

        $postType = EndoPostType::create([
            'name' => request()->input('name'),
            'translatable' => $translatable,
            'show_image' => request()->input('show_image') ? 1 : 0,
            'show_content' => request()->input('show_content') ? 1 : 0,
            'show_author' => request()->input('show_author') ? 1 : 0,
            'show_parent' => request()->input('show_parent') ? 1 : 0,
            'show_published' => request()->input('show_published') ? 1 : 0,
        ]);

        if ($translatable) {
            $locales = request()->input('locales');

            foreach ($locales as $key => $locale) {
                EndoPostTypeTranslation::create([
                    'endo_post_type_id' => $postType->id,
                    'url_name' => $locale['url_name'],
                    'title' => $locale['title'],
                    'title_plural' => $locale['title_plural'],
                    'locale' => $key
                ]);
            }
        } else {
            EndoPostTypeTranslation::create([
                'endo_post_type_id' => $postType->id,
                'url_name' => request()->input('url_name'),
                'title' => request()->input('title'),
                'title_plural' => request()->input('title_plural'),
                'locale' => null
            ]);
        }

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

        $translatable = request()->input('translatable') ? 1 : 0;

        $postType->update([
            'name' => request()->input('name'),
            'translatable' => $translatable,
            'show_image' => request()->input('show_image') ? 1 : 0,
            'show_content' => request()->input('show_content') ? 1 : 0,
            'show_author' => request()->input('show_author') ? 1 : 0,
            'show_parent' => request()->input('show_parent') ? 1 : 0,
            'show_published' => request()->input('show_published') ? 1 : 0,
        ]);

        if ($translatable) {
            $locales = request()->input('locales');

            foreach ($locales as $key => $locale) {
                $postTranslation = $postType->translations->where('locale', $key)->first();

                $updParams = [
                    'endo_post_type_id' => $postType->id,
                    'url_name' => $locale['url_name'],
                    'title' => $locale['title'],
                    'title_plural' => $locale['title_plural'],
                    'locale' => $key
                ];

                if (!$postTranslation) {
                    EndoPostTypeTranslation::create($updParams);
                } else {
                    $postTranslation->update($updParams);
                }
            }
        } else {
            $postTranslation = $postType->translations->where('locale', null)->first();

            $updParams = [
                'endo_post_type_id' => $postType->id,
                'url_name' => request()->input('url_name'),
                'title' => request()->input('title'),
                'title_plural' => request()->input('title_plural'),
                'locale' => null
            ];

            if (!$postTranslation) {
                EndoPostTypeTranslation::create($updParams);
            } else {
                $postTranslation->update($updParams);
            }
        }

        return redirect()->route('admin.dev.post-types.index')->with('success', __(':item created successfully', ['item' => __('Post type')]));
    }


    public function destroy($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $postType = EndoPostType::find($id);

        if (!$postType) {
            abort(404);
        }

        $postType->translations()->delete();

        $postType->delete();
    }
}