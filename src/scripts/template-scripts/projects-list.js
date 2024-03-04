document.addEventListener("DOMContentLoaded", function () {
  const projectsSwiper = new Swiper(".projects__section__swiper", {
    slidesPerView: 5,
    spaceBetween: 20,
    slidesPerGroup: 5,
    direction: "vertical",
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
        slidesPerView: 5,
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
        slidesPerView: 5,
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

  const slides = projectsSwiper.slides;
  slides.forEach((slide, index) => {
    if (index % 3 === 0) {
      slide.classList.add("yellow");
    } else if (index % 3 === 1) {
      slide.classList.add("pink");
    } else {
      slide.classList.add("blue");
    }
  });
});
