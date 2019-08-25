@extends('EndoCore::admin.layout.main')

@section('title', __('Languages'))

@section('page_header', __('Languages'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a href="{{ route('admin.dev.languages.create') }}" class="btn btn-primary js-click">@lang('Add')</a>
                    </div>
                    <h2>{{ !isset($title) ? __('Languages') : $title }}</h2>
                    <h3 class="font-bold no-margins">@lang('Total languages'): {{ number_format($languages->count()) }}</h3>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="sorting{{ $orderBy == 'name' ? "_$orderDirection" : '' }} js-sort" data-sort="name" data-direction="{{ ($orderBy == 'name' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Name') <span></span></th>
                                <th class="sorting{{ $orderBy == 'code' ? "_$orderDirection" : '' }} js-sort" data-sort="code" data-direction="{{ ($orderBy == 'code' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Code')</th>
                                <th class="sorting{{ $orderBy == 'domain' ? "_$orderDirection" : '' }} js-sort" data-sort="domain" data-direction="{{ ($orderBy == 'domain' && $orderDirection == 'asc') ? 'desc' : 'asc' }}">@lang('Domain') <span></span></th>
                                <th>@lang('Active')</th>
                                <th>@lang('Default')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($languages as $language)
                                <tr>
                                    <td style="width: 38%">
                                        <strong>{{ $language->name }}</strong>
                                    </td>
                                    <td>{{ $language->code }}</td>
                                    <td>{{ $language->domain }}</td>
                                    <td class="{{ $language->active ? 'text-navy' : 'text-danger' }}"><i class="fa {{ $language->active ? 'fa-check' : 'fa-times' }}"></i></td>
                                    <td class="{{ $language->default ? 'text-navy' : 'text-danger' }}"><i class="fa {{ $language->default ? 'fa-check' : 'fa-times' }}"></i></td>
                                    <td>
                                        <a class="table-action js-click" href="{{ route('admin.dev.languages.edit', ['id' => $language->id]) }}"><i class="fa fa-pencil"></i></a>
                                        <a class="table-action js-delete-entity"
                                           data-entity-message="@lang('Delete :item', ['item' => __(':lang language', ['lang' => $language->name])])"
                                           data-url="{{ route('admin.dev.languages.destroy', ['id' => $language->id]) }}"
                                           data-redirect="{{ route('admin.dev.languages.index') }}"
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