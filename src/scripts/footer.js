console.log("footer part");

const elList = document.querySelectorAll(".acc-show");

const myButton = document.querySelector(".btn-to-top-container");
const heightHeader = document
  .querySelector(".header")
  .getBoundingClientRect().height;
const footer = document.querySelector(".footer");
const heightFooter = footer.getBoundingClientRect().height;

myButton.addEventListener("click", topFunction);

window.onscroll = function () {
  scrollFunction();
};

const observer = new IntersectionObserver(
  (entries) => {
    const footerEntry = entries[0];
    if (footerEntry.isIntersecting) {
      myButton.classList.add("btn-absolute");
      myButton.classList.remove("btn-fixed");
    } else {
      myButton.classList.add("btn-fixed");
      myButton.classList.remove("btn-absolute");
    }
  },
  { rootMargin: "40px" }
);

window.addEventListener("resize", (e) => {
  if (window.innerWidth >= 1440) {
    observer.rootMargin = "40px";
  } else if (window.innerWidth < 1440) {
    observer.rootMargin = "20px";
  } else if (window.innerWidth < 768) {
    observer.rootMargin = "28px";
  } else if (window.innerWidth < 576) {
    observer.rootMargin = "16px";
  }
});

observer.observe(footer);

function scrollFunction() {
  if (
    document.body.scrollTop > heightHeader ||
    document.documentElement.scrollTop > heightHeader
  ) {
    myButton.style.display = "flex";
  } else {
    myButton.style.display = "none";
  }
}

function topFunction() {
  window.scrollTo({ top: 0, behavior: "smooth" });
  // document.body.scrollTop = 0;
  // document.documentElement.scrollTop = 0;
}

const handleAccToggle = (e) => {
  if (window.innerWidth > 767.97) {
    return;
  }

  const accContainer = e.target.nextElementSibling;
  if (e.target.classList.contains("expanded")) {
    e.target.classList.remove("expanded");
    e.target.setAttribute("aria-expanded", "false");
    accContainer.style.maxHeight = null;
  } else {
    e.target.classList.add("expanded");
    e.target.setAttribute("aria-expanded", "true");
    accContainer.style.maxHeight = accContainer.scrollHeight + 16 + "px";
  }
};

elList.forEach((el) => {
  if (window.innerWidth < 768) {
    el.setAttribute("role", "button");
  }
  el.addEventListener("click", handleAccToggle);
});
