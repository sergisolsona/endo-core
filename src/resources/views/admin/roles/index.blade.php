@extends('EndoCore::admin.layout.main')

@section('title', __('Roles'))

@section('page_header', __('Roles'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="{{ route('admin.dev.roles.create') }}" class="btn btn-primary js-click">@lang('Add')</a>
                    </div>
                    <h2>{{ !isset($title) ? __('Roles') : $title }}</h2>
                    <h3 class="font-bold no-margins">@lang('Total :items', ['items' => 'Roles']): {{ number_format($roles->count()) }}</h3>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="sorting{{ $orderBy == 'name' ? "_$orderDirection" : '' }} js-sort" data-sort="name" data-direction="{{ ($orderBy == 'name' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Name') <span></span></th>
                                <th class="sorting{{ $orderBy == 'level' ? "_$orderDirection" : '' }} js-sort" data-sort="level" data-direction="{{ ($orderBy == 'level' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Level')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td style="width: 38%">
                                        <strong>{{ $role->name }}</strong>
                                    </td>
                                    <td>{{ $role->level }}</td>
                                    <td>
                                        <a class="table-action js-click" href="{{ route('admin.dev.roles.edit', ['id' => $role->id]) }}"><i class="fa fa-pencil"></i></a>
                                        <a class="table-action js-delete-entity"
                                           data-entity-message="@lang('Delete :item', ['item' => __(':lang language', ['lang' => $role->name])])"
                                           data-url="{{ route('admin.dev.roles.destroy', ['id' => $role->id]) }}"
                                           data-redirect="{{ route('admin.dev.roles.index') }}"
                                           data-token="{{ csrf_token() }}"
                                           href="#"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection