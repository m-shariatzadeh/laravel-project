<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bs/bootstrap.min.css') }}">
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    @yield('css')
</head>
<body>

    @yield('content')


{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('js/bs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bs/jquery.min.js.min.js') }}"></script>
    <script src="{{ asset('js/bs/popper.min.js.map') }}"></script>
    @yield('js')
</body>
</html>
