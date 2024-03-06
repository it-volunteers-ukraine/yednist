// Burger menu
const menu = document.querySelector(".header__menu__container");
const openButton = document.querySelector(".burger");
const closeButton = document.querySelector(".header__menu__close-button");
const button = document.querySelector(".btn-to-top-container");
// Language menu
const languageDropdown = document.querySelector(".language__dropdown");
const languageDropdownContent = document.querySelector(
  ".language__dropdown__content"
);
// Projects menu
const openProjects = document.querySelector(".header__projects__content");
const projects = document.querySelector(".header__menu__projects");
const projectsMenu = document.querySelector(".header__projects__menu");
const projectsIcon = document.querySelector(".header__projects__icon");

// Burger menu
openButton.addEventListener("click", function () {
  menu.classList.toggle("open");
  button.style.display = "none";
  menu.addEventListener("click", closeByBgdClick);
  closeButton.addEventListener("click", hideMenu);
});

// Language menu
document.addEventListener("DOMContentLoaded", function () {
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
  openProjects.addEventListener("click", function () {
    projects.classList.contains("open")
      ? projects.classList.remove("open")
      : projects.classList.add("open");
    projectsIcon.classList.contains("open")
      ? projectsIcon.classList.remove("open")
      : projectsIcon.classList.add("open");
    projectsMenu.style.display =
      projectsMenu.style.display === "flex" ? "none" : "flex";
  });
  closeButton.addEventListener("click", function (event) {
    if (!openProjects.contains(event.target)) {
      menu.addEventListener("click", closeByBgdClick);
      projectsMenu.style.display = "none";
      projectsIcon.classList.remove("open");
      projects.classList.remove("open");
    }
  });
  document.addEventListener("click", function (event) {
    if (!openProjects.contains(event.target)) {
      menu.addEventListener("click", closeByBgdClick);
      projectsMenu.style.display = "none";
      projectsIcon.classList.remove("open");
      projects.classList.remove("open");
    }
  });
});

function hideMenu() {
  menu.classList.remove("open");
  closeButton.removeEventListener("click", hideMenu);
  menu.removeEventListener("click", closeByBgdClick);
  projectsIcon.classList.remove("open");
  openProjects.classList.remove("open");
  projects.classList.remove("open");
  projectsMenu.style.display = "none";
}
function closeByBgdClick(e) {
  if (e.target === menu) {
    hideMenu();
  }
}
function redirectToPage(url) {
  window.location.href = url;
}
