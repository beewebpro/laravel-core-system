/******/ (() => { // webpackBootstrap
/*!************************************************!*\
  !*** ./platform/core/acp/resources/js/user.js ***!
  \************************************************/
$(function () {
  "use strict";

  $(document).on("click", ".editable-role", function (e) {
    e.preventDefault();
    var $this = $(this);
    var roleId = $this.data("id");
    $.ajax({
      type: "POST",
      cache: false,
      url: _self.data("action"),
      success: function success(res) {
        if (!res.error) {
          Botble.showSuccess(res.message);
          setTimeout(function () {
            window.location.reload();
          }, 2000);
        } else {
          Botble.showError(res.message);
        }
        _self.removeClass("button-loading");
        _self.closest(".modal").modal("hide");
      },
      error: function error(res) {
        Botble.handleError(res);
        _self.removeClass("button-loading");
      }
    });
  });
});
/******/ })()
;