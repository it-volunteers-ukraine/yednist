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

const readMoreBtn = document.querySelector(
  ".fioh-team__team-repeater-item-readmore"
);
readMoreBtn.addEventListener("click", () => {
  const text = document.querySelector(".fioh-team__team-repeater-item-bio");
  const container = document.querySelector(".fioh-team__team-repeater");
  text.classList.toggle("expanded");
  container.classList.toggle("expanded");
  if (text.classList.contains("expanded")) {
    readMoreBtn.setAttribute("data-action", "hide");
  } else {
    readMoreBtn.setAttribute("data-action", "show");
  }
});
