<!doctype html>
<html lang="pt">
<head>
    <!-- metas -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <!-- links -->
    <link type="text/css" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link type="text/css" href="{{ mix('css/app.css') }}" rel="stylesheet" />
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <div id="app">
        <header id="app-header">
            @yield('header')
        </header>
        <main id="app-main">
            @yield('content')
        </main>
        <footer id="app-footer">
            @yield('footer')
        </footer>
    </div>
</body>
</html>
