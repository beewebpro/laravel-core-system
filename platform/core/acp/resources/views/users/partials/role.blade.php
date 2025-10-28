<a href="javascript:;" class="editable role-display">
    {{ $role?->name ?: trans('core/acp::user.no_role') }}
</a>
<select class="role-select" style="display:none;">
    <option value="1">Admin</option>
    <option value="2">Editor</option>
    <option value="3">User</option>
    <option value="4">Guest</option>
</select>
