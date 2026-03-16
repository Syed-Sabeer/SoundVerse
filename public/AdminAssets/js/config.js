(function () {
  var primary = localStorage.getItem("primary") || "#7366FF";
  var secondary = localStorage.getItem("secondary") || "#838383";
  var success = localStorage.getItem("success") || "#65c15c";

  window.CubaAdminConfig = {
    // Theme Primary Color
    primary: primary,
    // theme secondary color
    secondary: secondary,
    // theme success color
    success: success,
  };
})();
