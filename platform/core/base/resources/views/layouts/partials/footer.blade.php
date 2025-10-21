<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © BNG.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Develop by BNG
                </div>
            </div>
        </div>
    </div>
</footer>

@push('footer')
    @if (Session::has('success_msg') || Session::has('error_msg') || (isset($errors) && $errors->any()) || isset($error_msg))
        <script type="text/javascript">
            $(function() {
                @if (Session::has('success_msg'))
                    Bng.showSuccess('{!! BaseHelper::cleanToastMessage(session('success_msg')) !!}');
                @endif
                @if (Session::has('error_msg'))
                    Bng.showError('{!! BaseHelper::cleanToastMessage(session('error_msg')) !!}');
                @endif
                @if (isset($error_msg))
                    Bng.showError('{!! BaseHelper::cleanToastMessage($error_msg) !!}');
                @endif
                @if (isset($errors))
                    @foreach ($errors->all() as $error)
                        Bng.showError('{!! BaseHelper::cleanToastMessage($error) !!}');
                    @endforeach
                @endif
            })
        </script>
    @endif
@endpush
