<ul class="list-unstyled hstack gap-1 mb-0 justify-content-end">
    @foreach ($actions as $action)
        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $action->getLabel() }}">
            {{ $action->setItem($model) }}
        </li>
    @endforeach
</ul>
