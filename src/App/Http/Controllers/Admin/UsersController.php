<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:23
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\Models\User;

class UsersController extends EndoBaseController
{

    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $users = User::all();

        $users = $orderDirection == 'asc' ? $users->sortBy($orderBy, SORT_NATURAL|SORT_FLAG_CASE) :
            $users->sortByDesc($orderBy, SORT_NATURAL|SORT_FLAG_CASE);

        return view('EndoCore::admin.users.index', compact(
            'orderBy',
            'orderDirection',
            'users'
        ));
    }


    public function create()
    {
        return view('EndoCore::admin.users.edit');
    }


    public function store()
    {

    }


    public function edit($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return view('EndoCore::admin.users.edit', compact('user'));
    }


    public function update($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }
    }


    public function destroy($locale, $id = null)
    {
        if (is_numeric($locale) && !$id) {
            $id = $locale;
        }

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $user->delete();
    }
}