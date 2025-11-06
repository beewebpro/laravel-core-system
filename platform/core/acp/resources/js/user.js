$(() => {
    "use strict";
    $(document).on("click", ".editable-role", function (e) {
        e.preventDefault();
        const _self = $(this);
        const userId = _self.data("id");
        const roleId = _self.data("role-id");

        _self.hide();

        $.ajax({
            type: "POST",
            cache: false,
            url: _self.data("url"),
            success: (res) => {
                const roles = res.data.roles;
                const url = res.data.url;
                let selectHtml =
                    '<select class="role-select" data-user-id="' +
                    userId +
                    '" data-url="' +
                    url +
                    '">';
                roles.forEach((role) => {
                    const selected = role.id === roleId ? "selected" : "";
                    selectHtml += `<option value="${role.id}" ${selected}>${role.name}</option>`;
                });
                selectHtml += "</select>";
                _self.after(selectHtml);
            },
            error: (res) => {
                _self.show();
            },
        });
    });

    $(document).on("change", ".role-select", function () {
        const _self = $(this);
        const roleId = _self.val();
        const userId = _self.data("user-id");

        _self.remove();
        $.ajax({
            type: "POST",
            url: _self.data("url"),
            data: { userId: userId, roleId: roleId },
            success: (res) => {
                const dataTable = $("#bng-acp-tables-user-table").DataTable();
                dataTable.settings()[0].oFeatures.bProcessing = false;
                dataTable.ajax.reload(null, false);
            },
            error: (res) => {
                console.error("Failed to update role");
            },
        });
    });
});
