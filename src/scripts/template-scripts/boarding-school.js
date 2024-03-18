document.addEventListener("DOMContentLoaded", function () {
  const schoolVideo = document.querySelector(
    ".school__section__content__image"
  );
  const modal = document.getElementById("videoModal");
  schoolVideo.addEventListener("click", function () {
    modal.style.display = "flex";
  });

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
  const screenWidth575 = window.matchMedia("(max-width: 575.98px)");

  function initSwiper() {
    if (screenWidth575.matches) {
      const schoolSwiper = new Swiper(".appeal__swiper", {
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 12,
        grabCursor: true,
        direction: "horizontal",
        pagination: {
          el: ".swiper-pagination",
          type: "bullets",
          clickable: true,
          dynamicBullets: true,
        },
      });
      console.log(schoolSwiper);
    }
  }
  initSwiper(); // Инициализация свайпера при загрузке страницы

  // Слушатель событий для изменения размера экрана
  screenWidth575.addListener(initSwiper);
});
