<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> {{ PageTitle::getTitle() }} BNG System</title>
    @if ($csrfToken = csrf_token())
        <meta name="csrf-token" content="{{ $csrfToken }}">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BNG System" name="description" />
    <meta content="BNG" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('vendor/core/core/base/images/favicon.ico') }}">
    @routes
    @include('core/base::layouts.head-css')
    @stack('header')
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('core/base::layouts.partials.topbar')
        @include('core/base::layouts.partials.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    {{ Breadcrumb::default() }}
                    @yield('content')
                </div>
            </div>
            @include('core/base::layouts.partials.footer')
        </div>
    </div>
    @include('core/base::layouts.vendor-scripts')
</body>

</html>
