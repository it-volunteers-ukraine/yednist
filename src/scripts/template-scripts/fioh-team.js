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

//read-more for team

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

//show elements for projects

const items = document.querySelectorAll(".fioh-team__project__item");
const itemsArr = Array.from(items);
const initialArr = itemsArr.slice(0, getItemsCount());
const slicedArr = itemsArr.slice(getItemsCount());
const showAllBtn = document.querySelector(".btn-show-all");
const hideAllBtn = document.querySelector(".btn-hide-all");

initialArr.forEach((el) => (el.style.display = "flex"));
if (itemsArr.length > getItemsCount()) {
  showAllBtn.style.display = "block";
}
showAllBtn.addEventListener("click", () => {
  slicedArr.forEach((el) => (el.style.display = "flex"));
  showAllBtn.style.display = "none";
  hideAllBtn.style.display = "block";
});
hideAllBtn.addEventListener("click", () => {
  slicedArr.forEach((el) => (el.style.display = "none"));
  hideAllBtn.style.display = "none";
  if (itemsArr.length > getItemsCount()) {
    showAllBtn.style.display = "block";
  }
});

function getItemsCount() {
  if (window.innerWidth > 991.98) {
    return 3;
  } else if (window.innerWidth > 575.98) {
    return 2;
  } else {
    return 1;
  }
}
