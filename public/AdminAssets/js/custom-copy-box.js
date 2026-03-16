//  Custom copy box JS (Using API copy)

(function () {
  document.querySelectorAll(".copy-btn").forEach((button) => {
    button.addEventListener("click", () => {
      const commonSpace = button.closest(".common-f-start");
      const copiedText = commonSpace.querySelector(".copied-api").textContent;

      const toastPosition = document.body.classList.contains("rtl") ? "top-start" : "top-end";

      // Copy text to clipboard
      navigator.clipboard
        .writeText(copiedText)
        .then(() => {
          // Show success toast
          Swal.fire({
            toast: true,
            position: toastPosition,
            icon: "success",
            title: "Copied API Key",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          // Change the button icon to indicate success
          button.classList.replace("fa-copy", "fa-check");

          // Revert the icon back to 'fa-copy' after 2 seconds
          setTimeout(() => button.classList.replace("fa-check", "fa-copy"), 2000);
        })
        .catch((err) => {
          // Show error toast in case of failure
          Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Failed to Copy",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });
          console.error("Failed to copy text:", err);
        });
    });
  });
})();
