<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    @vite(['resources/css/auth.css', 'resources/js/app.js'])
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
