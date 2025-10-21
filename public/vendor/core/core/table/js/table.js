/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./platform/core/table/resources/js/table.js":
/*!***************************************************!*\
  !*** ./platform/core/table/resources/js/table.js ***!
  \***************************************************/
/***/ (() => {

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
(function ($, DataTable) {
  "use strict";

  var _buildParams = function _buildParams(dt, action) {
    var params = dt.ajax.params();
    params.action = action;
    params._token = $('meta[name="csrf-token"]').attr("content");
    return params;
  };
  var _downloadFromUrl = function _downloadFromUrl(url, params) {
    var postUrl = url + "/export";
    var xhr = new XMLHttpRequest();
    xhr.open("POST", postUrl, true);
    xhr.responseType = "arraybuffer";
    xhr.onload = function () {
      if (this.status === 200) {
        var filename = "";
        var disposition = xhr.getResponseHeader("Content-Disposition");
        if (disposition && disposition.indexOf("attachment") !== -1) {
          var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
          var matches = filenameRegex.exec(disposition);
          if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, "");
        }
        var type = xhr.getResponseHeader("Content-Type");
        var blob = new Blob([this.response], {
          type: type
        });
        if (typeof window.navigator.msSaveBlob !== "undefined") {
          // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
          window.navigator.msSaveBlob(blob, filename);
        } else {
          var _URL = window.URL || window.webkitURL;
          var downloadUrl = _URL.createObjectURL(blob);
          if (filename) {
            // use HTML5 a[download] attribute to specify filename
            var a = document.createElement("a");
            // safari doesn't support this yet
            if (typeof a.download === "undefined") {
              window.location = downloadUrl;
            } else {
              a.href = downloadUrl;
              a.download = filename;
              document.body.appendChild(a);
              a.click();
            }
          } else {
            window.location = downloadUrl;
          }
          setTimeout(function () {
            _URL.revokeObjectURL(downloadUrl);
          }, 100); // cleanup
        }
      }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send($.param(params));
  };
  var _buildUrl = function _buildUrl(dt, action) {
    var url = dt.ajax.url() || "";
    var params = dt.ajax.params();
    params.action = action;
    if (url.indexOf("?") > -1) {
      return url + "&" + $.param(params);
    }
    return url + "?" + $.param(params);
  };
  DataTable.ext.buttons.excel = {
    className: "buttons-excel",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                    <path d=\"M14 3v4a1 1 0 0 0 1 1h4\"></path>\n                    <path d=\"M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z\"></path>\n                    <path d=\"M8 11h8v7h-8z\"></path>\n                    <path d=\"M8 15h8\"></path>\n                    <path d=\"M11 11v7\"></path>\n                </svg>\n            ".concat(dt.i18n("buttons.excel", "Excel"));
    },
    action: function action(e, dt) {
      window.location = _buildUrl(dt, "excel");
    }
  };
  DataTable.ext.buttons.postExcel = {
    className: "buttons-excel",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M14 3v4a1 1 0 0 0 1 1h4\"></path>\n                <path d=\"M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z\"></path>\n                <path d=\"M8 11h8v7h-8z\"></path>\n                <path d=\"M8 15h8\"></path>\n                <path d=\"M11 11v7\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.excel", "Excel"));
    },
    action: function action(e, dt) {
      var url = dt.ajax.url() || window.location.href;
      var params = _buildParams(dt, "excel");
      _downloadFromUrl(url, params);
    }
  };
  DataTable.ext.buttons["export"] = {
    extend: "collection",
    className: "buttons-export",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2\"></path>\n                <path d=\"M7 11l5 5l5 -5\"></path>\n                <path d=\"M12 4l0 12\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.export", "Export"));
    },
    buttons: ["csv", "excel"]
  };
  DataTable.ext.buttons.csv = {
    className: "buttons-csv",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M14 3v4a1 1 0 0 0 1 1h4\"></path>\n                <path d=\"M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4\"></path>\n                <path d=\"M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0\"></path>\n                <path d=\"M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75\"></path>\n                <path d=\"M16 15l2 6l2 -6\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.csv", "CSV"));
    },
    action: function action(e, dt) {
      window.location = _buildUrl(dt, "csv");
    }
  };
  DataTable.ext.buttons.postCsv = {
    className: "buttons-csv",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M14 3v4a1 1 0 0 0 1 1h4\"></path>\n                <path d=\"M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4\"></path>\n                <path d=\"M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0\"></path>\n                <path d=\"M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75\"></path>\n                <path d=\"M16 15l2 6l2 -6\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.csv", "CSV"));
    },
    action: function action(e, dt) {
      var url = dt.ajax.url() || window.location.href;
      var params = _buildParams(dt, "csv");
      _downloadFromUrl(url, params);
    }
  };
  DataTable.ext.buttons.pdf = {
    className: "buttons-pdf",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M14 3v4a1 1 0 0 0 1 1h4\"></path>\n                <path d=\"M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4\"></path>\n                <path d=\"M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6\"></path>\n                <path d=\"M17 18h2\"></path>\n                <path d=\"M20 15h-3v6\"></path>\n                <path d=\"M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.pdf", "PDF"));
    },
    action: function action(e, dt) {
      window.location = _buildUrl(dt, "pdf");
    }
  };
  DataTable.ext.buttons.postPdf = {
    className: "buttons-pdf",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M14 3v4a1 1 0 0 0 1 1h4\"></path>\n                <path d=\"M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4\"></path>\n                <path d=\"M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6\"></path>\n                <path d=\"M17 18h2\"></path>\n                <path d=\"M20 15h-3v6\"></path>\n                <path d=\"M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.pdf", "PDF"));
    },
    action: function action(e, dt) {
      var url = dt.ajax.url() || window.location.href;
      var params = _buildParams(dt, "pdf");
      _downloadFromUrl(url, params);
    }
  };
  DataTable.ext.buttons.print = {
    className: "buttons-print",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                    <path d=\"M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2\"></path>\n                    <path d=\"M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4\"></path>\n                    <path d=\"M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z\"></path>\n                </svg>\n                ".concat(dt.i18n("buttons.print", "Print"));
    },
    action: function action(e, dt) {
      window.location = _buildUrl(dt, "print");
    }
  };
  DataTable.ext.buttons.reset = {
    className: "buttons-reset",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                    <path d=\"M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1\"></path>\n                </svg>\n                ".concat(dt.i18n("buttons.reset", "Reset"));
    },
    action: function action() {
      $(".table thead input").val("").keyup();
      $(".table thead select").val("").change();
    }
  };
  DataTable.ext.buttons.reload = {
    className: "buttons-reload",
    text: function text(dt) {
      return "\n                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/>\n                    <path d=\"M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4\" />\n                    <path d=\"M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4\" />\n                </svg>\n                ".concat(dt.i18n("buttons.reload", "Reload"));
    },
    action: function action(e, dt) {
      dt.draw(false);
    }
  };
  DataTable.ext.buttons.create = {
    className: "buttons-create",
    text: function text(dt) {
      return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                <path d=\"M12 5l0 14\"></path>\n                <path d=\"M5 12l14 0\"></path>\n            </svg>\n            ".concat(dt.i18n("buttons.create", "Create"));
    },
    action: function action() {
      window.location = window.location.href.replace(/\/+$/, "") + "/create";
    }
  };
  if (typeof DataTable.ext.buttons.copyHtml5 !== "undefined") {
    $.extend(DataTable.ext.buttons.copyHtml5, {
      text: function text(dt) {
        return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                    <path d=\"M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2\"></path>\n                    <path d=\"M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z\"></path>\n                </svg>\n                ".concat(dt.i18n("buttons.copy", "Copy"));
      }
    });
  }
  if (typeof DataTable.ext.buttons.colvis !== "undefined") {
    $.extend(DataTable.ext.buttons.colvis, {
      text: function text(dt) {
        return "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"icon\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\" stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">\n                    <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"></path>\n                    <path d=\"M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0\"></path>\n                    <path d=\"M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6\"></path>\n                </svg>\n                ".concat(dt.i18n("buttons.colvis", "Column visibility"));
      }
    });
    $.extend(DataTable.ext.buttons.columnVisibility, {
      _columnText: function _columnText(b, a) {
        var c = b.column(a.columns).index(),
          d = b.settings()[0].aoColumns[c].titleAttr || b.settings()[0].aoColumns[c].sTitle;
        d || (d = b.column(c).header().innerHTML);
        d = d.replace(/\n/g, " ").replace(/<br\s*\/?>/gi, " ").replace(/<select(.*?)<\/select>/g, "").replace(/<!\-\-.*?\-\->/g, "").replace(/<.*?>/g, "").replace(/^\s+|\s+$/g, "");
        return a.columnText ? a.columnText(b, c, d) : d;
      }
    });
  }
  var TableManagement = /*#__PURE__*/function () {
    function TableManagement() {
      _classCallCheck(this, TableManagement);
      this.init();
      this.handleActionsRow();
      this.handleActionsExport();
    }
    return _createClass(TableManagement, [{
      key: "init",
      value: function init() {
        $(document).on("change", ".table-check-all", function (event) {
          var _self = $(event.currentTarget);
          var set = _self.attr("data-set");
          var checked = _self.prop("checked");
          $(set).each(function (index, el) {
            if (checked) {
              $(el).prop("checked", true).trigger("change");
            } else {
              $(el).prop("checked", false).trigger("change");
            }
          });
        });
        $(document).find(".table-check-all").closest("th").removeAttr("title");
        $(document).on("change", ".checkboxes", function (event) {
          var _self = $(event.currentTarget);
          var table = _self.closest(".card-body").find(".table").prop("id");
          var checkboxAll = _self.closest(".card-body").find(".table-check-all");
          var ids = [];
          var $table = $("#" + table);
          $table.find(".checkboxes:checked").each(function (i, el) {
            ids[i] = $(el).val();
          });
          var row = _self.closest("tr");
          if (_self.prop("checked")) {
            row.addClass("selected");
          } else {
            row.removeClass("selected");
          }
          if (ids.length !== $table.find(".checkboxes").length) {
            checkboxAll.prop("checked", false);
            if (ids.length > 0) {
              checkboxAll.prop("indeterminate", true);
            } else {
              checkboxAll.prop("indeterminate", false);
            }
          } else {
            checkboxAll.prop("checked", true);
            checkboxAll.prop("indeterminate", false);
          }
        });
        $(document).on("click", ".btn-show-table-options", function (event) {
          event.preventDefault();
          $(event.currentTarget).closest(".card-body").find(".table-configuration-wrap").slideToggle(500);
          var url = new URL(window.location.href);
          window.history.pushState({}, "", url.pathname);
        });
        $(document).on("click", ".action-item", function (event) {
          event.preventDefault();
          var span = $(event.currentTarget).find("span[data-href]");
          var action = span.data("action");
          var url = span.data("href");
          if (action && url !== "#") {
            window.location.href = url;
          }
        });
      }
    }, {
      key: "handleActionsRow",
      value: function handleActionsRow() {
        var that = this;
        $(document).on("click", ".deleteDialog", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          var url = _self.data("section");
          if (!url) {
            url = _self.prop("href");
          }
          console.log(url);
          $(".delete-crud-entry").data("section", url).data("parent-table", _self.closest(".table").prop("id"));
          $(".modal-confirm-delete").modal("show");
        });
        $(".delete-crud-entry").on("click", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          Bng.showButtonLoading(_self);
          var deleteURL = _self.data("section");
          $httpClient.make()["delete"](deleteURL).then(function (_ref) {
            var data = _ref.data;
            window.LaravelDataTables[_self.data("parent-table")].row($("a[data-section=\"".concat(deleteURL, "\"]")).closest("tr")).remove().draw();
            Bng.showSuccess(data.message);
            _self.closest(".modal").modal("hide");
          })["catch"](function () {
            $(".modal-confirm-delete").modal("hide");
          })["finally"](function () {
            Bng.hideButtonLoading(_self);
          });
        });
        $(document).on("click", ".delete-many-entry-trigger", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          var table = _self.closest(".card-body").find(".table").prop("id");
          var ids = [];
          $("#".concat(table)).find(".checkboxes:checked").each(function (i, el) {
            ids[i] = $(el).val();
          });
          if (ids.length === 0) {
            Bng.showError(BngVariables.languages.tables.please_select_record ? BngVariables.languages.tables.please_select_record : "Please select at least one record to perform this action!");
            return false;
          }
          $(".delete-many-entry-button").data("href", _self.prop("href")).data("parent-table", table).data("class-item", _self.data("class-item"));
          $(".delete-many-modal").modal("show");
        });
        $(".delete-many-entry-button").on("click", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          Bng.showButtonLoading(_self);
          var $table = $("#".concat(_self.data("parent-table")));
          var ids = [];
          $table.find(".checkboxes:checked").each(function (i, el) {
            ids[i] = $(el).val();
          });
          $httpClient.make()["delete"](_self.data("href"), {
            ids: ids,
            "class": _self.data("class-item")
          }).then(function (_ref2) {
            var data = _ref2.data;
            Bng.showSuccess(data.message);
            $table.find(".table-check-all").prop("checked", false).prop("indeterminate", false);
            window.LaravelDataTables[_self.data("parent-table")].draw();
            _self.closest(".modal").modal("hide");
          })["finally"](function () {
            Bng.hideButtonLoading(_self);
          });
        });
        $(document).on("click", "[data-trigger-bulk-action]", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          var tableId = _self.closest(".card-body").find(".table").prop("id");
          var ids = [];
          $("#".concat(tableId)).find(".checkboxes:checked").each(function (i, el) {
            return ids.push($(el).val());
          });
          if (ids.length === 0) {
            Bng.showError(BngVariables.languages.tables.please_select_record ? BngVariables.languages.tables.please_select_record : "Please select at least one record to perform this action!");
            return false;
          }
          $(".confirm-trigger-bulk-actions-button").data("href", _self.prop("href")).data("method", _self.data("method")).data("table-id", tableId).data("table-target", _self.data("table-target")).data("target", _self.data("target"));
          var modal = $(".bulk-action-confirm-modal");
          modal.find("h3").text(_self.data("confirmation-modal-title"));
          modal.find(".modal-body > .text-muted").text(_self.data("confirmation-modal-message"));
          modal.find('button.btn[data-bs-dismiss="modal"]').text(_self.data("confirmation-modal-cancel-button"));
          modal.find("button.confirm-trigger-bulk-actions-button").text(_self.data("confirmation-modal-button"));
          modal.modal("show");
        });
        $(document).on("click", ".confirm-trigger-bulk-actions-button", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          Bng.showButtonLoading(_self);
          var tableId = _self.data("table-id");
          var method = _self.data("method").toLowerCase() || "post";
          var $table = $("#".concat(tableId));
          var ids = [];
          $table.find(".checkboxes:checked").each(function (i, el) {
            return ids.push($(el).val());
          });
          $httpClient.make()[method](_self.data("href"), {
            ids: ids,
            bulk_action: 1,
            bulk_action_table: _self.data("table-target"),
            bulk_action_target: _self.data("target")
          }).then(function (_ref3) {
            var data = _ref3.data;
            Bng.showSuccess(data.message);
            $table.find(".table-check-all").prop("checked", false).prop("indeterminate", false);
            window.LaravelDataTables[tableId].draw();
            _self.closest(".modal").modal("hide");
          })["finally"](function () {
            Bng.hideButtonLoading(_self);
          });
        });
        $(document).on("click", "[data-dt-single-action]", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          var tableId = _self.closest(".card-body").find(".table").prop("id");
          if (_self.data("confirmation-modal")) {
            $(".confirm-trigger-single-action-button").data("href", _self.prop("href")).data("method", _self.data("method")).data("table-id", tableId);
            var modal = $(".single-action-confirm-modal");
            modal.find(".modal-body > h3").text(_self.data("confirmation-modal-title") || "Xác nhận");
            modal.find(".modal-body > .text-muted").text(_self.data("confirmation-modal-message") || "Bạn có chắc chắn?");
            modal.find('button.btn[data-bs-dismiss="modal"]').text(_self.data("confirmation-modal-cancel-button") || "Hủy");
            modal.find("button.confirm-trigger-single-action-button").text(_self.data("confirmation-modal-button") || "Đồng ý");
            modal.modal("show");
          } else {
            triggerSingleAction(tableId, _self.prop("href"), _self.data("method"));
          }
        });
        $(document).on("click", ".confirm-trigger-single-action-button", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          triggerSingleAction(_self.data("table-id"), _self.data("href"), _self.data("method"), _self.closest(".modal"), function () {});
        });
        var triggerSingleAction = function triggerSingleAction(tableId, url, method, onSuccess, onError) {
          var $table = $("#".concat(tableId));
          var $method = method.toLowerCase() || "post";
          $httpClient.make()[$method](url).then(function (_ref4) {
            var data = _ref4.data;
            Bng.showSuccess(data.message);
            window.LaravelDataTables[tableId].draw();
            _typeof(onSuccess) && onSuccess.modal("hide");
          })["catch"](function (error) {
            Bng.showError(error);
            _typeof(onError) && onError.modal("hide");
          });
        };
        $(document).on("click", ".bulk-change-item", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          var table = _self.closest(".card-body").find(".table").prop("id");
          var ids = [];
          $("#" + table).find(".checkboxes:checked").each(function (i, el) {
            ids[i] = $(el).val();
          });
          if (ids.length === 0) {
            Bng.showError(BngVariables.languages.tables.please_select_record ? BngVariables.languages.tables.please_select_record : "Please select at least one record to perform this action!");
            return false;
          }
          that.loadBulkChangeData(_self);
          $(".confirm-bulk-change-button").data("parent-table", table).data("class-item", _self.data("class-item")).data("key", _self.data("key")).data("url", _self.data("save-url"));
          $(".modal-bulk-change-items").modal("show");
        });
        $(document).on("click", ".confirm-bulk-change-button", function (event) {
          event.preventDefault();
          var _self = $(event.currentTarget);
          var value = _self.closest(".modal").find(".input-value").val();
          var inputKey = _self.data("key");
          var $table = $("#" + _self.data("parent-table"));
          var ids = [];
          $table.find(".checkboxes:checked").each(function (i, el) {
            ids[i] = $(el).val();
          });
          Bng.showButtonLoading(_self);
          $httpClient.make().post(_self.data("url"), {
            ids: ids,
            key: inputKey,
            value: value,
            "class": _self.data("class-item")
          }).then(function (_ref5) {
            var data = _ref5.data;
            Bng.showSuccess(data.message);
            $table.find(".table-check-all").prop("checked", false).prop("indeterminate", false);
            $.each(ids, function (index, item) {
              window.LaravelDataTables[_self.data("parent-table")].row($table.find('.checkboxes[value="' + item + '"]').closest("tr")).remove().draw();
            });
            _self.closest(".modal").modal("hide");
          })["finally"](function () {
            Bng.hideButtonLoading(_self);
          });
        });
        $(document).on("keyup", ".table-search-input input[type=search]", function (event) {
          var $searchInput = $(event.currentTarget);
          setTimeout(function () {
            var searchValue = $searchInput.val();
            if (searchValue) {
              $searchInput.closest("label").find(".search-icon").hide();
              $searchInput.closest("label").find(".search-reset-icon").show();
            } else {
              $searchInput.closest("label").find(".search-icon").show();
              $searchInput.closest("label").find(".search-reset-icon").hide();
            }
            $searchInput.closest(".card-body").find("table").DataTable().search(searchValue).draw();
          }, 200);
        });
        $(document).on("click", ".table-search-input .search-reset-icon", function (event) {
          var $searchInput = $(event.currentTarget).closest(".table-search-input").find("input[type=search]");
          $searchInput.val("");
          $searchInput.closest(".card-body").find("table").DataTable().search("").draw();
        });
        $(document).on("click", '[data-bb-toggle="dt-buttons"]', function (event) {
          var target = $(event.currentTarget);
          var tableId = target.attr("aria-controls");
          var buttonTarget = target.data("bb-target");
          console.log("".concat(buttonTarget, "[aria-controls=\"").concat(tableId, "\"]"));
          $("".concat(buttonTarget, "[aria-controls=\"").concat(tableId, "\"]")).trigger("click");
        });
        $(document).on("click", '[data-bb-toggle="dt-exports"]', function (event) {
          var target = $(event.currentTarget);
          var tableId = target.attr("aria-controls");
          var value = target.data("bb-target");
          var dt = window.LaravelDataTables[tableId];
          var url = dt.ajax.url() || window.location.href;
          var params = _buildParams(dt, value);
          _downloadFromUrl(url, params);
        });
      }
    }, {
      key: "loadBulkChangeData",
      value: function loadBulkChangeData($element) {
        var $modal = $(".modal-bulk-change-items");
      }
    }, {
      key: "handleActionsExport",
      value: function handleActionsExport() {
        $(document).on("click", ".export-data", function (event) {
          var _self = $(event.currentTarget);
          var table = _self.closest(".card-body").find(".table").prop("id");
          var ids = [];
          $("#" + table).find(".checkboxes:checked").each(function (i, el) {
            ids[i] = $(el).val();
          });
          event.preventDefault();
          $httpClient.make().post(_self.prop("href"), {
            "ids-checked": ids
          }).then(function (_ref6) {
            var data = _ref6.data;
            var a = document.createElement("a");
            a.href = data.file;
            a.download = data.name;
            document.body.appendChild(a);
            a.trigger("click");
            a.remove();
          });
        });
      }
    }]);
  }();
  $.fn.dataTable.Buttons.defaults.dom.container.className = "dt-buttons btn-group";
  $.fn.dataTable.Buttons.defaults.dom.button.className = "btn";
  $(function () {
    new TableManagement();
  });
})(jQuery, jQuery.fn.dataTable);

/***/ }),

/***/ "./platform/core/base/resources/sass/custom/crop-image.scss":
/*!******************************************************************!*\
  !*** ./platform/core/base/resources/sass/custom/crop-image.scss ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./platform/core/table/resources/sass/table.scss":
/*!*******************************************************!*\
  !*** ./platform/core/table/resources/sass/table.scss ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./platform/core/media/resources/sass/media.scss":
/*!*******************************************************!*\
  !*** ./platform/core/media/resources/sass/media.scss ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./platform/core/base/resources/sass/app.scss":
/*!****************************************************!*\
  !*** ./platform/core/base/resources/sass/app.scss ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./platform/core/base/resources/sass/bootstrap.scss":
/*!**********************************************************!*\
  !*** ./platform/core/base/resources/sass/bootstrap.scss ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./platform/core/base/resources/sass/icons.scss":
/*!******************************************************!*\
  !*** ./platform/core/base/resources/sass/icons.scss ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/vendor/core/core/table/js/table": 0,
/******/ 			"vendor/core/core/base/css/app": 0,
/******/ 			"vendor/core/core/base/css/icons": 0,
/******/ 			"vendor/core/core/base/css/bootstrap": 0,
/******/ 			"vendor/core/core/media/css/media": 0,
/******/ 			"vendor/core/core/table/css/table": 0,
/******/ 			"vendor/core/core/base/css/crop-image": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/table/resources/js/table.js")))
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/table/resources/sass/table.scss")))
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/media/resources/sass/media.scss")))
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/base/resources/sass/app.scss")))
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/base/resources/sass/bootstrap.scss")))
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/base/resources/sass/icons.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendor/core/core/base/css/app","vendor/core/core/base/css/icons","vendor/core/core/base/css/bootstrap","vendor/core/core/media/css/media","vendor/core/core/table/css/table","vendor/core/core/base/css/crop-image"], () => (__webpack_require__("./platform/core/base/resources/sass/custom/crop-image.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;