// Modal-animated JS

(function () {
  "use strict";
  var toastElList = [].slice.call(document.querySelectorAll(".toast"));
  var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl);
  });
  function testAnim(element, animationClass) {
    element.classList = "modal-dialog " + animationClass + " animated";
  }

  function initModalAnimate() {
    var myModal = document.getElementById("myModal");
    var entrance = document.getElementById("entrance");
    var exit = document.getElementById("exit");

    function handleModalAnimation(event) {
      var anim = event === "show" ? entrance.value : exit.value;
      testAnim(myModal.querySelector(".modal-dialog"), anim);
    }

    myModal.addEventListener("show.bs.modal", function () {
      handleModalAnimation("show");
    });

    myModal.addEventListener("hide.bs.modal", function () {
      handleModalAnimation("hide");
    });
  }

  document.addEventListener("DOMContentLoaded", initModalAnimate);
})();
