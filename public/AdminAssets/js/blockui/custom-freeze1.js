// Refresh loader JS

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
})();
