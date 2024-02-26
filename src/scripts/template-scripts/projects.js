document.addEventListener("DOMContentLoaded", function () {
  const projectsSwiper = new Swiper(".projects__list", {
    slidesPerView: 3,
    spaceBetween: 60,
    direction: "vertical",
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    pagination: {
      clickable: true,
      el: ".swiper-pagination",
      renderBullet: function (index, className) {
        console.log(index);
        return '<span class="' + className + '">' + (index + 1) + "</span>";
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
