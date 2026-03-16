(function () {
  ("use strict");
  // =============== Editor ============================
  // The DOM element you wish to replace with Tagify
  var input = document.querySelector("input[name=basic-tags]");

  // initialize Tagify on the above input node reference
  new Tagify(input);

  // The DOM element you wish to replace with Tagify
  var input = document.querySelector("input[name=basic-tags1]");

  // initialize Tagify on the above input node reference
  new Tagify(input);
})();

// ========================= Common Select Dropdown ==========================

document.addEventListener("DOMContentLoaded", () => {
  const optionVariation = document.getElementById("option-variation");
  const optionValue = document.getElementById("option-value");
  optionVariation.value = "color"; // Set the default value
  configureDropDownLists(optionVariation, optionValue);
});
function configureDropDownLists(optionVariation, optionValue) {
  const options = {
    color: ["Red", "White", "Black", "Gray", "Green"],
    size: ["Small", "Extra Small", "Medium", "Large", "Extra Large"],
    material: ["Cotton", "Denim", "Fabric"],
    style: ["Festive", "Fusion", "Daily"],
  };

  const selectedOptions = options[optionVariation.value] || [];
  optionValue.options.length = 0;

  selectedOptions.forEach((option) => createOption(optionValue, option, option));
}

function createOption(ddl, text, value) {
  const opt = document.createElement("option");
  opt.value = value;
  opt.text = text;
  ddl.add(opt);
}

// ============== Previous - next button ================
function handleNextButtonClick(nextTabId) {
  const nextTab = document.getElementById(nextTabId);
  const tab = new bootstrap.Tab(nextTab);
  tab.show();
}

// ============ Toast =============
function handleSubmitButtonClick() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    },
  });
  Toast.fire({
    icon: "success",
    title: "Successfully",
  });
}
