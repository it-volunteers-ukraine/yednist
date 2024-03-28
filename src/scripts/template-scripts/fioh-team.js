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

const teamSwiper = new Swiper(".fioh-team__team-repeater", {
  effect: "slide",
  loop: true,
  slidesPerView: 1,
  spaceBetween: 30,
  direction: "horizontal",
  navigation: {
    nextEl: ".fioh-team__team-repeater-item-btn-circle",
  },
  breakpoints: {
    576: {
      direction: "vertical",
    },
  },
});

teamSwiper?.on("slideChange", () => {
  const expandedText = document.querySelector(
    ".fioh-team__team-repeater-item-bio.expanded"
  );
  const expandedContainer = document.querySelector(
    ".fioh-team__team-repeater.expanded"
  );
  if (expandedText) {
    expandedText.classList.remove("expanded");
  }
  if (expandedContainer) {
    expandedContainer.classList.remove("expanded");
  }
});

//read-more for team
const repeaterContainer = document.querySelector(".fioh-team__team-repeater");
const buttons = repeaterContainer.querySelectorAll(
  ".fioh-team__team-repeater-item-readmore"
);
Array.from(buttons).forEach((readMoreBtn) => {
  if (readMoreBtn) {
    readMoreBtn.addEventListener("click", () => {
      const text = readMoreBtn.parentElement.querySelector(
        ".fioh-team__team-repeater-item-bio"
      );
      text.classList.toggle("expanded");
      repeaterContainer.classList.toggle("expanded");
      if (text.classList.contains("expanded")) {
        readMoreBtn.setAttribute("data-action", "hide");
        readMoreBtn.firstElementChild.textContent =
          readMoreBtn.getAttribute("data-hide-text");
      } else {
        readMoreBtn.setAttribute("data-action", "show");
        readMoreBtn.firstElementChild.textContent =
          readMoreBtn.getAttribute("data-show-text");
      }
    });
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
if (showAllBtn) {
  showAllBtn.addEventListener("click", () => {
    slicedArr.forEach((el) => (el.style.display = "flex"));
    showAllBtn.style.display = "none";
    hideAllBtn.style.display = "block";
  });
}

if (hideAllBtn) {
  hideAllBtn.addEventListener("click", () => {
    slicedArr.forEach((el) => (el.style.display = "none"));
    hideAllBtn.style.display = "none";
    if (itemsArr.length > getItemsCount()) {
      showAllBtn.style.display = "block";
    }
  });
}

function getItemsCount() {
  if (window.innerWidth > 991.98) {
    return 3;
  } else if (window.innerWidth > 575.98) {
    return 2;
  } else {
    return 1;
  }
}

const list = document.querySelectorAll(".fioh-team__project__item");
Array.from(list).forEach((el) => {
  el.addEventListener("click", (e) => {
    const modal = el.querySelector(".fioh-team__modal");
    const video = modal.querySelector("iframe");

    video.src += "?enablejsapi=1";

    modal.style.display = "block";
    if (e.target.classList.contains("fioh-team__modal_background")) {
      modal.style.display = "none";
      video.contentWindow.postMessage(
        '{"event":"command","func":"' + "stopVideo" + '","args":""}',
        "*"
      );
      if (video.src.includes("enablejsapi=1")) {
        video.src = video.src.replace("?enablejsapi=1", "");
      }
    }
  });
});
