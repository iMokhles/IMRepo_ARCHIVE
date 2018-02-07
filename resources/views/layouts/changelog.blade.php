<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'IMRepo') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('iOS7-CSS/ios7.min.css') }}">
    @yield('after_styles')
</head>
<body class="package">
<header role="banner">
    <a href="/" title="Home">
        <svg class="icon icon-home">
            <use xlink:href="/img/icons.svg?rev=2#icon-home"></use>
        </svg>
    </a>
    <h1>@yield('header_title')</h1>
</header>
<main id="content" role="main">
    @yield('changelogs')
</main>

    <!-- Scripts -->
    <script src="{{ asset('iOS7-CSS/ios7.min.js') }}"></script>

    @yield('after_scripts')
</body>
</html>
