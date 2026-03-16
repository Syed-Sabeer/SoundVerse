// Email hide/show JS

(function () {
  const listItems1 = document.querySelectorAll(".email-options");

  listItems1.forEach(function (item) {
    const envelope_1 = item.querySelector(".envelope-1");
    const envelope_2 = item.querySelector(".envelope-2");

    item.addEventListener("click", function () {
      if (envelope_1) {
        envelope_1.classList.toggle("show");
        envelope_2.classList.toggle("hide");
      }
      if (envelope_2) {
        envelope_1.classList.toggle("hide");
        envelope_2.classList.toggle("show");
      }
    });
  });
})();
