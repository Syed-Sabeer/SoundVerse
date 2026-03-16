// E-commerce JS

(function ($) {
  "use strict";

  var ecommerce_product = {
    init: function () {
      var sync1 = $("#sync1");
      var sync2 = $("#sync2");
      var slidesPerPage = 4;
      var syncedSecondary = true;
      sync1
        .owlCarousel({
          items: 1,
          slideSpeed: 2000,
          nav: false,
          autoplay: true,
          dots: false,
          loop: true,
          responsiveRefreshRate: 200,
        })
        .on("changed.owl.carousel", syncPosition);
      sync2
        .on("initialized.owl.carousel", function () {
          sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
          items: slidesPerPage,
          dots: false,
          nav: false,
          smartSpeed: 200,
          slideSpeed: 500,
          slideBy: slidesPerPage,
          responsiveRefreshRate: 100,
          margin: 15,
        })
        .on("changed.owl.carousel", syncPosition2);
      function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
        if (current < 0) {
          current = count;
        }
        if (current > count) {
          current = 0;
        }
        sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();
        if (current > end) {
          sync2.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
          sync2.data("owl.carousel").to(current - onscreen, 100, true);
        }
      }
      function syncPosition2(el) {
        if (syncedSecondary) {
          var number = el.item.index;
          sync1.data("owl.carousel").to(number, 100, true);
        }
      }
      sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
      });
    },
  };
  ecommerce_product.init();

  var ecommerce_product2 = {
    init: function () {
      var sync1 = $("#sync1-rtl");
      var sync2 = $("#sync2-rtl");
      var slidesPerPage = 4;
      var syncedSecondary = true;
      sync1
        .owlCarousel({
          rtl: true,
          items: 1,
          slideSpeed: 2000,
          nav: false,
          autoplay: true,
          dots: false,
          loop: true,
          responsiveRefreshRate: 200,
        })
        .on("changed.owl.carousel", syncPosition);
      sync2
        .on("initialized.owl.carousel", function () {
          sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
          rtl: true,
          items: slidesPerPage,
          dots: false,
          nav: false,
          smartSpeed: 200,
          slideSpeed: 500,
          slideBy: slidesPerPage,
          responsiveRefreshRate: 100,
          margin: 15,
        })
        .on("changed.owl.carousel", syncPosition2);
      function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
        if (current < 0) {
          current = count;
        }
        if (current > count) {
          current = 0;
        }
        sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
        var onscreen = sync2.find(".owl-item.active").length - 1;
        var start = sync2.find(".owl-item.active").first().index();
        var end = sync2.find(".owl-item.active").last().index();
        if (current > end) {
          sync2.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
          sync2.data("owl.carousel").to(current - onscreen, 100, true);
        }
      }
      function syncPosition2(el) {
        if (syncedSecondary) {
          var number = el.item.index;
          sync1.data("owl.carousel").to(number, 100, true);
        }
      }
      sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data("owl.carousel").to(number, 300, true);
      });
    },
  };
  ecommerce_product2.init();

  // Star rating
  const starBox = document.querySelectorAll(".star-box i");

  starBox.forEach((star, index1) => star.addEventListener("click", () => starBox.forEach((star, index2) => (index1 >= index2 ? star.classList.add("active") : star.classList.remove("active")))));
  function upStars(val) {
    var val = parseFloat(val);
    $("#rating-result").html(val.toFixed(1));

    var full = Number.isInteger(val);
    val = parseInt(val);
    var stars = $("#starrate i");

    stars.slice(0, val).attr("class", "fa-solid fa-star");
    if (!full) {
      stars.slice(val, val + 1).attr("class", "fa-solid fa-star-half-stroke");
      val++;
    }
    stars.slice(val, 5).attr("class", "fa-regular fa-star");
  }

  $(document).ready(function () {
    $(".starrate span.ctrl").width($(".starrate span.cont").width());
    $(".starrate span.ctrl").height($(".starrate span.cont").height());
  });
})(jQuery);
