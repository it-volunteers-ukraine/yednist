document.addEventListener("DOMContentLoaded", function () {
  const schoolVideo = document.querySelector(
    ".school__section__content__image"
  );
  const modal = document.getElementById("videoModal");
  schoolVideo.addEventListener("click", function () {
    modal.style.display = "flex";
  });

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});
