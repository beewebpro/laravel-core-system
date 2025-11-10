/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./platform/core/acp/resources/js/user.js ***!
  \************************************************/
$(function () {
  "use strict";

  $(document).on("click", ".editable-role", function (e) {
    e.preventDefault();
    var _self = $(this);
    var userId = _self.data("id");
    var roleId = _self.data("role-id");
    _self.hide();
    $.ajax({
      type: "POST",
      cache: false,
      url: _self.data("url"),
      success: function success(res) {
        var roles = res.data.roles;
        var url = res.data.url;
        var selectHtml = '<select class="role-select" data-user-id="' + userId + '" data-url="' + url + '">';
        roles.forEach(function (role) {
          var selected = role.id === roleId ? "selected" : "";
          selectHtml += "<option value=\"".concat(role.id, "\" ").concat(selected, ">").concat(role.name, "</option>");
        });
        selectHtml += "</select>";
        _self.after(selectHtml);
      },
      error: function error(res) {
        _self.show();
      }
    });
  });
  $(document).on("change", ".role-select", function () {
    var _self = $(this);
    var roleId = _self.val();
    var userId = _self.data("user-id");
    _self.remove();
    $.ajax({
      type: "POST",
      url: _self.data("url"),
      data: {
        userId: userId,
        roleId: roleId
      },
      success: function success(res) {
        var dataTable = $("#bng-acp-tables-user-table").DataTable();
        dataTable.settings()[0].oFeatures.bProcessing = false;
        dataTable.ajax.reload(null, false);
      },
      error: function error(res) {
        console.error("Failed to update role");
      }
    });
  });
});
/******/ })()
;