{{-- PARAM HEADER --}}
<div id="cf{{ ($f) ? $f->id : '' }}" class="col-lg-12 m-auto param repeater-param">
    <div class="flex-row">
        <label class="col-md-2 col-form-label">
            {{ __('Rows') }}
        </label>
        <div class="col-md-10" style="display: flex;align-items: center; padding: 0 20px; flex-wrap: wrap;">
{{-- end PARAM HEADER --}}

<div class="table">
    <ul class="thead">
        <li class="li-field-order">@Lang('Order')</li>
        <li class="li-field-label">@Lang('Title')</li>
        <li class="li-field-name">@Lang('Name')</li>
        <li class="li-field-type">@Lang('Type')</li>
        <li class="li-field-params"></li>
    </ul>
    <ul class="sortable accordion tbody sortable-child">
        @php ($k2 = 0)
        @foreach ( $f->fields as $k2 => $f2 )
            @php ($k += $k2 + 1)
            <div class="cf-item" data-order="{{$f2->order}}">
                <div class="cf-row">
                    <input class="id" type="hidden" name="fields[{{ $f2->id }}][field_id]" value="{{ $f2->id }}">
                    <input type="hidden" name="fields[{{ $f2->id }}][parent_id]" value="{{ $f2->parent_id }}">
                    <input class="order" type="hidden" name="fields[{{ $f2->id }}][field_order]" value="{{ $f2->order }}">
                    <li class="li-field-order"><span>{{ $k2 }}</span></li>
                    <li class="li-field-label"><input id="field_title" type="text" class="form-control" name="fields[{{ $f2->id }}][field_title]" placeholder="@Lang('Title')" value="{{ $f2->title }}"></li>
                    <li class="li-field-name"><input id="field_name" type="text" class="form-control" name="fields[{{ $f2->id }}][field_name]" placeholder="@Lang('Name')"  value="{{ $f2->name }}"></li>
                    <li class="li-field-type">
                        <!-- Ajax per obtenir els tipus de dades?  -->
                        <select class="selectpicker" data-size="7" name="fields[{{ $f2->id }}][field_type]" data-style="btn btn-primary" title="@Lang('Type')" data-live-search="true">
                            <option value="text" {{ $f2->type == 'text' ? 'selected' : '' }}>@Lang('Text')</option>
                            <option value="textarea" {{ $f2->type == 'textarea' ? 'selected' : '' }}>@Lang('Textarea')</option>
                            <option value="date" {{ $f2->type == 'date' ? 'selected' : '' }}>@Lang('Date')</option>
                            <option value="number" {{ $f2->type == 'number' ? 'selected' : '' }}>@Lang('Number')</option>
                            <option value="media" {{ $f2->type == 'media' ? 'selected' : '' }}>@Lang('Media')</option>
                            <option value="form" {{ $f2->type == 'form' ? 'selected' : '' }}>@Lang('Form')</option>
                            <option value="multiple_switch" {{ $f2->type == 'multiple_switch' ? 'selected' : '' }}>@Lang('Multiple Selection')</option>
                            <option value="gallery" {{ $f2->type == 'gallery' ? 'selected' : '' }}>@Lang('Gallery')</option>
                            <option value="selection" {{ $f2->type == 'selection' ? 'selected' : '' }}>@Lang('Selection')</option>
                            <option value="gmaps" {{ $f2->type == 'gmaps' ? 'selected' : '' }}>@Lang('Google Maps')</option>
                            <option value="boolean" {{ $f2->type == 'boolean' ? 'selected' : '' }}>@Lang('Boolean')</option>
                            <option value="repeater" {{ $f2->type == 'repeater' ? 'selected' : '' }}>@Lang('Repeater')</option>
                        </select>
                    </li>
                    <li class="li-field-params" data-toggle="collapse" data-target="#{{ $f2->id }}" aria-expanded="false" aria-controls="{{ $f->id }}"><i class="material-icons">keyboard_arrow_down</i></li>
                </div>

                <div id="{{ $f2->id }}" class="params-content collapse">
                    <input type="hidden" name="fields[{{ $k2 }}][parent_id]" value="{{ $f2->id }}" />
                    @if ( $f2->type == 'repeater' )
                        @includeIf('Admin::default.custom_fields_params.repeater', ['item' => $item, 'k' => $k2, 'f' => $f2])
                    @endif

                    {{-- Renderitzem els parametres --}}
                    @foreach($f2->getParams() as $param)
                        @php($parametre = new $param($f2))
                        @php($parametre->setName('fields['.$k2.'][params]['. $parametre->getId() .']'))

                        {!! $parametre->getField() !!}
                    @endforeach
                    <div class="row2">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-lg-8">
                            <button onclick="remove_row(this);" type="button" rel="tooltip" class="btn btn-sm btn-primary">
                                @Lang('Delete')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
    
    <div class="hidden" style="display:none;"></div>
    <div id="status"></div>
</div>

<div class="ml-auto">
    <button data-is_child=true data-parent_id={{ $f->id }} type="button" rel="tooltip" class="btn btn-sm btn-primary add_field">
        @Lang('Add')
    </button>
</div>

{{-- PARAM FOOTER --}}
        </div>
    </div>
</div>
{{-- end PARAM FOOTER --}}