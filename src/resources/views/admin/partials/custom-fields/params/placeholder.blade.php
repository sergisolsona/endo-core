<div id="cf{{ ($custom_field) ? $custom_field->id : '' }}" class="col-lg-12 m-auto param placeholder-param">
    <div class="flex-row">
        <label class="col-sm-2 col-form-label">
            {{ __($title) }}
            @if ($instruccions)
                <br><small>@lang($instruccions)</small>
            @endif
        </label>
        <div class="col-sm-10" style="padding: 0 20px;">
            <div class="form-group has-default">
                <input type="text" name="{{ $name }}" class="form-control" value="{{ $value }}">
            </div>
        </div>
    </div>
</div>