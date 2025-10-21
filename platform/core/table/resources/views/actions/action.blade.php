@php
    $attributes = '';
    if ($action->isAction()) {
        $attributes .= ' data-dt-single-action ';
        $attributes .= ' data-method=' . $action->getActionMethod();
    }
    if ($action->isConfirmation()) {
        $confirm = $action->isConfirmation() ? 'true' : 'false';
        $attributes .= ' data-confirmation-modal=' . $confirm;
    }
@endphp

<a href="{{ $action->hasUrl() ? $action->getUrl() : 'javascript:void(0);' }}" @class(['btn', 'btn-sm', $action->getColor()])
    {{ $attributes }}>
    @if ($action->getIcon())
        <i class="{{ $action->getIcon() }} font-size-16 align-middle @if ($action->getLabel()) me-1 @endif"></i>
    @endif
    @if ($action->getLabel())
        {{ $action->getLabel() }}
    @endif
</a>
