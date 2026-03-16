(function ($) {
  if (localStorage.getItem("color")) $("#color").attr("href", "../assets/css/" + localStorage.getItem("color") + ".css");
  if (localStorage.getItem("dark")) $("body").attr("class", "dark-only");
  

  (function () {})();
  //live customizer js
  $(document).ready(function () {
    // Setting and Layout Toggle
    document.getElementById("cog-click").addEventListener("click", function () {
      var settingSidebar = document.querySelector(".setting-sidebar");
      settingSidebar.classList.add("open");
    });

    document.getElementById("cog-close").addEventListener("click", function () {
      var settingSidebar = document.querySelector(".setting-sidebar");
      settingSidebar.classList.remove("open");
    });

    document.getElementById("grip-click").addEventListener("click", function () {
      var settingSidebar = document.querySelector(".layout-sidebar");
      settingSidebar.classList.add("open");
    });

    document.getElementById("grip-close").addEventListener("click", function () {
      var settingSidebar = document.querySelector(".layout-sidebar");
      settingSidebar.classList.remove("open");
    });

    function closeSidebarOnClickOutside(sidebarClass) {
      document.addEventListener("click", function (event) {
        var setting_sidebar = document.querySelector(sidebarClass);
        if (!event.target.closest("#cog-click") && !event.target.closest("#grip-click")) {
          setting_sidebar.classList.remove("open");
        }
      });
    }
    closeSidebarOnClickOutside(".setting-sidebar");
    closeSidebarOnClickOutside(".layout-sidebar");

    const defaultLayout = "dubai";
    const urlParams = new URLSearchParams(window.location.search);
    const layout = urlParams.get("layout") ? urlParams.get("layout") : defaultLayout;
    setLayout(layout ? layout : defaultLayout);

    $(".customizer-color li").on("click", function () {
      $(".customizer-color li").removeClass("active");
      $(this).addClass("active");
      var color = $(this).attr("data-attr");
      var primary = $(this).attr("data-primary");
      var secondary = $(this).attr("data-secondary");
      localStorage.setItem("color", color);
      localStorage.setItem("primary", primary);
      localStorage.setItem("secondary", secondary);
      localStorage.removeItem("dark");
      $("#color").attr("href", "../assets/css/" + color + ".css");
      $(".dark-only").removeClass("dark-only");
      location.reload(true);
    });

    $(".customizer-color.dark li").on("click", function () {
      $(".customizer-color.dark li").removeClass("active");
      $(this).addClass("active");
      $("body").attr("class", "dark-only");
      localStorage.setItem("dark", "dark-only");
    });

    if (localStorage.getItem("primary") != null) {
      document.documentElement.style.setProperty("--theme-default", localStorage.getItem("primary"));
    }
    if (localStorage.getItem("secondary") != null) {
      document.documentElement.style.setProperty("--theme-secondary", localStorage.getItem("secondary"));
    }
    $(".customizer-links #c-pills-home-tab, .customizer-links #c-pills-layouts-tab").click(function () {
      $(".customizer-contain").addClass("open");
      $(".customizer-links").addClass("open");
    });

    $(".close-customizer-btn").on("click", function () {
      $(".floated-customizer-panel").removeClass("active");
    });

    $(".customizer-contain .icon-close").on("click", function () {
      $(".customizer-contain").removeClass("open");
      $(".customizer-links").removeClass("open");
    });

    $(".color-apply-btn").click(function () {
      location.reload(true);
    });

    var primary = document.getElementById("ColorPicker1").value;
    document.getElementById("ColorPicker1").onchange = function () {
      primary = this.value;
      localStorage.setItem("primary", primary);
      document.documentElement.style.setProperty("--theme-primary", primary);
    };

    var secondary = document.getElementById("ColorPicker2").value;
    document.getElementById("ColorPicker2").onchange = function () {
      secondary = this.value;
      localStorage.setItem("secondary", secondary);
      document.documentElement.style.setProperty("--theme-secondary", secondary);
    };

    $(".customizer-color.dark li").on("click", function () {
      $(".customizer-color.dark li").removeClass("active");
      $(this).addClass("active");
      $("body").attr("class", "dark-only");
      localStorage.setItem("dark", "dark-only");
    });

    $(".customizer-mix li").on("click", function () {
      $(".customizer-mix li").removeClass("active");
      $(this).addClass("active");
      var mixLayout = $(this).attr("data-attr");
      $("body").attr("class", mixLayout);
    });

    $(".sidebar-setting li").on("click", function () {
      $(".sidebar-setting li").removeClass("active");
      $(this).addClass("active");
      var sidebar = $(this).attr("data-attr");
      $(".sidebar-wrapper").attr("data-sidebar-layout", sidebar);
    });

    $(".sidebar-main-bg-setting li").on("click", function () {
      $(".sidebar-main-bg-setting li").removeClass("active");
      $(this).addClass("active");
      var bg = $(this).attr("data-attr");
      $(".sidebar-wrapper").attr("class", "sidebar-wrapper " + bg);
    });

    $(".sidebar-type li").on("click", function () {
      // location.reload(true);

      var type = $(this).attr("data-attr");
      console.log("Selected layout:", type);
      updateQueryParamInCurrentURL("layout", type);
      setLayout(type); // Apply the layout change consistently
      location.reload(true);
    });

    $(".main-layout li").on("click", function () {
      $(".main-layout li").removeClass("active");
      $(this).addClass("active");
      var layout = $(this).attr("data-attr");
      $("body").attr("class", layout);
      $("html").attr("dir", layout);
    });

    $(".main-layout .box-layout").on("click", function () {
      $(".main-layout .box-layout").removeClass("active");
      $(this).addClass("active");
      var layout = $(this).attr("data-attr");
      $("body").attr("class", "box-layout");
      $("html").attr("dir", layout);
    });
  });
})(jQuery);

function updateQueryParamInCurrentURL(key, value) {
  // Get the current URL
  let currentUrl = window.location.href;

  // Check if the URL already has query parameters
  const urlParts = currentUrl.split("?");
  if (urlParts.length >= 2) {
    // URL has query parameters, parse them
    const queryParams = urlParts[1].split("&");
    let updatedParams = queryParams.map((param) => {
      const [paramKey, paramValue] = param.split("=");
      if (decodeURIComponent(paramKey) === key) {
        // Found the parameter, update its value
        return `${encodeURIComponent(key)}=${encodeURIComponent(value)}`;
      } else {
        // Keep the parameter as it is
        return param;
      }
    });

    // Join the updated parameters
    const updatedUrl = `${urlParts[0]}?${updatedParams.join("&")}`;

    // Update the current URL
    window.history.replaceState({ path: updatedUrl }, "", updatedUrl);
  } else {
    // URL does not have any query parameters, simply add the new one
    addQueryParamToCurrentURL(key, value);
  }

  const urlParams = new URLSearchParams(window.location.search);
  const layout = urlParams.get("layout") ? urlParams.get("layout") : "dubai";
  setLayout(layout);
}

// Function to add a query parameter if it doesn't exist
function addQueryParamToCurrentURL(key, value) {
  let currentUrl = window.location.href;
  const separator = currentUrl.includes("?") ? "&" : "?";
  const updatedUrl = `${currentUrl}${separator}${encodeURIComponent(key)}=${encodeURIComponent(value)}`;
  window.history.replaceState({ path: updatedUrl }, "", updatedUrl);
}

function setLayout(layout) {
  $(document).ready(function () {
    var boxed = "";
    if ($(".page-wrapper").hasClass("box-layout")) {
      boxed = "box-layout";
    }
    switch (layout) {
      case "compact-sidebar": {
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper" + boxed);
        $(this).addClass("active");
        localStorage.setItem("page-wrapper-cuba", "compact-wrapper");
        break;
      }
      case "normal-sidebar": {
        $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper " + boxed);
        $(".logo-wrapper").find("img").attr("src", "../assets/images/logo/logo.png");
        localStorage.setItem("page-wrapper-cuba", "horizontal-wrapper");
        break;
      }
      case "london": {
        $(".page-wrapper").attr("class", "page-wrapper  only-body" + boxed);
        localStorage.setItem("page-wrapper-cuba", "only-body");
        break;
      }
      case "paris": {
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper dark-sidebar" + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-wrapper dark-sidebar");
        break;
      }
      case "tokyo": {
        $(".page-wrapper").attr("class", "page-wrapper compact-sidebar" + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-sidebar");
        break;
      }
      case "madrid": {
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper color-sidebar" + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-wrapper color-sidebar");
        break;
      }
      case "moscow": {
        $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small" + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-sidebar compact-small");
        break;
      }
      case "new_york": {
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper box-layout " + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-wrapper box-layout");
        break;
      }
      case "singapore": {
        $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type" + boxed);
        localStorage.setItem("page-wrapper-cuba", "horizontal-wrapper enterprice-type");
        break;
      }
      case "seoul": {
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper modern-type" + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-wrapper modern-type");
        break;
      }
      case "los_angeles": {
        $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper material-type" + boxed);
        localStorage.setItem("page-wrapper-cuba", "horizontal-wrapper material-type");

        break;
      }
      case "rome": {
        $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small material-icon" + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-sidebar compact-small material-icon");

        break;
      }
      case "barcelona": {
        $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type advance-layout" + boxed);
        localStorage.setItem("page-wrapper-cuba", "horizontal-wrapper enterprice-type advance-layout");

        break;
      }
      case "default-body": {
        updateQueryParamInCurrentURL("layout", "london");
        break;
      }
      case "dark-sidebar": {
        updateQueryParamInCurrentURL("layout", "paris");
        break;
      }
      case "compact-wrap": {
        updateQueryParamInCurrentURL("layout", "tokyo");
        break;
      }
      case "color-sidebar": {
        updateQueryParamInCurrentURL("layout", "madrid");
        break;
      }
      case "compact-small": {
        updateQueryParamInCurrentURL("layout", "moscow");
        break;
      }
      case "box-layout": {
        updateQueryParamInCurrentURL("layout", "new_york");
        break;
      }
      case "enterprice-type": {
        updateQueryParamInCurrentURL("layout", "singapore");
        break;
      }
      case "modern-layout": {
        updateQueryParamInCurrentURL("layout", "seoul");
        break;
      }
      case "material-layout": {
        updateQueryParamInCurrentURL("layout", "los_angeles");
        break;
      }
      case "material-icon": {
        updateQueryParamInCurrentURL("layout", "rome");
        break;
      }
      case "advance-type": {
        updateQueryParamInCurrentURL("layout", "barcelona");
        break;
      }
      default: {
        $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
        localStorage.setItem("page-wrapper-cuba", "compact-wrapper");
        break;
      }
    }
  });
}

// Auto layout
function applyTheme(theme) {
  if (theme == "light-only") {
    document.body.classList.add(theme, "auto-only");
    document.body.classList.remove("dark-only");
    document.body.classList.remove("light");
    document.body.classList.remove("dark-sidebar");
  } else if (theme == "dark-only") {
    document.body.classList.add(theme, "auto-only");
    document.body.classList.remove("light-only");
    document.body.classList.remove("light");
    document.body.classList.remove("dark-sidebar");
  } else if (theme == "auto-only") {
    // Check user's color scheme preference
    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

    // Apply the corresponding theme
    if (prefersDarkScheme) {
      document.body.classList.add("dark-only", "auto-only");
      document.body.classList.remove("light-only");
      document.body.classList.remove("light");
      document.body.classList.remove("dark-sidebar");
    } else {
      document.body.classList.add("light-only", "auto-only");
      document.body.classList.remove("dark-only");
      document.body.classList.remove("light");
      document.body.classList.remove("dark-sidebar");
    }
  }
}

// // Check user's color scheme preference
function detectColorScheme() {
  console.log("inside color scheme function");

  // Check for the user's color scheme preference
  const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

  // Apply the corresponding theme
  if (prefersDarkScheme) {
    applyTheme("dark-only");
  } else {
    applyTheme("light-only");
  }
}
// Optional: Add a listener to handle changes in the color scheme preference
window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", (event) => {
  if (document.body.classList.contains("auto-only")) {
    if (event.matches) {
      applyTheme("dark-only");
    } else {
      applyTheme("light-only");
    }
  } else return;
});
