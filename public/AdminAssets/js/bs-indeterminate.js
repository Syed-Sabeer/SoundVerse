// Bootstrap indeterminate checkbox and radio JS

(function () {
  "use strict";
  document.querySelectorAll('.card-wrapper [type="checkbox"]').forEach((checkbox) => {
    if (checkbox.id.includes("Indeterminate")) {
      checkbox.indeterminate = true;
    }
  });
})();
