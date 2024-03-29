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

  const partnersSwiper = new Swiper(".our-partners-section__slider", {
    slidesPerView: 2,
    spaceBetween: 16,
    loop: true,
    lazy: {
      loadOnTransitionStart: true,
      loadPrevNext: true,
    },
    lazyPreloadPrevNext: 1,
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

  // accordion
  const acc = document.getElementsByClassName("accordion");

  for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      this.classList.toggle("active");

      if (this.classList.contains("active")) {
        this.setAttribute("aria-expanded", "true");
      } else this.setAttribute("aria-expanded", "false");

      const panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
});
