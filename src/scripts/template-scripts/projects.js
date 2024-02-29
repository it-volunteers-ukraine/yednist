document.addEventListener("DOMContentLoaded", function () {
  const projectsSwiper = new Swiper(".projects__swiper", {
    slidesPerView: 5,
    direction: "vertical",
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    slidesPerGroup: 3,
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
            console.log(index);
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
        },
        navigation: {
          nextEl: ".custom-button-next",
          prevEl: ".custom-button-prev",
        },
      },
    },
  });
  console.log(projectsSwiper);

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
