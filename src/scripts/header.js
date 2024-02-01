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
document.addEventListener("DOMContentLoaded", function () {
  // Получаем элементы для работы с выпадающим списком
  const languageDropdown = document.querySelector(".language-dropdown");
  const languageDropdownContent = document.querySelector(
    ".language-dropdown-content"
  );

  // Добавляем обработчик клика для открытия/закрытия выпадающего списка
  languageDropdown.addEventListener("click", function () {
    languageDropdownContent.style.display =
      languageDropdownContent.style.display === "flex" ? "none" : "flex";
  });

  // Закрываем выпадающий список при клике вне него
  document.addEventListener("click", function (event) {
    if (!languageDropdown.contains(event.target)) {
      languageDropdownContent.style.display = "none";
    }
  });
});
