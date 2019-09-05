@extends('EndoCore::admin.layout.main')

@section('title', __('Users'))

@section('page_header', __('Users'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary js-click">@lang('Add')</a>
                    </div>
                    <h2>{{ !isset($title) ? __('Users') : $title }}</h2>
                    <h3 class="font-bold no-margins">@lang('Total :items', ['items' => 'Users']): {{ number_format($users->count()) }}</h3>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="sorting{{ $orderBy == 'name' ? "_$orderDirection" : '' }} js-sort" data-sort="name" data-direction="{{ ($orderBy == 'name' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Name') <span></span></th>
                                <th class="sorting{{ $orderBy == 'email' ? "_$orderDirection" : '' }} js-sort" data-sort="email" data-direction="{{ ($orderBy == 'email' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Email')</th>
                                <th class="sorting{{ $orderBy == 'role' ? "_$orderDirection" : '' }} js-sort" data-sort="role" data-direction="{{ ($orderBy == 'role' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Role')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="width: 38%">
                                        <strong>{{ $user->name }}</strong>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->endoRole->name }}</td>
                                    <td>
                                        <a class="table-action js-click" href="{{ route('admin.users.edit', ['id' => $user->id]) }}"><i class="fa fa-pencil"></i></a>
                                        <a class="table-action js-delete-entity"
                                           data-entity-message="@lang('Delete :item', ['item' => __(':lang language', ['lang' => $user->name])])"
                                           data-url="{{ route('admin.users.destroy', ['id' => $user->id]) }}"
                                           data-redirect="{{ route('admin.users.index') }}"
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