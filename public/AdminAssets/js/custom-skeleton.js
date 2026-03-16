// Skeleton loader JS

window.addEventListener("load", function () {
  // Hide the overflow initially
  document.body.style.overflow = "hidden";

  // Set up the skeleton loader fade out after a delay
  setTimeout(function () {
    document.querySelectorAll(".loader_skeleton").forEach(function (loaderSkeleton) {
      loaderSkeleton.style.transition = "opacity 0.6s ease";
      loaderSkeleton.style.opacity = "0";

      // Remove the element after the transition ends
      setTimeout(function () {
        loaderSkeleton.remove();
      }, 600); // Match the duration of the transition
    });

    // Restore the overflow after the fade-out starts
    document.body.style.overflow = "auto";
  }, 500);
});
