// Dashboard 8 JS

(function () {
  // Swiper slider1
  const categorySwiper3 = new Swiper(".shop-category-slider", {
    slidesPerView: 9,
    spaceBetween: 5,
    loop: true,
    autoplay: {
      delay: 2000,
    },
  });

  // Function to update breakpoints based on class
  function updateBreakpoints() {
    if (document.body.classList.contains("box-layout")) {
      // Update breakpoints for box layout
      categorySwiper3.params.breakpoints = {
        0: {
          slidesPerView: 2,
          spaceBetween: 12,
        },
        400: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        500: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 5,
          spaceBetween: 20,
        },
        1100: {
          slidesPerView: 6,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 5,
          spaceBetween: 12,
        },
      };
    } else {
      // Reset breakpoints to normal layout
      categorySwiper3.params.breakpoints = {
        0: {
          slidesPerView: 2,
          spaceBetween: 12,
        },
        400: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        500: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 5,
          spaceBetween: 20,
        },
        1100: {
          slidesPerView: 6,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 12,
        },
        1235: {
          slidesPerView: 5,
          spaceBetween: 12,
        },
        1400: {
          slidesPerView: 6,
        },
        1530: {
          slidesPerView: 8,
        },
        1890: {
          slidesPerView: 9,
          spaceBetween: 5,
        },
      };
    }
    categorySwiper3.update();
  }

  // Observe class changes on the body element
  const observer = new MutationObserver(() => {
    updateBreakpoints();
  });

  // Start observing the body element for class changes
  observer.observe(document.body, {
    attributes: true,
    attributeFilter: ["class"],
  });

  // Initial call to set breakpoints based on current class
  updateBreakpoints();

  // ================ Order Details Trash Removes =================
  function CheckProductQuantity() {
    let AllProducts = document.getElementsByClassName("order-details-wrapper");
    let HiddenProducts = document.getElementsByClassName("product-remove");
    if (AllProducts.length == HiddenProducts.length) {
      document.querySelector(".empty-card").classList.add("show");
    }
  }

  const product_details = document.getElementsByClassName("order-details-wrapper");
  const product_details_array = Array.from(product_details); // Convert to array

  product_details_array.forEach((item) => {
    let DeleteButton = item.querySelector(".trash-remove");
    DeleteButton.addEventListener("click", (event) => {
      item.classList.add("product-remove");
      CheckProductQuantity();
    });
  });

  // =================== Our Product Quantity Counts ==============
  let add_quantity = document.querySelectorAll(".add-quantity");
  add_quantity.forEach((item) => {
    var productCounter = {
      count: 1,
      incrementCounter: function () {
        console.log("this.count", this.count);
        if (this.count < 10) {
          return (this.count = this.count + 1);
        } else {
          console.log("limit 10");
          return this.count;
        }
      },
      decrementCounter: function () {
        if (this.count > 1) {
          return (this.count = this.count - 1);
        } else {
          console.log("minimum 1");
          return this.count;
        }
      },
    };
    var displayCount = item.querySelector(".countdown-remove");

    item.querySelector(".increment-btn").onclick = function () {
      console.log("this.count", this.count, productCounter);
      displayCount.value = productCounter.incrementCounter();
      console.log("displayCount.value", displayCount.value);
    };

    item.querySelector(".decrement-btn").onclick = function () {
      displayCount.value = productCounter.decrementCounter();
    };

    displayCount.onchange = function () {
      var newValue = parseInt(displayCount.value);
      if (isNaN(newValue) || newValue < 1) {
        displayCount.value = 1;
      } else if (newValue > 10) {
        displayCount.value = 10;
      } else {
        productCounter.count = newValue;
      }
    };
  });
})();
