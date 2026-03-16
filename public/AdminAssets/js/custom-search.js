// Custom search JS

(function () {
  const search_swiper = new Swiper(".audio-slider", {
    slidesPerView: 5,
    spaceBetween: 20,
    loop: false,
    autoplay: {
      delay: 2000,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  function searchBreakpoints() {
    if (document.body.classList.contains("box-layout")) {
      search_swiper.params.breakpoints = {
        0: {
          slidesPerView: 1,
          spaceBetween: 12,
        },
        655: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      };
    } else {
      search_swiper.params.breakpoints = {
        0: {
          slidesPerView: 1,
          spaceBetween: 12,
        },
        655: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1530: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        1750: {
          spaceBetween: 20,
        },
      };
    }
    search_swiper.update();
  }

  const searchObserve = new MutationObserver(() => {
    searchBreakpoints();
  });

  searchObserve.observe(document.body, {
    attributes: true,
    attributeFilter: ["class"],
  });
  searchBreakpoints();
})();
