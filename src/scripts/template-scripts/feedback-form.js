document.addEventListener("DOMContentLoaded", function () {
  const openFeedbackFormButton = document.getElementById(
    "js-open-feedback-form"
  );
  const closeFeedbackFormButton = document.getElementById(
    "js-close-feedback-form"
  );
  const feedbackBackdrop = document.getElementById("js-feedback-form");
  const feedbackModalEl = document.querySelector(".feedback-modal");

  if (openFeedbackFormButton) {
    openFeedbackFormButton.addEventListener("click", showForm);

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

    function showForm() {
      const windowScrollY = window.scrollY;
      feedbackBackdrop.classList.remove("is-hidden");
      screenOrientation(screenHeight);

      closeFeedbackFormButton.addEventListener("click", hideForm);
      feedbackBackdrop.addEventListener("click", closeByBgdClick);
      window.addEventListener("keydown", closeByPressEscape);
      window.addEventListener("resize", lookForSizeChanges);

      document.documentElement.classList.add("modal__opened");
      document.documentElement.style.top = `-${windowScrollY}px`;
    }

    function hideForm() {
      feedbackBackdrop.classList.add("is-hidden");
      closeFeedbackFormButton.removeEventListener("click", hideForm);
      feedbackBackdrop.removeEventListener("click", closeByBgdClick);
      feedbackModalEl.classList.remove("horizontal");

      const scrollY = document.documentElement.style.top;
      document.documentElement.classList.remove("modal__opened");
      document.documentElement.style.top = "";
      window.scrollTo(0, parseInt(scrollY || "0") * -1);
    }

    function closeByBgdClick(e) {
      if (e.target === feedbackBackdrop) {
        hideForm();
      }
    }

    function closeByPressEscape(e) {
      e.preventDefault;
      if (e.code === "Escape") {
        hideForm();
        window.removeEventListener("keydown", closeByPressEscape);
      }
    }
  }

  // select
  const feedbackForm = document.querySelector(".feedback-select-js");
  const additionalField = document.getElementById("case-js");

  if (feedbackForm) {
    const choicesFeedbackForm = new Choices(feedbackForm, {
      placeholderValue: "Виберіть програму...",
      searchEnabled: false,
      allowHTML: false,
      shouldSort: false,
      position: "bottom",
      itemSelectText: "",
    });

    const innerChoises = document.querySelector(
      ".feedback-modal .choices__inner"
    );
    const choicesLength = choicesFeedbackForm.config.choices.length;

    choicesFeedbackForm.passedElement.element.addEventListener(
      "choice",
      function (event) {
        // do something creative here...
        if (event.detail.choice.active) {
          innerChoises.classList.add("valid");
        } else {
          innerChoises.classList.remove("valid");
        }

        if (event.detail.choice.id === choicesLength) {
          additionalField.classList.add("shown");
        } else additionalField.classList.remove("shown");
      },
      false
    );

    //form validation
    // const inputNameEl = document.getElementById(
    //   "acf-field_65c9c24452e5e-field_65c922051068c-field_65c91dcb08837"
    // );

    // inputNameEl.addEventListener("keyup", function () {
    //   inputNameEl.value = inputNameEl.value.replace(/\d/g, "");
    // });

    // const inputEmailEl = document.getElementById(
    //   "acf-field_65c9c24452e5e-field_65c922051068c-field_65c91df7fe472"
    // );
  }
});
