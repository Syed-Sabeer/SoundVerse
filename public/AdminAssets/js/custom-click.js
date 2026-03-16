// Fill like(heart icon) JS

// Select all elements with class 'fa-heart' inside 'a' tags
(function () {
  document.querySelectorAll(".fa-heart").forEach((icon) => {
    icon.addEventListener("click", () => {
      icon.classList.toggle("active");
    });
  });
})();
