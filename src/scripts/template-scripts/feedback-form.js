const openFeedbackFormButton = document.getElementById("js-open-feedback-form");
const closeFeedbackFormButton = document.getElementById(
  "js-close-feedback-form"
);
const feedbackBackdrop = document.getElementById("js-feedback-form");

openFeedbackFormButton.addEventListener("click", showMenu);

function showMenu() {
  feedbackBackdrop.classList.remove("is-hidden");
  closeFeedbackFormButton.addEventListener("click", hideMenu);
  feedbackBackdrop.addEventListener("click", closeByBgdClick);
}

function hideMenu() {
  feedbackBackdrop.classList.add("is-hidden");
  closeFeedbackFormButton.removeEventListener("click", hideMenu);
  feedbackBackdrop.removeEventListener("click", closeByBgdClick);
}

function closeByBgdClick(e) {
  if (e.target === feedbackBackdrop) {
    hideMenu();
  }
}
