<span data-action="{{ $action->getName() }}" data-href="{{ $action->getUrl() }}">
    @if ($icon = $action->getIcon())
        <i class="{{ $action->getIcon() }}"></i>
    @endif

    {{ $action->getLabel() }}
</span>
