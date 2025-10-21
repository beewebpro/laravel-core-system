<div class="dropdown-submenu">
    <a href="#" class="dropdown-item d-flex justify-content-between">
        <span>{{ trans('core/table::table.bulk_change') }}</span>
        <i class="ti ti-chevron-right ms-auto me-0"></i>
    </a>
    <div class="dropdown-menu">
        @foreach ($bulk_changes as $key => $bulk_change)
            <a href="{{ $url }}" class="dropdown-item bulk-change-item" data-key="{{ $key }}"
                data-class-item="{{ $class }}" data-save-url="{{ $url }}">
                {{ $bulk_change['title'] }}
            </a>
        @endforeach
    </div>
</div>
