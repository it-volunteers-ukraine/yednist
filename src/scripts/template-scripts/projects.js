document.addEventListener("DOMContentLoaded", function () {
  console.log(new Swiper(".projects__list__slider"));
  const projectsSwiper = new Swiper(".projects__list__slider", {
    slidesPerView: 3,
    spaceBetween: 60,
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    pagination: {
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + "</span>";
      },
    },
  });
});
