@extends('core/base::layouts.auth')

@section('title')
    {{ trans('core/acp::auth.login_title') }}
@endsection

@section('content')
    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="index" class="d-block auth-logo">
                                        <img src="{{ URL::asset('vendor/core/core/base/images/logo-dark.png') }}"
                                            alt="" height="18" class="auth-logo-dark">
                                        <img src="{{ URL::asset('vendor/core/core/base/images/logo-light.png') }}"
                                            alt="" height="18" class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">
                                    <div>
                                        <h5 class="text-primary">
                                            {{ trans('core/acp::auth.login.welcome') }}
                                        </h5>
                                    </div>

                                    <div class="mt-4">
                                        <form action="{{ route('access.login') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username"
                                                    class="form-label">{{ trans('core/acp::auth.form.username') }}</label>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" id="username" value="{{ old('username') }}"
                                                    placeholder="{{ trans('core/acp::auth.form.placeholder_username') }}"
                                                    tabindex="1">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    <a href="auth-recoverpw-2"
                                                        class="text-muted">{{ trans('core/acp::auth.form.forgot_password') }}</a>
                                                </div>
                                                <label
                                                    class="form-label">{{ trans('core/acp::auth.form.password') }}</label>
                                                <div
                                                    class="input-group auth-pass-inputgroup  @error('password') is-invalid @enderror">
                                                    <input type="password" name="password"
                                                        class="form-control  @error('password') is-invalid @enderror"
                                                        placeholder="{{ trans('core/acp::auth.form.placeholder_password') }}"
                                                        aria-label="Password" aria-describedby="password-addon"
                                                        tabindex="2">
                                                    <button class="btn btn-light " type="button" id="password-addon"><i
                                                            class="mdi mdi-eye-outline"></i></button>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input me-1" type="checkbox" name="remember"
                                                    id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    {{ trans('core/acp::auth.form.remember_me') }}
                                                </label>
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit"
                                                    tabindex="3">
                                                    {{ trans('core/acp::auth.btn.login') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        BNG. Crafted by BNG Tech
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
@endsection
