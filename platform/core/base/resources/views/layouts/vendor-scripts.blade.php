<!-- JAVASCRIPT -->
<script src="{{ URL::asset('vendor/core/core/base/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('vendor/core/core/base/libs/metismenu/metismenu.min.js') }}"></script>
<script src="{{ URL::asset('vendor/core/core/base/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('vendor/core/core/base/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('vendor/core/core/base/js/main.js') }}"></script>
<script src="{{ URL::asset('vendor/core/core/base/js/base.js') }}"></script>

@yield('script')

@stack('footer')

<!-- App js -->
<script src="{{ URL::asset('vendor/core/core/base/js/app.js') }}"></script>

@yield('script-bottom')

{!! Assets::renderFooter() !!}
