@if ( $custom_field )

    @php($objects = [])
    @foreach($cfg as $cfg)
        @foreach($cfg->fields as $field)
            @if ($field->type == 'selection')
                @php( $params = json_decode($field->params) )
                @if (isset($params->post_object))
                    @php( $objects[] = $params->post_object )
                @endif
            @endif
        @endforeach
    @endforeach


    @php($params = json_decode($custom_field->params))
    {{-- Custom Post Habitaciones (Alojamiento Habitaciones) --}}
    @if (isset($params->post_object))
        @php($post_object = \App\Models\CustomPost::find($params->post_object))
    @endif

    @php($fields = [])
    @if (isset($post_object))
        @foreach($post_object->getCFG() as $cfg)
            @foreach($cfg->fields as $cf)
                @if ($cf->type == 'selection')
                    @php( $par = json_decode($cf->params) )
                    @if (isset($par->post_object))
                        @php( $aux = \App\Models\CustomPost::find($par->post_object) )
                        @if (!empty($aux->id) && in_array($aux->id, $objects))
                            @php($fields[] = $cf)
                        @endif
                    @endif
                @endif
            @endforeach
        @endforeach
    @endif

    <div id="cf{{ $custom_field->id }}" class="col-lg-12 param parent-param">
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
                        <option value="0" {{ ($value == '') ? 'selected' : '' }}>@Lang('No Relationship')</option>
                        @foreach($fields as $field)
                            @if ($field->type == 'selection')
                                <option value="{{ $field->id }}" {{ ($value == $field->id) ? 'selected' : '' }}>{{ $field->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endif