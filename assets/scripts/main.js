console.log("footer part");
const elList = document.querySelectorAll(".acc-show"),
  myButton = document.querySelector(".btn-to-top-container"),
  heightHeader = document
    .querySelector(".header")
    .getBoundingClientRect().height,
  footer = document.querySelector(".footer"),
  heightFooter = footer.getBoundingClientRect().height;
window.onscroll = function () {
  scrollFunction();
};
const observer = new IntersectionObserver(
  (e) => {
    e[0].isIntersecting
      ? (myButton.classList.add("btn-absolute"),
        myButton.classList.remove("btn-fixed"))
      : (myButton.classList.add("btn-fixed"),
        myButton.classList.remove("btn-absolute"));
  },
  { rootMargin: "40px" }
);
function scrollFunction() {
  document.body.scrollTop > heightHeader ||
  document.documentElement.scrollTop > heightHeader
    ? (myButton.style.display = "flex")
    : (myButton.style.display = "none");
}
function topFunction() {
  (document.body.scrollTop = 0), (document.documentElement.scrollTop = 0);
}
window.addEventListener("resize", (e) => {
  window.innerWidth >= 1440
    ? (observer.rootMargin = "40px")
    : window.innerWidth < 1440
    ? (observer.rootMargin = "20px")
    : window.innerWidth < 768
    ? (observer.rootMargin = "28px")
    : window.innerWidth < 576 && (observer.rootMargin = "16px");
}),
  observer.observe(footer);
const handleAccToggle = (e) => {
  if (window.innerWidth > 767.97) return;
  const t = e.target.nextElementSibling;
  e.target.classList.contains("expanded")
    ? (e.target.classList.remove("expanded"),
      e.target.setAttribute("aria-expanded", "false"),
      (t.style.maxHeight = null))
    : (e.target.classList.add("expanded"),
      e.target.setAttribute("aria-expanded", "true"),
      (t.style.maxHeight = t.scrollHeight + 16 + "px"));
};
elList.forEach((e) => {
  window.innerWidth < 768 && e.setAttribute("role", "button"),
    e.addEventListener("click", handleAccToggle);
});
const menu = document.querySelector(".header__menu__container"),
  openButton = document.querySelector(".burger"),
  closeButton = document.querySelector(".header__menu__close-button"),
  button = document.querySelector(".btn-to-top-container"),
  languageDropdown = document.querySelector(".language__dropdown"),
  languageDropdownContent = document.querySelector(
    ".language__dropdown__content"
  ),
  openProjects = document.querySelector(".header__projects__content"),
  projects = document.querySelector(".header__menu__projects"),
  projectsMenu = document.querySelector(".header__projects__menu"),
  projectsIcon = document.querySelector(".header__projects__icon");
function hideMenu() {
  menu.classList.remove("open"),
    closeButton.removeEventListener("click", hideMenu),
    menu.removeEventListener("click", closeByBgdClick),
    projectsIcon.classList.remove("open"),
    openProjects.classList.remove("open"),
    projects.classList.remove("open"),
    (projectsMenu.style.display = "none"),
    (document.documentElement.style.overflow = "hidden auto"),
    (document.documentElement.style.scrollBehavior = "smooth");
}
function closeByBgdClick(e) {
  e.target === menu && hideMenu();
}
function redirectToPage(e) {
  window.location.href = e;
}
openButton.addEventListener("click", function () {
  menu.classList.toggle("open"),
    (document.documentElement.style.scrollBehavior = "auto"),
    (document.documentElement.style.overflow = "hidden"),
    (button.style.display = "none"),
    menu.addEventListener("click", closeByBgdClick),
    closeButton.addEventListener("click", hideMenu);
}),
  document.addEventListener("DOMContentLoaded", function () {
    languageDropdown.addEventListener("click", function () {
      languageDropdownContent.style.display =
        "flex" === languageDropdownContent.style.display ? "none" : "flex";
    }),
      document.addEventListener("click", function (e) {
        languageDropdown.contains(e.target) ||
          (languageDropdownContent.style.display = "none");
      });
  }),
  document.addEventListener("DOMContentLoaded", function () {
    openProjects.addEventListener("click", function () {
      projects.classList.contains("open")
        ? projects.classList.remove("open")
        : projects.classList.add("open"),
        projectsIcon.classList.contains("open")
          ? projectsIcon.classList.remove("open")
          : projectsIcon.classList.add("open"),
        (projectsMenu.style.display =
          "flex" === projectsMenu.style.display ? "none" : "flex");
    }),
      closeButton.addEventListener("click", function (e) {
        openProjects.contains(e.target) ||
          (menu.addEventListener("click", closeByBgdClick),
          (projectsMenu.style.display = "none"),
          projectsIcon.classList.remove("open"),
          projects.classList.remove("open"));
      }),
      document.addEventListener("click", function (e) {
        openProjects.contains(e.target) ||
          (menu.addEventListener("click", closeByBgdClick),
          (projectsMenu.style.display = "none"),
          projectsIcon.classList.remove("open"),
          projects.classList.remove("open"));
      });
  }),
  console.log("main");
