$(() => {
    "use strict";
    $(document).on("click", ".editable-role", function (e) {
        e.preventDefault();
        const $this = $(this);
        const roleId = $this.data("id");
        $.ajax({
            type: "POST",
            cache: false,
            url: _self.data("action"),
            success: (res) => {
                if (!res.error) {
                    Botble.showSuccess(res.message);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    Botble.showError(res.message);
                }
                _self.removeClass("button-loading");
                _self.closest(".modal").modal("hide");
            },
            error: (res) => {
                Botble.handleError(res);
                _self.removeClass("button-loading");
            },
        });
    });
});
