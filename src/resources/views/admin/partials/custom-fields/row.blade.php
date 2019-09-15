<div class="custom-field-row">
    @if (isset($customField))
        <input type="hidden" name="fields[{{ $customField->id }}][id]" value="{{ $customField->id }}">
    @endif
    <div class="cf-item" data-order="{{ isset($customField) ? $customField->order : $order }}">
        <div class="cf-row" aria-expanded="false">
            <li class="li-field-order"><span>{{ isset($customField) ? $customField->order : $order }}</span></li>
            <li class="li-field-label"><input type="text" class="form-control" name="fields[{{ isset($customField) ? $customField->id : $order }}][title]" placeholder="@lang('Title')" value="{{ isset($customField) ? $customField->title : '' }}"></li>
            <li class="li-field-name"><input type="text" class="form-control" name="fields[{{ isset($customField) ? $customField->id : $order }}][name]" placeholder="@lang('Name')"  value="{{ isset($customField) ? $customField->name : '' }}"></li>
            <li class="li-field-type">
                <select data-size="7" class="form-control js-custom-field-types" name="fields[{{ isset($customField) ? $customField->id : $order }}][type]" title="@lang('Type')" data-live-search="true" data-change-url="{{ route('admin.dev.custom-fields.change-type') }}" data-cf-id="{{ isset($customField) ? $customField->id : $order }}" data-cfg-id="{{ isset($customField) ? $customField->endo_custom_field_group_id : 0 }}">
                    @foreach($customFieldTypes as $key => $customFieldType)
                        <option value="{{ $key }}" @if (isset($customField) && $key == $customField->type) SELECTED @endif>@lang($customFieldType['name'])</option>
                    @endforeach
                </select>
            </li>
            <li class="li-field-params js-params-toggle" aria-expanded="false"><i class="fa fa-angle-down"></i></li>
        </div>
    </div>

    <div class="params-content collapse js-params-content form-horizontal">
        <div class="row">
            <div class="col-md-12">
                <div class="js-param-rows">
                    @include('EndoCore::admin.partials.custom-fields.param-rows')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-8 col-md-3">
                <button type="button" rel="tooltip" class="btn btn-sm btn-primary pull-right js-params-delete">
                    @lang('Delete')
                </button>
            </div>
        </div>
    </div>
</div>