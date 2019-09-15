<div id="cf{{ ($custom_field) ? $custom_field->id : '' }}" class="col-lg-12 m-auto param multiple-param">
    <div class="flex-row">
        <label class="col-md-2 col-form-label">
            {{ __($title) }}
            @if ($instruccions)
                <br><small>@Lang($instruccions)</small>
            @endif
        </label>
        <div class="col-md-10" style="display: flex;align-items: center; padding: 0 20px;">
            <div class="form-check">
                <label class="form-check-label">
                    <input type='hidden' value="0" name="{{ $name }}">
                    <input
                        class="form-check-input"
                        name="{{ $name }}"
                        type="checkbox"
                        value="1"
                        {{ ($value != '0') ? 'checked' : '' }} />
                        
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>