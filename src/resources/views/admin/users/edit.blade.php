@extends('EndoCore::admin.layout.main')

@section('title', __('Users'))

@section('page_header', __('Users'))

@section('content')
    <form class="form-horizontal form-edit-add" role="form" method="POST"
          action="@if(isset($user)){{ route('admin.users.update', ['id' => $user->id]) }}@else{{ route('admin.users.store') }}@endif" >
        @csrf

        @if(isset($user))
            <input type="hidden" name="_method" value="PUT">
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('General settings')</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Name'):</label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="name" required value="@if(isset($user)){{ $user->name }}@else{{ old('name') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Lastname'):</label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="lastname" required value="@if(isset($user)){{ $user->lastname }}@else{{ old('lastname') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Email'):</label>
                            <div class="col-sm-8"><input class="form-control" type="email" name="email" required value="@if(isset($user)){{ $user->email }}@else{{ old('email') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Password'):</label>
                            <div class="col-sm-8"><input class="form-control" type="password" name="password"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Confirm password'):</label>
                            <div class="col-sm-8"><input class="form-control" type="password" name="password_confirmation"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Role'):</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b js-name" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if (isset($user) && $user->endoRole->id == $role->id) SELECTED @elseif(old('role_id') == $role->id) SELECTED @endif>@lang(ucfirst($role->name))</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-2">
                        <a class="btn btn-white js-click" href="{{ route('admin.users.index') }}">@lang('Cancel')</a>
                        <button class="btn btn-primary" type="submit">{{ isset($user) ? __('Save') : __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection