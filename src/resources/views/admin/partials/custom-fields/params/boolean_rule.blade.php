@php
$cfg = \App\Models\CustomFieldGroup::find($custom_field->cfg_id);
$fields = $cfg->fields;
// Eliminem el camp actual
$fields = $fields->filter(function($value, $key) use ($custom_field) {
    return $value->id != $custom_field->id;
});

@endphp


<div id="cf{{ ($custom_field) ? $custom_field->id : '' }}" class="col-lg-12 param post_object-param">
    <div class="flex-row">
        <label class="col-md-2 col-form-label">
            {{ __($title) }}
            @if ($instruccions)
                <br><small>@Lang($instruccions)</small>
            @endif
        </label>
        <div class="col-md-10" style="padding: 0 20px;">
            <div class="form-group">
                <select
                    style="margin-right: 40px;"
                    name="{{ $name }}"
                    class="selectpicker"
                    data-live-search="true"
                    data-style="btn btn-primary">
                    <option value="0" {{ ($value == 0) ? 'selected' : '' }}>@Lang('None')</option>
                    @foreach($fields as $id => $field)
                        <option value="{{ $field->id }}" {{ ($value == $field->id) ? 'selected' : '' }}>{{ $field->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>