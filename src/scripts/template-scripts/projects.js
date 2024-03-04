document.addEventListener("DOMContentLoaded", function () {
  // Scroll
  const paginationItems = document.querySelectorAll(
    ".projects__section .swiper-pagination-bullet"
  );
  const prevButton = document.querySelector(
    ".projects__section .custom-button-prev"
  );
  const nextButton = document.querySelector(
    ".projects__section .custom-button-next"
  );

  paginationItems.forEach((item) => {
    item.addEventListener("click", scrollToTop);
  });
  prevButton.addEventListener("click", scrollToTop);
  nextButton.addEventListener("click", scrollToTop);

  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  }
});
