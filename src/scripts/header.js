// Burger menu
const menu = document.querySelector(".header__menu__container");
const openButton = document.querySelector(".burger");
const closeButton = document.querySelector(".header__menu__close-button");

openButton.addEventListener("click", function () {
  menu.classList.toggle("open");
  document.body.classList.toggle("modal-open");
  menu.addEventListener("click", closeByBgdClick);
  closeButton.addEventListener("click", hideMenu);
});
function hideMenu() {
  menu.classList.remove("open");
  document.body.classList.remove("modal-open");
  closeButton.removeEventListener("click", hideMenu);
  menu.removeEventListener("click", closeByBgdClick);
  projectsIcon.classList.remove("open");
  openProjects.classList.remove("open");
}
function closeByBgdClick(e) {
  if (e.target === menu) {
    hideMenu();
  }
}
// Language menu
document.addEventListener("DOMContentLoaded", function () {
  const languageDropdown = document.querySelector(".language__dropdown");
  const languageDropdownContent = document.querySelector(
    ".language__dropdown__content"
  );

  languageDropdown.addEventListener("click", function () {
    languageDropdownContent.style.display =
      languageDropdownContent.style.display === "flex" ? "none" : "flex";
  });

  document.addEventListener("click", function (event) {
    if (!languageDropdown.contains(event.target)) {
      languageDropdownContent.style.display = "none";
    }
  });
});
// Projects menu
document.addEventListener("DOMContentLoaded", function () {
  const openProjects = document.querySelector(".header__menu__projects");
  const projectsMenu = document.querySelector(".header__projects__menu");
  const projectsIcon = document.querySelector(".header__projects__icon");

  openProjects.addEventListener("click", function () {
    openProjects.classList.contains("open")
      ? openProjects.classList.remove("open")
      : openProjects.classList.add("open");
    projectsIcon.classList.contains("open")
      ? projectsIcon.classList.remove("open")
      : projectsIcon.classList.add("open");
    projectsMenu.style.display =
      projectsMenu.style.display === "flex" ? "none" : "flex";
  });

  document.addEventListener("click", function (event) {
    if (!openProjects.contains(event.target)) {
      projectsMenu.style.display = "none";
      projectsIcon.classList.remove("open");
      openProjects.classList.remove("open");
    }
  });
});
