document.addEventListener("DOMContentLoaded", function () {
  const momentsSwiper = new Swiper(".moments-section__slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      slideToClickedSlide: true,
    },
    preloadImages: false,
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    lazyPreloadPrevNext: 2,
    breakpoints: {
      576: {
        slidesPerView: 2,
        spaceBetween: 20,
        slidesPerGroup: 2,
      },
      992: {
        slidesPerView: 2,
        slidesPerGroup: 2,
        spaceBetween: 40,
        navigation: {
          nextEl: ".custom-button-next",
          prevEl: ".custom-button-prev",
        },
      },
    },
  });
});
