@extends('EndoCore::admin.layout.main')

@section('title', __('Languages'))

@section('page_header', __('Languages'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ isset($language) ? __('Editing :item', ['item' => __('language')]) : __('Creating new :item', ['item' => __('language')]) }}</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal form-edit-add" role="form" method="POST"
                          action="@if(isset($language)){{ route('admin.dev.languages.update', ['id' => $language->id]) }}@else{{ route('admin.dev.languages.store') }}@endif" >
                        @csrf

                        @if(isset($language))
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Name'):</label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="name" required value="@if(isset($language)){{ $language->name }}@else{{ old('name') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Code'):</label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="code" required value="@if(isset($language)){{ $language->code }}@else{{ old('code') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Domain'):</label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="domain" value="@if(isset($language)){{ $language->domain }}@else{{ old('domain') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-2">
                                <a class="btn btn-white js-click" href="{{ route('admin.dev.languages.index') }}">@lang('Cancel')</a>
                                <button class="btn btn-primary" type="submit">{{ isset($language) ? __('Save') : __('Create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection