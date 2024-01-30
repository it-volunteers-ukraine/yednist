document.addEventListener("DOMContentLoaded", function () {
  const valuesSwiper = new Swiper(".values-section__slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      slideToClickedSlide: true,
    },
    breakpoints: {
      576: {
        slidesPerView: 3,
        grid: {
          rows: 1,
        },
      },
    },
  });
});
