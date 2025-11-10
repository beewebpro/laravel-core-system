/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./platform/core/acp/resources/js/role.js ***!
  \************************************************/
document.addEventListener("DOMContentLoaded", function () {
  var allChecked = function allChecked(nodes) {
    return nodes.length > 0 && Array.from(nodes).every(function (cb) {
      return cb.checked;
    });
  };
  var anyChecked = function anyChecked(nodes) {
    return Array.from(nodes).some(function (cb) {
      return cb.checked;
    });
  };
  document.querySelectorAll(".form-check-input").forEach(function (input) {
    input.addEventListener("change", function () {
      var _li$closest;
      var checked = this.checked;

      // tìm li nơi checkbox đang ở (nếu có) và card chứa nó (nếu có)
      var li = this.closest("li");
      var card = this.closest(".card");

      // 1) Đồng bộ descendants (nếu check/uncheck 1 node thì apply xuống tất cả con)
      var wrapper = li !== null && li !== void 0 ? li : card;
      if (wrapper) {
        var descendants = wrapper.querySelectorAll(":scope ul .form-check-input");
        descendants.forEach(function (d) {
          return d.checked = checked;
        });
      }

      // 2) Cập nhật các ancestor <li> từng cấp lên trên, set checked/indeterminate đúng
      var ancestorLi = li === null || li === void 0 || (_li$closest = li.closest("ul")) === null || _li$closest === void 0 ? void 0 : _li$closest.closest("li");
      while (ancestorLi) {
        var _ancestorLi$closest;
        var ancestorCheckbox = ancestorLi.querySelector(":scope > .form-check .form-check-input");
        var directChildCheckboxes = ancestorLi.querySelectorAll(":scope > ul > li > .form-check .form-check-input");
        if (ancestorCheckbox) {
          if (allChecked(directChildCheckboxes)) {
            ancestorCheckbox.checked = true;
            ancestorCheckbox.indeterminate = false;
          } else if (anyChecked(directChildCheckboxes)) {
            ancestorCheckbox.checked = false;
            ancestorCheckbox.indeterminate = true;
          } else {
            ancestorCheckbox.checked = false;
            ancestorCheckbox.indeterminate = false;
          }
        }
        ancestorLi = (_ancestorLi$closest = ancestorLi.closest("ul")) === null || _ancestorLi$closest === void 0 ? void 0 : _ancestorLi$closest.closest("li");
      }

      // 3) Cập nhật ROOT (checkbox trong .card-header)
      if (card) {
        var rootCheckbox = card.querySelector(".card-header .form-check-input");
        if (rootCheckbox) {
          // -> Lấy tất cả checkbox **cấp 1** (trong card-body trực tiếp: ul > li)
          var topLevel = card.querySelectorAll(":scope > .card-body > ul > li > .form-check .form-check-input");

          // nếu không tìm thấy topLevel (cấu trúc khác) thì fallback sang toàn bộ descendants
          var targetList = topLevel.length ? topLevel : card.querySelectorAll(".card-body .form-check-input");
          if (allChecked(targetList)) {
            rootCheckbox.checked = true;
            rootCheckbox.indeterminate = false;
          } else if (anyChecked(targetList)) {
            rootCheckbox.checked = false;
            rootCheckbox.indeterminate = true;
          } else {
            rootCheckbox.checked = false;
            rootCheckbox.indeterminate = false;
          }
        }
      }
    }); // end change listener
  }); // end forEach
});
/******/ })()
;