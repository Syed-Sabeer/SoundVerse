// Blockui JS

(function () {
  let currentTimeout = null; // Variable to store the current timeout
  let currentFreezeFunction = null; // Variable to store the current freeze function
  let currentUnfreezeFunction = null; // Variable to store the current unfreeze function

  function commonCall(FreezeFun, UnFreezeFun) {
    // Clear the current timeout and stop the ongoing functionality
    clearTimeout(currentTimeout);
    if (currentFreezeFunction && currentUnfreezeFunction) {
      currentUnfreezeFunction();
    }

    // Set the new freeze and unfreeze functions
    currentFreezeFunction = FreezeFun;
    currentUnfreezeFunction = UnFreezeFun;

    // Call the freeze function
    FreezeFun();

    // Set a new timeout to call the unfreeze function after 1 second
    currentTimeout = setTimeout(() => {
      UnFreezeFun();
      currentFreezeFunction = null; // Reset current freeze function after unfreezing
      currentUnfreezeFunction = null; // Reset current unfreeze function after unfreezing
    }, 1000);
  }

  document.querySelector(".block-btn-1").addEventListener("click", () => {
    commonCall(FreezeUI, UnFreezeUI);
  });

  document.querySelector(".block-btn-2").addEventListener("click", () => {
    commonCall(FreezeUI1, UnFreezeUI1);
  });

  document.querySelector(".block-btn-3").addEventListener("click", () => {
    commonCall(FreezeUI3, UnFreezeUI3);
  });

  document.querySelector(".block-btn-4").addEventListener("click", () => {
    commonCall(FreezeUI4, UnFreezeUI4);
  });

  document.querySelector(".block-btn-5").addEventListener("click", () => {
    commonCall(FreezeUI5, UnFreezeUI5);
  });

  document.querySelector(".block-btn-6").addEventListener("click", () => {
    commonCall(FreezeUI6, UnFreezeUI6);
  });

  document.querySelector(".block-btn-7").addEventListener("click", () => {
    commonCall(FreezeUI7, UnFreezeUI7);
  });

  document.querySelector(".block-btn-8").addEventListener("click", () => {
    commonCall(FreezeUI8, UnFreezeUI8);
  });

  document.querySelector(".block-btn-9").addEventListener("click", () => {
    commonCall(FreezeUI9, UnFreezeUI9);
  });
})();
