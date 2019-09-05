<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 04/09/2019
 * Time: 13:23
 */

namespace Endo\EndoCore\App\Http\Controllers\Admin;


use Endo\EndoCore\App\Http\Controllers\EndoBaseController;
use Endo\EndoCore\App\Models\EndoRole;
use Endo\EndoCore\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends EndoBaseController
{

    public function index()
    {
        $sort    = explode('-', request('sort', 'id-asc'));

        $orderBy        = $sort[0];
        $orderDirection = $sort[1];

        $users = User::with(['endoRole'])->get();

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
        $authUser = request('user', auth()->user());

        $roles = EndoRole::where('level', '<=', $authUser->endoRole->level)->get();

        return view('EndoCore::admin.users.edit', compact('roles'));
    }


    public function store()
    {
        $this->validator(request()->all())->validate();

        User::create([
            'name' => request()->input('name'),
            'lastname' => request()->input('lastname'),
            'email' => request()->input('email'),
            'password' => Hash::make(request()->input('password')),
            'endo_role_id' => request()->input('role_id')
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', __(':item created successfully', ['item' => __('User')]));
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

        $authUser = request('user', auth()->user());

        $roles = EndoRole::where('level', '<=', $authUser->endoRole->level)->get();

        return view('EndoCore::admin.users.edit', compact('user', 'roles'));
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

        $updParams = [
            'name' => request()->input('name'),
            'lastname' => request()->input('lastname'),
            'email' => request()->input('email'),
            'endo_role_id' => request()->input('role_id')
        ];

        $pass = request()->input('password');
        if ($pass && $pass != request()->input('password_confirmation')) {
            return redirect()->back()->with('error', __('passwords.password'));
        }

        $updParams['password'] = Hash::make($pass);

        $user->update($updParams);

        return redirect()->route('admin.users.index')
            ->with('success', __(':item updated successfully', ['item' => __('User')]));
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


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}