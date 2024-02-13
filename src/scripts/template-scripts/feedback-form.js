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

const feedbackForm = document.getElementById(
  "acf-field_65c9c24452e5e-field_65c92299c6ba0"
);
const additionalField = document.querySelector(".acf-field-65c923c92be46");
const choicesFeedbackForm = new Choices(feedbackForm, {
  placeholderValue: "Виберіть програму...",
  searchEnabled: false,
  allowHTML: false,
  shouldSort: false,
  position: "bottom",
  itemSelectText: "",
});

const innerChoises = document.querySelector(
  ".acf-field-65c92299c6ba0 .choices__inner"
);
const choicesLength = choicesFeedbackForm.config.choices.length;

choicesFeedbackForm.passedElement.element.addEventListener(
  "choice",
  function (event) {
    // do something creative here...
    if (event.detail.choice.active) {
      console.log(innerChoises);
      innerChoises.classList.add("valid");
      innerChoises.classList.remove("invalid");
    } else {
      innerChoises.classList.add("invalid");
      innerChoises.classList.remove("valid");
    }

    if (event.detail.choice.id === choicesLength) {
      additionalField.classList.add("shown");
    }
  },
  false
);
