// Filter functionality JS

const filters = document.querySelectorAll(".seller-filter");

filters.forEach((filter) => {
  filter.addEventListener("click", function () {
    let selectedFilter = filter.getAttribute("data-filter");
    let itemsToHide = document.querySelectorAll(`.seller-box:not([data-filter='${selectedFilter}'])`);
    let itemsToShow = document.querySelectorAll(`.seller-box[data-filter='${selectedFilter}']`);

    if (selectedFilter == "all") {
      itemsToHide = [];
      itemsToShow = document.querySelectorAll(".seller-box[data-filter]");
    }

    itemsToHide.forEach((el) => {
      el.classList.add("hide");
      el.classList.remove("show");
    });

    itemsToShow.forEach((el) => {
      el.classList.remove("hide");
      el.classList.add("show");
    });
  });
});

// ============ Filter functionality to active show class ==============
const commonActive = document.querySelectorAll(".seller-wrapper .seller-filter");
for (let i = 0; i < commonActive.length; i++) {
  commonActive[i].onclick = function () {
    let c = 0;
    while (c < commonActive.length) {
      commonActive[c++].className = "seller-filter";
    }
    commonActive[i].className = "seller-filter active";
  };
}
