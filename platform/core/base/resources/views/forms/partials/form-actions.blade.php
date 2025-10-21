<div class="card">
    <div class="card-header bg-transparent border-bottom text-uppercase">
        <h4 class="card-title">
            {{ trans('core/base::forms.publish') }}
        </h4>
    </div>
    <div class="card-body">
        @include('core/base::forms.partials.form-buttons')
    </div>
</div>

<div data-bb-waypoint data-bb-target="#form-actions"></div>

<header class="top-0 w-100 position-fixed end-0 z-1000" id="form-actions" @style(['display: none'])>
    <div class="navbar">
        <div class="container">
            <div class="row g-2 align-items-center w-100">
                @if (is_in_admin(true))
                    <div class="col">
                        <div class="page-pretitle">
                            {!! Breadcrumb::render('main', PageTitle::getTitle(false)) !!}
                        </div>
                    </div>
                @endif
                <div class="col-auto ms-auto d-print-none">
                    @include('core/base::forms.partials.form-buttons')
                </div>
            </div>
        </div>
    </div>
</header>
