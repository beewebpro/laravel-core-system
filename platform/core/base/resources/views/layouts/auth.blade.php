<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | BNG System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="BNG System" name="description" />
    <meta content="BNG" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('vendor/core/core/base/images/favicon.ico') }}">
    @include('core/base::layouts.head-css')
</head>

<body class="auth-body-bg">

    @yield('content')

    @include('core/base::layouts.vendor-scripts')
</body>

</html>
