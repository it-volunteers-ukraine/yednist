const menu = document.querySelector(".menu__container");
const openButton = document.querySelector(".burger");
const closeButton = document.querySelector(".menu__close-button");

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
}
function closeByBgdClick(e) {
  if (e.target === menu) {
    hideMenu();
  }
}
