const openFeedbackFormButton = document.getElementById("js-open-feedback-form");
const closeFeedbackFormButton = document.getElementById(
  "js-close-feedback-form"
);
const feedbackBackdrop = document.getElementById("js-feedback-form");
const feedbackModalEl = document.querySelector(".feedback-modal");

if (openFeedbackFormButton) {
  openFeedbackFormButton.addEventListener("click", showMenu);

  let screenHeight = window.innerHeight;
  const computedStyle = getComputedStyle(feedbackModalEl);
  const containerHeight = Number.parseInt(computedStyle.height);

  function lookForSizeChanges(e) {
    screenHeight = window.innerHeight;
    screenOrientation(screenHeight);
  }

  function screenOrientation(height) {
    if (containerHeight > height) {
      feedbackModalEl.classList.add("horizontal");
    } else {
      feedbackModalEl.classList.remove("horizontal");
    }
  }

  function showMenu() {
    const windowScrollY = window.scrollY;
    feedbackBackdrop.classList.remove("is-hidden");
    screenOrientation(screenHeight);

    closeFeedbackFormButton.addEventListener("click", hideMenu);
    feedbackBackdrop.addEventListener("click", closeByBgdClick);
    window.addEventListener("keydown", closeByPressEscape);
    window.addEventListener("resize", lookForSizeChanges);

    document.body.style.position = "fixed";
    document.body.style.top = `-${windowScrollY}px`;
  }

  function hideMenu() {
    feedbackBackdrop.classList.add("is-hidden");
    closeFeedbackFormButton.removeEventListener("click", hideMenu);
    feedbackBackdrop.removeEventListener("click", closeByBgdClick);
    feedbackModalEl.classList.remove("horizontal");

    const scrollY = document.body.style.top;
    document.body.style.position = "";
    document.body.style.top = "";
    window.scrollTo(0, parseInt(scrollY || "0") * -1);
  }

  function closeByBgdClick(e) {
    if (e.target === feedbackBackdrop) {
      hideMenu();
    }
  }

  function closeByPressEscape(e) {
    e.preventDefault;
    if (e.code === "Escape") {
      hideMenu();
      window.removeEventListener("keydown", closeByPressEscape);
    }
  }
}
