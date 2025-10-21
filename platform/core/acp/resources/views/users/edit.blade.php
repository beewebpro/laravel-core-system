@extends('core/base::layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                @if ($canChangeProfile)
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#profile" role="tab">
                            <span><i class="bx bx-user font-size-16 align-middle me-2"></i></span>
                            <span>{{ trans('core/acp::user.profile') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#change-password" role="tab">
                            <span><i class="bx bx-key font-size-16 align-middle me-2"></i></span>
                            <span>{{ trans('core/acp::user.update_password') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#change-avatar" role="tab">
                            <span><i class="bx bx-key font-size-16 align-middle me-2"></i></span>
                            <span>{{ trans('core/acp::user.avatar') }}</span>
                        </a>
                    </li>
                @endif
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-3 pb-3 text-muted">
                @if ($canChangeProfile)
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        {!! $profileForm !!}
                    </div>
                    <div class="tab-pane" id="change-password" role="tabpanel">
                        {!! $changePasswordForm !!}
                    </div>
                    <div class="tab-pane" id="change-avatar" role="tabpanel">
                        @include('core/acp::users.avatar')
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
