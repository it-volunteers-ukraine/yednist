new Swiper(".fioh-team__appeal-wrapper-mobile", {
  enabled: true,
  loop: true,
  slidesPerView: 1,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
  },
});

new Swiper(".fioh-team__team-repeater", {
  effect: "slide",
  loop: true,
  slidesPerView: 1,
  spaceBetween: 30,
  direction: "vertical",
  navigation: {
    nextEl: ".fioh-team__team-repeater-item-btn-circle",
  },
});
