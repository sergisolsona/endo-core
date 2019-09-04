@extends('EndoCore::admin.layout.main')

@section('title', __('Custom fields'))

@section('page_header', __('Custom fields'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="{{ route('admin.dev.custom-fields.create') }}" class="btn btn-primary js-click">@lang('Add')</a>
                    </div>
                    <h2>{{ !isset($title) ? __('Custom fields') : $title }}</h2>
                    <h3 class="font-bold no-margins">@lang('Total :items', ['items' => 'Custom fields']): {{ number_format($customFieldGroups->count()) }}</h3>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="sorting{{ $orderBy == 'name' ? "_$orderDirection" : '' }} js-sort" data-sort="name" data-direction="{{ ($orderBy == 'name' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Name') <span></span></th>
                                <th class="sorting{{ $orderBy == 'url_name' ? "_$orderDirection" : '' }} js-sort" data-sort="url_name" data-direction="{{ ($orderBy == 'url_name' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Url name')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customFieldGroups as $customFieldGroup)
                                <tr>
                                    <td style="width: 38%">
                                        <strong>{{ $customFieldGroup->name }}</strong>
                                    </td>
                                    <td>
                                        <a class="table-action js-click" href="{{ route('admin.dev.custom-fields.edit', ['id' => $customFieldGroup->id]) }}"><i class="fa fa-pencil"></i></a>
                                        <a class="table-action js-delete-entity"
                                           data-entity-message="@lang('Delete :item', ['item' => __(':lang language', ['lang' => $customFieldGroup->name])])"
                                           data-url="{{ route('admin.dev.custom-fields.destroy', ['id' => $customFieldGroup->id]) }}"
                                           data-redirect="{{ route('admin.dev.custom-fields.index') }}"
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