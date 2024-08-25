document.addEventListener("DOMContentLoaded", function () {
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
});
