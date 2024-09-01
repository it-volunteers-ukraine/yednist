document.addEventListener("DOMContentLoaded", function () {
  // linked products
  const allProductsArray = document.querySelectorAll(".shop-section .product");
  if (allProductsArray) {
    allProductsArray.forEach((product) => {
      product.classList.add("swiper-slide");
    });
    const recomendedProductsSwiper = new Swiper(".shop-section__slider", {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 16,
      pagination: {
        el: ".shop-section__bullets",
        clickable: true,
        slideToClickedSlide: true,
      },
      breakpoints: {
        576: {
          slidesPerView: 2,
          slidesPerGroup: 2,
          spaceBetween: 46,
        },
        992: {
          slidesPerView: 3,
          slidesPerGroup: 3,
          spaceBetween: 68,
        },
        1441: {
          slidesPerView: 3,
          slidesPerGroup: 3,
          spaceBetween: 94,
        },
      },
    });
  }

  // select
  const variationsSelect = document.querySelector(".variations select");

  if (variationsSelect) {
    const variationSelect = new Choices(variationsSelect, {
      searchEnabled: false,
      allowHTML: false,
      shouldSort: false,
      position: "bottom",
      itemSelectText: "",
    });

    // Listen for when a new choice is made
    variationSelect.passedElement.element.addEventListener(
      "choice",
      selectedElement
    );

    function selectedElement(e) {
      let chosenOptionIndex = e.detail.id - 1;
      variationsSelect.selectedIndex = chosenOptionIndex;
      variationsSelect.dispatchEvent(new Event("change"));
    }
  }
});
