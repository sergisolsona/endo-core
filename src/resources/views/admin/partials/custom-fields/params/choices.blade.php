<div id="cf{{ ($custom_field) ? $custom_field->id : '' }}" class="col-lg-12 m-auto param">
    <div class="flex-row">
        <label class="col-md-2 col-form-label choices-param">
            {{ __($title) }}
            @if ($instruccions)
                <br><small>@Lang($instruccions)</small>
            @endif
        </label>
        <div class="col-md-10" style="padding: 0 20px;">
            <div class="form-group has-default">
                <textarea
                    name="{{ $name }}"
                    rows="5"
                    class="form-control">{{ $value }}</textarea>
            </div>
        </div>
    </div>
</div>