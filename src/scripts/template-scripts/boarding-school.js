document.addEventListener("DOMContentLoaded", function () {
  const schoolVideo = document.querySelector(".main__section__content__image");
  const modal = document.getElementById("mainVideoModal");
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
        },
      });
      const goalsSwiper = new Swiper(".goals__section__swiper", {
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 20,
        grabCursor: true,
        direction: "horizontal",
        pagination: {
          el: ".swiper-pagination",
          type: "bullets",
          clickable: true,
        },
      });
      const yearsSwiper = new Swiper(".years__section .inner-container", {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 20,
        grabCursor: true,
        direction: "horizontal",
        pagination: {
          el: ".swiper-pagination",
          type: "bullets",
          clickable: true,
        },
      });
      console.log(yearsSwiper);
    }
  }
  initSwiper();

  screenWidth575.addEventListener("change", initSwiper);

  const screenWidth992 = window.matchMedia("(min-width: 992px)");

  function initIntersectionObserver() {
    const circles = document.querySelectorAll(
      ".years__section__timeline__point__circle"
    );
    const texts = document.querySelectorAll(
      ".years__section__timeline__point__text-wrapper"
    );

    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              entry.target.querySelector(
                ".years__section__timeline__point__circle"
              ).style.animation = "fill 1s forwards";
              entry.target.querySelector(
                ".years__section__timeline__point__text-wrapper"
              ).style.animation = "opacity 1s forwards";
            }, index * 1000);
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.5 }
    );

    circles.forEach((circle) => {
      observer.observe(circle);
    });
    texts.forEach((text) => {
      observer.observe(text.parentElement);
    });
  }

  function handleScreenWidthChange(screenWidth992) {
    if (screenWidth992.matches) {
      initIntersectionObserver();
    }
  }

  handleScreenWidthChange(screenWidth992);

  screenWidth992.addEventListener("change", function () {
    handleScreenWidthChange(screenWidth992);
  });
});
