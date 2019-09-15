<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 03/09/2019
 * Time: 18:43
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoCustomField;
use Endo\EndoCore\App\Models\EndoCustomFieldGroup;
use Endo\EndoCore\App\Models\EndoPostType;

class CustomFieldsController extends EndoBaseController
{

    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $customFieldGroups = EndoCustomFieldGroup::all();

        $customFieldGroups = $orderDirection == 'asc' ? $customFieldGroups->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $customFieldGroups->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        return view('EndoCore::admin.custom-fields.index', compact(
            'orderBy',
            'orderDirection',
            'customFieldGroups'
        ));
    }


    public function create()
    {
        $templatePositions = config('templates.positions');

        $postTypes = EndoPostType::all();

        return view('EndoCore::admin.custom-fields.edit', compact('templatePositions', 'postTypes'));
    }

    
    public function store()
    {
        // TODO create
        return redirect()->route('admin.dev.post-types.index')
            ->with('success', __(':item created successfully', ['item' => __('Post type')]));
    }


    public function edit($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $customFieldGroup = EndoCustomFieldGroup::find($id);

        if (!$customFieldGroup) {
            abort(404);
        }

        $customFieldGroup->load('customFields');

        $templatePositions = config('templates.positions');

        $postTypes = EndoPostType::all();

        return view('EndoCore::admin.custom-fields.edit', compact(
            'customFieldGroup',
            'templatePositions',
            'postTypes'));
    }


    public function update($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $customFieldGroup = EndoCustomFieldGroup::find($id);

        if (!$customFieldGroup) {
            abort(404);
        }

        // TODO update

        return redirect()->route('admin.dev.post-types.index')
            ->with('success', __(':item updated successfully', ['item' => __('Post type')]));
    }


    public function destroy($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $customFieldGroup = EndoCustomFieldGroup::find($id);

        if (!$customFieldGroup) {
            abort(404);
        }

        $customFieldGroup->customFields()->delete();

        $customFieldGroup->delete();
    }


    public function addCustomField()
    {
        $order = request('order', 0);

        $customFieldTypes = config('custom_fields', []);

        if (count($customFieldTypes)) {
            $cfParams = array_first($customFieldTypes)['params'];
        }

        /*try {*/
            $view = view('EndoCore::admin.partials.custom-fields.row', [
                'order' => $order,
                'customFieldTypes' => $customFieldTypes,
                'cfParams' => isset($cfParams) ? $cfParams : null
            ])->render();
        /*} catch (\Throwable $e) {
            abort(500);
        }*/

        $response = [
            'view' => $view
        ];

        return response()->json($response);
    }


    public function changeCustomFieldType()
    {
        $type = request('type', 'text');
        $cfId = request('cf-id');
        $cfgId = request('cfg-id');

        $customFieldTypes = config('custom_fields', []);

        if (count($customFieldTypes)) {
            $cfParams = $customFieldTypes[$type]['params'];
        }

        $params = [
            'cfParams' => isset($cfParams) ? $cfParams : null,
            'order' => $cfId
        ];

        if ($cfId && $cfgId) {
            $customField = EndoCustomField::find($cfId);

            $params['customField'] = $customField;
        }
        /*try {*/
            $view = view('EndoCore::admin.partials.custom-fields.param-rows', $params)->render();
        /*} catch (\Throwable $e) {
            abort(500);
        }*/

        $response = [
            'widget' => $view
        ];

        return response()->json($response);
    }
}