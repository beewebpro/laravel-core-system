<div class="btn-list">
    <button type="submit" value="apply" name="submitter" class="btn btn-info waves-effect waves-light">
        <i class="bx bx-save font-size-16 align-middle me-1"></i>
        {{ trans('core/base::forms.save_and_continue') }}
    </button>

    @if (!isset($onlySave) || !$onlySave)
        <button type="submit" name="submitter" value="save" class="btn btn-light waves-effect">
            <i class="bx bx-exit font-size-16 align-middle me-1"></i>
            {{ $saveTitle ?? trans('core/base::forms.save') }}
        </button>
    @endif
</div>
