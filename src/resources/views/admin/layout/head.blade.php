<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Admin Endo | @yield('title')</title>

<link href="{{ mix('css/app.css', 'vendor/endo') }}" rel="stylesheet">

<link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
<link rel="icon" href="/img/favicon.png" type="image/x-icon">

<style>
    @php($color = endo_setting('site_color', '#f2cc0d'))
    @php($activeColor = active_color($color))

    .nav > li.active {
        border-left: 4px solid {{ $color }};
    }

    .top-navigation .navbar-brand {
        background: {{ $color }};
    }

    .btn-primary.btn-outline, a {
        color: {{ $color }}
    }

    .btn-primary, .btn-primary:focus, .btn-primary:hover {
        background-color: {{ $color }};
        border-color: {{ $color }};
    }

    .btn-primary.active, .btn-primary:active, .btn-primary.active:focus, .btn-primary:active:focus, .btn-primary.active:hover, .btn-primary:active:hover, .open .dropdown-toggle.btn-primary,
    .btn-primary.active[disabled], .btn-primary.disabled, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.disabled:hover, .btn-primary[disabled], .btn-primary[disabled]:active, .btn-primary[disabled]:focus, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary, fieldset[disabled] .btn-primary.active, fieldset[disabled] .btn-primary:active, fieldset[disabled] .btn-primary:focus, fieldset[disabled] .btn-primary:hover{
        background-color: {{ $activeColor }};
        border-color: {{ $activeColor }};
    }

    .pace .pace-progress {
        background: {{ $color }};
    }

    .form-control:focus, .single-line:focus {
        border-color: {{ $color }} !important
    }

    .has-success .form-control {
        border-color: {{ $color }}
    }

    .has-success .control-label {
        color: {{ $color }}
    }

    .text-info {
        color: {{ $color }} !important;
    }

    .sk-spinner-double-bounce .sk-double-bounce1, .sk-spinner-double-bounce .sk-double-bounce2 {
        background-color: {{ $color }};
    }

    .landing-page .btn-primary {
        background-color: {{ $color }};
        border-color: {{ $color }};
    }

    .landing-page .btn-primary.active, .landing-page .btn-primary:active, .landing-page .btn-primary:focus, .landing-page .btn-primary:hover, .landing-page .open .dropdown-toggle.btn-primary {
        background-color: {{ $activeColor }};
        border-color: {{ $activeColor }};
    }
</style>

@yield('head_metas')

