<div id="cf{{ ($custom_field) ? $custom_field->id : '' }}" class="col-lg-12 param m-auto required-param">
    <div class="flex-row">
        <div class="form-group">
            <label class="col-sm-2 control-label">@lang($title)
            @if ($instruccions)
                <br><small>@lang($instruccions)</small>
            @endif
            </label>
            <input type="hidden" value="0" name="{{ $name }}">
            <div class="col-sm-10" style="display: flex;align-items: center; padding: 0 20px;">
                <div class="input-group m-b">
                    <div class="checkbox icheck-success">
                        <input type="checkbox" id="{{ $name }}" name="{{ $name }}" {{ ($value != '0') ? 'checked' : '' }}/>
                        <label for="{{ $name }}"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>