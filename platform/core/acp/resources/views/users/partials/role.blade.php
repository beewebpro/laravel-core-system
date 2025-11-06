<div class="role-change">
    <a href="#" class="edit editable-role" data-id="{{ $item->id }}" data-role-id="{{ $role?->id ?? '' }}"
        title="Edit" data-url="{{ route('roles.get-roles') }}">
        {{ $role?->name ?: trans('core/acp::user.no_role') }}
    </a>
</div>
