// ============= Clipboard Copy/Cut JS =============
(function () {
  "use strict";
  var clipboard = new ClipboardJS(".btn-clipboard");
  clipboard.on("success", function (e) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "success",
      title: "Copied to Clipboard ",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });
    e.clearSelection();
  });
  clipboard.on("error", function (e) {});

  var clipboard = new ClipboardJS(".btn-clipboard-cut");
  clipboard.on("success", function (e) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "success",
      title: "Copied to Clipboard",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });
    e.clearSelection();
  });
  clipboard.on("error", function (e) {});
})();
