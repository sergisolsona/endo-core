<div id="cf{{ ($custom_field) ? $custom_field->id : '' }}" class="col-lg-12 param permission-param">
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
                    <option value="no_restriction" {{ ($value == 'no_restriction') ? 'selected' : '' }}>@Lang('No Restriction')</option>
                    <option value="only_yours" {{ ($value == 'only_yours') ? 'selected' : '' }}>@Lang('Only Yours')</option>
                </select>
            </div>
        </div>
    </div>
</div>