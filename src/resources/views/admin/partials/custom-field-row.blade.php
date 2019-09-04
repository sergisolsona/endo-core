<input type="hidden" name="fields[{{ $customField->id }}][field_id]" value="{{ $customField->id }}">
<div class="cf-item" data-order="{{ $customField->order }}">
    <li class="li-field-order"><span>{{ $customField->order }}</span></li>
    <li class="li-field-label"><input type="text" class="form-control" name="fields[{{ $customField->id }}][field_title]" placeholder="@lang('Title')" value="{{ $customField->title }}"></li>
    <li class="li-field-name"><input type="text" class="form-control" name="fields[{{ $customField->id }}][field_name]" placeholder="@lang('Name')"  value="{{ $customField->name }}"></li>
    <li class="li-field-type"></li>
    <li class="li-field-params" data-toggle="collapse" data-target="#{{ $f->id }}" aria-expanded="false" aria-controls="{{ $f->id }}"><i class="fa fa-angle-down"></i></li>
</div>