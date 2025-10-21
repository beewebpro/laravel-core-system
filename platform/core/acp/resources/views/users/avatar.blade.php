<div class="crop-image-container">
    <div class="form-group">
        <label>{{ trans('core/acp::user.avatar') }}</label>
        <div class="avatar-view overflow-hidden">
            <img class="image-preview crop-image-original avatar avatar-2xl" src="{{ $user->avatar_url }}"
                alt="{{ trans('core/acp::user.avatar') }}" />
            <div class="backdrop"></div>
            <div class="action">
                <a href="javascript:void(0);" class="text-decoration-none text-white" data-bs-toggle="modal"
                    data-bs-target="#avatar_file-modal">
                    <i class="bx bx-edit-alt"></i>
                </a>
            </div>
        </div>
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#avatar_file-modal" class="d-block mt-1">
            {{ trans('core/base::forms.choose_image') }}
        </a>
    </div>
</div>

@section('css')
    <link href="{{ URL::asset('vendor/core/core/base/css/crop-image.css') }}" rel="stylesheet" type="text/css" />
@endsection
