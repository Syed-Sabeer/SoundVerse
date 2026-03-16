// Common check JS

(function () {
  document.querySelectorAll(".check-all").forEach(function (checkAllBox) {
    checkAllBox.addEventListener("change", function () {
      let main_ul = this.closest(".permission-form ul");
      if (main_ul) {
        let checkBoxes = main_ul.querySelectorAll('input[type="checkbox"]');
        checkBoxes.forEach(function (cb) {
          cb.checked = checkAllBox.checked;
        });
      }
    });
  });

  document.querySelectorAll("ul").forEach(function (main_ul) {
    let checkBoxes = main_ul.querySelectorAll('input[type="checkbox"]:not(.check-all)');

    checkBoxes.forEach(function (cb) {
      cb.addEventListener("change", function () {
        var checkAllBox = main_ul.querySelector(".check-all");
        if (checkAllBox) {
          let allChecked = Array.from(checkBoxes).every(function (checkbox) {
            return checkbox.checked;
          });
          checkAllBox.checked = allChecked;
        }
      });
    });
  });
})();
