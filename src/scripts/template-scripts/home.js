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
  });

  const digitsSwiper = new Swiper(".digits-section__slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      slideToClickedSlide: true,
    },
    breakpoints: {
      576: {
        slidesPerView: 3,
        spaceBetween: 0,
        grid: {
          rows: 1,
        },
      },
    },
  });

  //numbers underlines
  function onEntry(entry) {
    entry.forEach((change) => {
      if (change.isIntersecting) {
        change.target.classList.add("element-show");
      }
    });
  }

  let observer = new IntersectionObserver(onEntry);
  let elements = document.querySelectorAll(".digits-js");
  for (let elm of elements) {
    observer.observe(elm);
  }

  const momentsSwiper = new Swiper(".moments-section__slider", {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      slideToClickedSlide: true,
    },
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

  const partnersSwiper = new Swiper(".our-partners-section__slider", {
    slidesPerView: 2,
    spaceBetween: 16,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    breakpoints: {
      576: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      1200: {
        slidesPerView: 5,
        spaceBetween: 20,
      },
    },
  });
});
