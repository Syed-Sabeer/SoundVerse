// Add product editor JS

(function () {
  var editor2 = new Quill("#editor2", {
    modules: { toolbar: "#toolbar2" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });

  var editor3 = new Quill("#editor3", {
    modules: { toolbar: "#toolbar3" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });

  var editor4 = new Quill("#editor4", {
    modules: { toolbar: "#toolbar4" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });

  // =====================================================================
  function openAlert() {
    var alertBox = document.getElementById("alertBox");
    alertBox.style.display = "block";
  }

  function closeAlert() {
    var alertBox = document.getElementById("alertBox");
    alertBox.style.display = "none";
  }

  var form = document.getElementById("advance-tab");

  var my_func = function (event) {
    event.preventDefault();
  };

  form.addEventListener("submit", my_func, true);

  // ================== Alert Popup ==============
  document.querySelector(".sweet-15").onclick = async function () {
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
      title: "Submitted successfully",
    });
  };
})();
