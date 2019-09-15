@extends('EndoCore::admin.layout.main')

@section('title', __('Custom fields'))

@section('page_header', isset($customFieldGroup) ? __('Editing :item', ['item' => __('custom field')]) : __('Creating new :item', ['item' => __('custom field')]))

@section('content')
    <form class="form-horizontal form-edit-add" role="form" method="POST"
          action="@if(isset($customFieldGroup)){{ route('admin.dev.post-types.update', ['id' => $customFieldGroup->id]) }}@else{{ route('admin.dev.post-types.store') }}@endif" >
        @csrf

        @if(isset($customFieldGroup))
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
                            <div class="col-sm-8"><input class="form-control" type="text" name="name" required value="@if(isset($customFieldGroup)){{ $customFieldGroup->name }}@else{{ old('name') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Translatable'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="translatable" name="translatable" @if((isset($customFieldGroup) && $customFieldGroup->translatable) || !isset($customFieldGroup))checked @endif/>
                                        <label for="translatable"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Position'):</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" name="position">
                                    @foreach($templatePositions as $templatePosition)
                                        <option value="{{ $templatePosition }}" @if (isset($customFieldGroup) && $customFieldGroup->position == $templatePosition) SELECTED @endif>@lang(ucfirst($templatePosition))</option>
                                    @endforeach
                                </select>
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
                        <h5>@lang('Fields')</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="table">
                            <ul class="thead">
                                <li class="li-field-order">@lang('Order')</li>
                                <li class="li-field-label">@lang('Title')</li>
                                <li class="li-field-name">@lang('Name')</li>
                                <li class="li-field-type">@lang('Type')</li>
                                <li class="li-field-params"></li>
                            </ul>
                            <ul class="sortable tbody sortable-parent js-custom-field">
                                @if (isset($customFieldGroup))
                                    @foreach ($customFieldGroup->customFields->sortBy('order') as $customField)
                                        @include('EndoCore::partials.custom-fields.row', [
                                            'customField' => $customField,
                                            'order' => $customField->order,
                                            'customFieldTypes' => $customFieldTypes,
                                            'cfParams' => $customField
                                        ])
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="ibox-footer">
                        <div class="ml-auto">
                            <button type="button" rel="tooltip" class="btn btn-sm btn-primary js-add-field" data-add-url="{{ route('admin.dev.custom-fields.add-new') }}">
                                @lang('Add')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-2">
                        <a class="btn btn-white js-click" href="{{ route('admin.dev.post-types.index') }}">@lang('Cancel')</a>
                        <button class="btn btn-primary" type="submit">{{ isset($customFieldGroup) ? __('Save') : __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection