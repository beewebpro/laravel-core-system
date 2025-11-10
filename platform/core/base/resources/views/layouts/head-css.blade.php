@yield('css')

<!-- Bootstrap Css -->
<link href="{{ URL::asset('vendor/core/core/base/css/bootstrap.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('vendor/core/core/base/css/icons.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('vendor/core/core/base/css/app.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<script src="{{ URL::asset('vendor/core/core/base/libs/jquery/jquery.min.js') }}"></script>

@yield('head-js')
{!! Assets::renderHeader() !!}
