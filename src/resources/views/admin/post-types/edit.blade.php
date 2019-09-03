@extends('EndoCore::admin.layout.main')

@section('title', __('Post types'))

@section('page_header', isset($postType) ? __('Editing :item', ['item' => __('post type')]) : __('Creating new :item', ['item' => __('post type')]))

@section('content')
    <form class="form-horizontal form-edit-add" role="form" method="POST"
          action="@if(isset($postType)){{ route('admin.dev.post-types.update', ['id' => $postType->id]) }}@else{{ route('admin.dev.post-types.store') }}@endif" >
        @csrf

        @if(isset($postType))
            <input type="hidden" name="_method" value="PUT">
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('General settings')</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Name'):</label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="name" required value="@if(isset($postType)){{ $postType->name }}@else{{ old('name') }}@endif"/></div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Translatable'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="translatable" name="translatable" class="js-translatable-checkbox" @if((isset($postType) && $postType->translatable) || !isset($postType))checked @endif/>
                                        <label for="translatable"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="js-non-translatable" @if((isset($postType) && $postType->translatable) || !isset($postType))style="display: none"@endif>
                            @php ($nonLocalePostType = isset($postType) ? $postType->translations->where('locale', null)->first() : null)
                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('Title'):</label>
                                <div class="col-sm-8"><input class="form-control" type="text" name="title" value="@if($nonLocalePostType){{ $nonLocalePostType->title }}@else{{ old('title') }}@endif"/></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('Title plural'):</label>
                                <div class="col-sm-8"><input class="form-control js-sluggify" data-target="url_name" type="text" name="title_plural" value="@if($nonLocalePostType){{ $nonLocalePostType->title_plural }}@else{{ old('title_plural') }}@endif"/></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">@lang('Url name'):</label>
                                <div class="col-sm-8"><input id="url_name" class="form-control" type="text" name="url_name" value="@if($nonLocalePostType){{ $nonLocalePostType->url_name }}@else{{ old('url_name') }}@endif"/></div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Show image'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="show_image" name="show_image" @if(isset($postType) && $postType->show_image)checked @endif/>
                                        <label for="show_image"></label>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">@lang('Show content'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="show_content" name="show_content" @if(isset($postType) && $postType->show_content)checked @endif/>
                                        <label for="show_content"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Show author'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="show_author" name="show_author" @if(isset($postType) && $postType->show_author)checked @endif/>
                                        <label for="show_author"></label>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-2 control-label">@lang('Show parent'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="show_parent" name="show_parent" @if(isset($postType) && $postType->show_parent)checked @endif/>
                                        <label for="show_parent"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('Show published'):</label>
                            <div class="col-sm-4">
                                <div class="input-group m-b">
                                    <div class="checkbox icheck-success">
                                        <input type="checkbox" id="show_published" name="show_published" @if(isset($postType) && $postType->show_published)checked @endif/>
                                        <label for="show_published"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="js-translatable">
            @foreach($locales as $locale)
                @php ($localePostType = isset($postType) ? $postType->translations->where('locale', $locale->code)->first() : null)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>@lang('Locale settings'): {{ $locale->name }}</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('Title'):</label>
                                    <div class="col-sm-8"><input class="form-control" type="text" name="locales[{{ $locale->code }}][title]" value="@if($localePostType){{ $localePostType->title }}@else{{ old('locales[' . $locale->code . '][title]') }}@endif"/></div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('Title plural'):</label>
                                    <div class="col-sm-8"><input class="form-control js-sluggify" data-target="url_name_{{ $locale->code }}" type="text" name="locales[{{ $locale->code }}][title_plural]" value="@if($localePostType){{ $localePostType->title_plural }}@else{{ old('locales[' . $locale->code . '][title_plural]') }}@endif"/></div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('Url name'):</label>
                                    <div class="col-sm-8"><input id="url_name_{{ $locale->code }}" class="form-control" type="text" name="locales[{{ $locale->code }}][url_name]" value="@if($localePostType){{ $localePostType->url_name }}@else{{ old('locales[' . $locale->code . '][url_name]') }}@endif"/></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-2">
                        <a class="btn btn-white js-click" href="{{ route('admin.dev.post-types.index') }}">@lang('Cancel')</a>
                        <button class="btn btn-primary" type="submit">{{ isset($postType) ? __('Save') : __('Create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection