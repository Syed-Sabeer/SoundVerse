//  Color Selector JS

(function () {
  var el = document.querySelectorAll(".color-selector li");
  for (let i = 0; i < el.length; i++) {
    el[i].onclick = function () {
      for (let j = 0; j < el.length; j++) {
        el[j].classList.remove("active");
      }
      el[i].classList.add("active");
    };
  }
})();
