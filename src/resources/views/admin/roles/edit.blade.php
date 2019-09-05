@extends('EndoCore::admin.layout.main')

@section('title', __('Roles'))

@section('page_header', __('Roles'))

@section('content')
    <form class="form-horizontal form-edit-add" role="form" method="POST"
          action="@if(isset($role)){{ route('admin.dev.roles.update', ['id' => $role->id]) }}@else{{ route('admin.dev.roles.store') }}@endif" >
        @csrf

        @if(isset($role))
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
                            <div class="col-sm-8"><input class="form-control" type="text" name="name" required value="@if(isset($role)){{ $role->name }}@else{{ old('name') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Level'):</label>
                            <div class="col-sm-8"><input class="form-control" type="number" step="1" min="0" max="99" name="level" required value="@if(isset($role)){{ $role->level }}@else{{ old('level') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Is dev (access to dev zone)'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="is_dev" name="is_dev" @if((isset($role) && $role->is_dev) || !isset($role))checked @endif/>
                                        <label for="is_dev"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('Permissions')</h5>
                    </div>
                    <div class="ibox-content">
                        <h4><strong>@lang('Route permissions')</strong></h4>
                        @foreach($routes as $key => $routeGroup)
                            <h5>@lang(ucfirst($key))</h5>
                            @foreach($routeGroup as $key => $route)
                                @if ($key % 2 == 0)
                                <div class="form-group">
                                @endif
                                    <label class="col-sm-2 control-label" for="{{ $route }}">{{ $route }}:</label>
                                    <div class="col-sm-4">
                                        <div class="input-group m-b">
                                            <div class="checkbox icheck-success">
                                                <input type="checkbox" id="{{ $route }}" name="permissions[{{ $route }}]" @if(isset($role) && $role->permissions->where('route_name', $route)->first())checked @endif/>
                                                <label for="{{ $route }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                @if ($key % 2 != 0 || last($routeGroup) == $route)
                                </div>
                                @endif
                            @endforeach

                            <div class="hr-line-dashed"></div>
                        @endforeach

                        <h4><strong>@lang('Posts permissions')</strong></h4>
                        @foreach($postTypes as $postType)
                            <h5>@lang(ucfirst($postType->name))</h5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="{{ $postType->name . '_create' }}">@lang('Create'):</label>
                                <div class="col-sm-4">
                                    <div class="input-group m-b">
                                        <div class="checkbox icheck-success">
                                            <input type="checkbox" id="{{ $postType->name . '_create' }}" name="post_permissions[{{ $postType->name }}][create]"
                                                   @if(isset($role) && $role->postPermissions->where('endo_post_type_id', $postType->id)->first() && $role->postPermissions->where('endo_post_type_id', $postType->id)->first()->create)checked @endif/>
                                            <label for="{{ $postType->name . '_create' }}"></label>
                                        </div>
                                    </div>
                                </div>

                                <label class="col-sm-2 control-label" for="{{ $postType->name . '_read' }}">@lang('Read'):</label>
                                <div class="col-sm-4">
                                    <div class="input-group m-b">
                                        <div class="checkbox icheck-success">
                                            <input type="checkbox" id="{{ $postType->name . '_read' }}" name="post_permissions[{{ $postType->name }}][read]"
                                                   @if(isset($role) && $role->postPermissions->where('endo_post_type_id', $postType->id)->first() && $role->postPermissions->where('endo_post_type_id', $postType->id)->first()->read)checked @endif/>
                                            <label for="{{ $postType->name . '_read' }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="{{ $postType->name . '_update' }}">@lang('Update'):</label>
                                <div class="col-sm-4">
                                    <div class="input-group m-b">
                                        <div class="checkbox icheck-success">
                                            <input type="checkbox" id="{{ $postType->name . '_update' }}" name="post_permissions[{{ $postType->name }}][update]"
                                                   @if(isset($role) && $role->postPermissions->where('endo_post_type_id', $postType->id)->first() && $role->postPermissions->where('endo_post_type_id', $postType->id)->first()->update)checked @endif/>
                                            <label for="{{ $postType->name . '_update' }}"></label>
                                        </div>
                                    </div>
                                </div>

                                <label class="col-sm-2 control-label" for="{{ $postType->name . '_delete' }}">@lang('Delete'):</label>
                                <div class="col-sm-4">
                                    <div class="input-group m-b">
                                        <div class="checkbox icheck-success">
                                            <input type="checkbox" id="{{ $postType->name . '_delete' }}" name="post_permissions[{{ $postType->name }}][delete]"
                                                   @if(isset($role) && $role->postPermissions->where('endo_post_type_id', $postType->id)->first() && $role->postPermissions->where('endo_post_type_id', $postType->id)->first()->delete)checked @endif/>
                                            <label for="{{ $postType->name . '_delete' }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="{{ $postType->name . '_publish' }}">@lang('Publish'):</label>
                                <div class="col-sm-4">
                                    <div class="input-group m-b">
                                        <div class="checkbox icheck-success">
                                            <input type="checkbox" id="{{ $postType->name . '_publish' }}" name="post_permissions[{{ $postType->name }}][publish]"
                                                   @if(isset($role) && $role->postPermissions->where('endo_post_type_id', $postType->id)->first() && $role->postPermissions->where('endo_post_type_id', $postType->id)->first()->publish)checked @endif/>
                                            <label for="{{ $postType->name . '_publish' }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-2">
                        <a class="btn btn-white js-click" href="{{ route('admin.dev.roles.index') }}">@lang('Cancel')</a>
                        <button class="btn btn-primary" type="submit">{{ isset($role) ? __('Save') : __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection