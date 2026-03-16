// Email hide/show JS

(function () {
  const emailList = document.querySelector(".email-list");
  const emailRead = document.querySelector(".email-read");
  let email_Data = document.querySelectorAll(".email-data");
  const btnEmail = document.querySelector(".btn-email");

  email_Data.forEach((item, index) => {
    item.addEventListener("click", (event) => {
      emailRead.classList.add("show");
      emailList.classList.add("hide");
    });
  });

  btnEmail?.addEventListener("click", function (e) {
    emailRead.classList.remove("show");
    emailList.classList.remove("hide");
  });

  // =========== Active to icon color changes =============

  const important_Email = document.querySelectorAll(".important-mail");

  important_Email.forEach(function (svg) {
    svg.addEventListener("click", function () {
      svg.classList.toggle("active");
    });
  });

  const bookmark_Box = document.querySelectorAll(".bookmark-box");

  bookmark_Box.forEach(function (svg) {
    svg.addEventListener("click", function () {
      svg.classList.toggle("active");
    });
  });

  // ============ Filter Functionality ==============
  const filters = document.querySelectorAll(".mail-header-option");
  const tabs = document.querySelectorAll(".mail-header-tabs .project");

  function clearCache() {
    console.log("Cache cleared");
  }

  filters.forEach((filter) => {
    filter.addEventListener("click", () => {
      const selectedFilter = filter.getAttribute("data-filter");
      clearCache();

      filters.forEach((f) => f.classList.toggle("active", f === filter));

      tabs.forEach((tab) => {
        const match = selectedFilter === "all" || tab.getAttribute("data-filter") === selectedFilter;
        tab.classList.toggle("show", match);
        tab.classList.toggle("hide", !match);
      });
    });
  });
})();
