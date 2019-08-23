@if (isset($breadcrumbs))
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $key => $page)
            @if(array_key_exists('url', $page))
                <li>
                    <a class="js-click" href="{{ $page['url'] }}">{{ $page['text'] }}</a>
                </li>
            @else
                <li class="active">
                    <strong>{{ $page['text'] }}</strong>
                </li>
            @endif
        @endforeach
    </ol>
@endif