@extends('EndoCore::admin.layout.main')

@section('title', __('Post types'))

@section('page_header', __('Post types'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="{{ route('admin.dev.post-types.create') }}" class="btn btn-primary js-click">@lang('Add')</a>
                    </div>
                    <h2>{{ !isset($title) ? __('Post types') : $title }}</h2>
                    <h3 class="font-bold no-margins">@lang('Total :items', ['items' => 'Post types']): {{ number_format($postTypes->count()) }}</h3>
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
                            @foreach($postTypes as $postType)
                                <tr>
                                    <td style="width: 38%">
                                        <strong>{{ $postType->name }}</strong>
                                    </td>
                                    <td>{{ $postType->url_name }}</td>
                                    <td>
                                        <a class="table-action js-click" href="{{ route('admin.dev.post-types.edit', ['id' => $postType->id]) }}"><i class="fa fa-pencil"></i></a>
                                        <a class="table-action js-delete-entity"
                                           data-entity-message="@lang('Delete :item', ['item' => __(':lang language', ['lang' => $postType->name])])"
                                           data-url="{{ route('admin.dev.post-types.destroy', ['id' => $postType->id]) }}"
                                           data-redirect="{{ route('admin.dev.post-types.index') }}"
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