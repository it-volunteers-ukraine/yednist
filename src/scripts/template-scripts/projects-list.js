document.addEventListener("DOMContentLoaded", function () {
  const projectsSwiper = new Swiper(".projects__section__swiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    autoHeight: true,
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    pagination: {
      el: ".swiper-pagination",
      type: "fraction",
    },
    navigation: {
      nextEl: ".custom-button-next",
      prevEl: ".custom-button-prev",
    },
    breakpoints: {
      576: {
        pagination: {
          clickable: true,
          type: "bullets",
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
        },
        navigation: {
          nextEl: ".custom-button-next",
          prevEl: ".custom-button-prev",
        },
      },
      992: {
        slidesPerView: 1,
        spaceBetween: 40,
        pagination: {
          clickable: true,
          type: "bullets",
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
        },
      },
      1441: {
        slidesPerView: 1,
        spaceBetween: 60,
        pagination: {
          clickable: true,
          type: "bullets",
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
        },
      },
    },
  });
  // Scroll
  const paginationItems = document.querySelectorAll(
    ".projects__section .swiper-pagination-bullet"
  );
  const prevButton = document.querySelector(
    ".projects__section .custom-button-prev"
  );
  const nextButton = document.querySelector(
    ".projects__section .custom-button-next"
  );
  if (paginationItems.length !== 0) {
    paginationItems.forEach((item) => {
      item.addEventListener("click", scrollToTop);
    });
    prevButton.addEventListener("click", scrollToTop);
    nextButton.addEventListener("click", scrollToTop);
  }

  function scrollToTop() {
    window.scrollTo({
      top: 0,
    });
  }
});
