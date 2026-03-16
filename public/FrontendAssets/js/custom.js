/*==========

Theme Name: SpiffyPlay - Music Design HTML5 Template
Theme Version: 1.0

==========*/

/*==========
----- JS INDEX -----
1. Whole Script Strict Mode Syntax
2. Header-Menu Scroll
3. Event Slider JS
4. Video Slider JS
5. Sponsor Slider JS
6. Page Loader And WOW Animation JS
7. Menu Open JS
8. Sticky Header JS
9. Scroll To Top JS
10. Active Menu JS
11. CountDown JS
12. Vanta.js script
13. Scroll Animations & Mouse Parallax
14. Typing Effect
15. Chatbox Toggle Script
==========*/

$(document).ready(function ($) {
  "use strict";

  // 2. Header-Menu Scroll
  $('.header-menu ul li a').on('click', function (evt) {
    evt.preventDefault();
    var url = $(this).attr('href');
    var id = url.substring(url.lastIndexOf('/') + 1);
    if ($(id).length > 0) {
      $('html, body').animate({
        scrollTop: $(id).offset().top - 10
      }, 100);
    } else {
      window.location.href = url;
    }
  });

  // 3. Event Slider JS
  var event_slider = new Swiper(".event-slider", {
    loop: true,
    slidesPerView: 2,
    spaceBetween: 0,
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    coverflowEffect: {
      rotate: 20,
      stretch: 80,
      depth: 200,
      modifier: 1,
      slideShadows: false,
    },
    autoplay: true,
    speed: 3000,
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 30,
        effect: false,
      },
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 1.5,
      },
      1024: {
        slidesPerView: 2,
      },
    },
  });

  // 4. Video Slider JS
  var video_slider = new Swiper(".video-slider", {
    slidesPerView: 4,
    spaceBetween: 10,
    loop: true,
    grabCursor: true,
    centeredSlides: true,
    speed: 10000,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    }
  });

  // 5. Sponsor Slider JS
  var sponsor_slider = new Swiper(".sponsor-slider", {
    slidesPerView: 6,
    spaceBetween: 30,
    loop: true,
    autoplay: true,
    speed: 4000,
    breakpoints: {
      320: {
        slidesPerView: 2,
      },
      640: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 6,
      },
    }
  });

  // 5. Sponsor Slider JS
  var sponsor_slider = new Swiper(".brand-slider", {
    slidesPerView: 5,
    spaceBetween: 30,
    loop: true,
    autoplay: true,
    speed: 4000,
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      576: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 4,
      },
      1420: {
        slidesPerView: 6,
      },
    }
  });

  // 6. Page Loader And Wow Animation JS
  $(window).on('load', function () {
    $('.page-loader').fadeOut();
    $('body').removeClass('body-fixed');
    if (typeof WOW === 'function') new WOW().init();
  });

  // 7. Menu Open JS
  $(".hamburger").click(function () {
    $(".main-navigation").toggleClass("toggled");
  });

  $('.header-menu ul li a').click(function () {
    $('.main-navigation').removeClass('toggled');
  });

  // 8. Sticky Header JS
  $(window).scroll(function () {
    var height = $(window).scrollTop();
    if (height > 100) {
      $(".site-header").addClass("sticky_head");
    } else {
      $(".site-header").removeClass("sticky_head");
    }
  });

  // 9. Scroll To Top JS
  $('#scrollToTop').click(function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });

  // 10. Active Menu JS
  var sections = $('section'),
    nav = $('nav'),
    nav_height = nav.outerHeight();

  $(window).on('scroll', function () {
    var cur_pos = $(this).scrollTop();

    sections.each(function () {
      var top = $(this).offset().top - nav_height,
        bottom = top + $(this).outerHeight();

      if (cur_pos >= top && cur_pos <= bottom) {
        nav.find('a').removeClass('active-menu');
        sections.removeClass('active-menu');

        $(this).addClass('active-menu');
        nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active-menu');
      }
    });
  });

  nav.find('a').on('click', function () {
    var $el = $(this),
      id = $el.attr('href');

    $('html, body').animate({
      scrollTop: $(id).offset().top - nav_height
    }, 300);
    return false;
  });

}); // End Document Ready

// 11. CountDown JS
(function () {
  const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;

  let countDown = Date.parse("2025-04-10T24:00:00");

  setInterval(function () {
    let now = new Date().getTime();
    let distance = countDown - now;

    if (document.querySelector('.upcoming-section')) {
      document.getElementById('days').innerText = Math.floor(distance / day);
      document.getElementById('hours').innerText = Math.floor((distance % day) / hour);
      document.getElementById('minutes').innerText = Math.floor((distance % hour) / minute);
      document.getElementById('seconds').innerText = Math.floor((distance % minute) / second);
    }
  }, second);
})();

// 12. Vanta.js script
if (typeof VANTA !== "undefined" && VANTA.HALO) {
  VANTA.HALO({
    el: "#vantajs-bg",
    mouseControls: true,
    touchControls: true,
    gyroControls: false,
    minHeight: 200.00,
    minWidth: 200.00
  });
}

// 13. Scroll Animations & Mouse Parallax
document.addEventListener('DOMContentLoaded', () => {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, observerOptions);

  document.querySelectorAll('.about-me .fade-in-on-scroll').forEach(el => {
    observer.observe(el);
  });

  document.addEventListener('mousemove', (e) => {
    const floatingElements = document.querySelectorAll('.about-me .floating-element');
    const mouseX = e.clientX / window.innerWidth;
    const mouseY = e.clientY / window.innerHeight;

    floatingElements.forEach((element, index) => {
      const speed = (index + 1) * 0.5;
      const x = (mouseX - 0.5) * speed * 50;
      const y = (mouseY - 0.5) * speed * 50;
      element.style.transform = `translate(${x}px, ${y}px)`;
    });
  });
});

// // 14. Typing Effect
// window.addEventListener('load', () => {
//   const title = document.querySelector('.about-me .container .title');
//   if (title) {
//     const originalText = title.textContent;
//     title.textContent = '';
//     let i = 0;
//     const typeWriter = () => {
//       if (i < originalText.length) {
//         title.textContent += originalText.charAt(i);
//         i++;
//         setTimeout(typeWriter, 100);
//       }
//     };
//     setTimeout(typeWriter, 1000);
//   }
// });

// 15. Chatbox Toggle Script    

window.addEventListener('DOMContentLoaded', () => {
  const chatbotGif = document.getElementById('chatbotGif');
  const chatBox = document.getElementById('chatBox');

  // ✅ Make sure GIF is visible initially
  if (chatbotGif) chatbotGif.style.display = 'block';

  window.showBox = function () {
    if (chatBox) chatBox.style.display = 'block';
    if (chatbotGif) chatbotGif.style.display = 'none';
  };

  window.hideBox = function () {
    if (chatBox) chatBox.style.display = 'none';
    if (chatbotGif) chatbotGif.style.display = 'block';
  };
});


// navbar fixed js

window.addEventListener("scroll", function () {
  const header = document.querySelector(".site-header");
        if (window.scrollY > 100) {
        header.classList.add("fixed");
        } else {
        header.classList.remove("fixed");
      }
    });
      
// navbar fixed js