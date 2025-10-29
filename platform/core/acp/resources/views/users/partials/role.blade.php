<a href="#" class="edit" data-id="{{ $item->id }}" title="Edit" data-url="{{ route('roles.get-roles') }}">
    {{ $role?->name ?: trans('core/acp::user.no_role') }}
</a>
