<!DOCTYPE html>
<html>

<head>
    @include('EndoCore::admin.layout.head')
</head>

<body class="fixed-sidebar @if(!auth()->user() && !request('a_usuario'))gray-bg @endif">
@yield('body')

@include('EndoCore::admin.layout.foot_scripts')
</body>
</html>