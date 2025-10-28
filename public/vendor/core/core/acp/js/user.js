/******/ (() => { // webpackBootstrap
/*!************************************************!*\
  !*** ./platform/core/acp/resources/js/user.js ***!
  \************************************************/
document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các cặp <a> và <select>
  var rows = document.querySelectorAll(".role-display");
  rows.forEach(function (display) {
    var select = display.nextElementSibling; // <select> nằm ngay sau <a>

    // Khi click vào tên role
    display.addEventListener("click", function (e) {
      e.preventDefault();
      display.style.display = "none";
      select.style.display = "inline-block";
      console.log(select);
      select.focus();
    });

    // Khi chọn role mới
    select.addEventListener("change", function () {
      var selectedText = select.options[select.selectedIndex].text;
      display.textContent = selectedText;
      select.style.display = "none";
      display.style.display = "inline";
    });

    // Khi mất focus thì ẩn lại
    select.addEventListener("blur", function () {
      select.style.display = "none";
      display.style.display = "inline";
    });
  });
});
/******/ })()
;