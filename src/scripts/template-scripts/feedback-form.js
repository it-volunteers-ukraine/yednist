document.addEventListener("DOMContentLoaded", function () {
  const openFeedbackFormButton = document.getElementById(
    "js-open-feedback-form"
  );
  const closeFeedbackFormButton = document.getElementById(
    "js-close-feedback-form"
  );
  const feedbackBackdrop = document.getElementById("js-feedback-form");
  const feedbackModalEl = document.querySelector(".feedback-modal");

  //open-close modal
  if (openFeedbackFormButton) {
    openFeedbackFormButton.addEventListener("click", showForm);

    let screenHeight = window.innerHeight;
    const computedStyle = getComputedStyle(feedbackModalEl);
    const containerHeight = parseInt(computedStyle.height);

    function lookForSizeChanges() {
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
      document.documentElement.style.scrollBehavior = "auto";
      feedbackBackdrop.classList.remove("is-hidden");
      screenOrientation(screenHeight);
      closeFeedbackFormButton.addEventListener("click", hideForm);
      feedbackBackdrop.addEventListener("mousedown", closeByBgdClick);
      window.addEventListener("keydown", closeByPressEscape);
      window.addEventListener("resize", lookForSizeChanges);

      document.documentElement.classList.add("modal__opened");
      document.documentElement.style.top = `-${windowScrollY}px`;
    }

    function hideForm() {
      feedbackBackdrop.classList.add("is-hidden");
      closeFeedbackFormButton.removeEventListener("click", hideForm);
      feedbackBackdrop.removeEventListener("mousedown", closeByBgdClick);
      feedbackModalEl.classList.remove("horizontal");

      const scrollY = parseInt(document.documentElement.style.top || "0");
      document.documentElement.classList.remove("modal__opened");
      window.scrollTo(0, -scrollY);
      document.documentElement.style.scrollBehavior = "smooth";
    }

    function closeByBgdClick(e) {
      if (e.target === feedbackBackdrop) {
        hideForm();
      }
    }

    function closeByPressEscape(e) {
      if (e.key === "Escape") {
        e.preventDefault();
        hideForm();
        window.removeEventListener("keydown", closeByPressEscape);
      }
    }
  }

  // select
  const feedbackSelect = document.querySelector(".feedback-select-js");
  const additionalField = document.getElementById("case-js");

  if (feedbackSelect) {
    const choicesFeedbackForm = new Choices(feedbackSelect, {
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
        if (event.detail.choice.active) {
          innerChoises.classList.add("valid");
          innerChoises.classList.remove("invalid");
        } else {
          innerChoises.classList.remove("valid");
          innerChoises.classList.add("invalid");
        }

        if (event.detail.choice.id === choicesLength) {
          additionalField.classList.add("shown");
        } else additionalField.classList.remove("shown");
      },
      false
    );
  }

  // form sent
  if (openFeedbackFormButton) {
    jQuery(document).ready(function ($) {
      //fields validation
      const inputNameEl = $(".input-name")[0];
      const inputEmailEl = $(".input-email")[0];
      const inputCaseEl = $(".input-case")[0];
      const inputReviewEl = $(".input-review")[0];

      function validateInput(e) {
        const inputEl = e.target;
        const value = inputEl.value.trim();
        let pattern, check;

        switch (inputEl.getAttribute("name")) {
          case "title":
            pattern = /^[^\d]+$/;
            check = pattern.test(value);
            break;
          case "email":
            pattern =
              /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            check = pattern.test(value);
            break;
          case "case":
            check = value.length >= 1;
            break;
          case "description":
            check = value.length >= 1;
            break;
          default:
            break;
        }

        if (!check) {
          inputEl.classList.add("invalid");
          inputEl.classList.remove("valid");
        } else {
          inputEl.classList.add("valid");
          inputEl.classList.remove("invalid");
        }

        if (inputEl === inputReviewEl) {
          const textareaBox = $(".textarea-box");
          if (!check || inputEl.classList.contains("invalid")) {
            textareaBox.addClass("invalid").removeClass("valid");
          } else {
            textareaBox.addClass("valid").removeClass("invalid");
          }
        }
      }

      inputNameEl.addEventListener("keyup", validateInput);
      inputEmailEl.addEventListener("keyup", validateInput);
      inputCaseEl.addEventListener("keyup", validateInput);
      inputReviewEl.addEventListener("keyup", validateInput);

      //form submit
      $("#new_post").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var notificationBox = $(".feedback-notification-js");
        var notificationBtn = $(".close-notification-btn");
        var timerId;
        var escHandler = function (e) {
          if (e.key === "Escape") {
            e.preventDefault();
            closeNotification();
          }
        };
        var closeBgdClick = function (e) {
          if ($(e.target).is(notificationBox)) {
            closeNotification();
          }
        };

        function getNotification() {
          setTimeout(function () {
            $(".feedback-backdrop").addClass("is-hidden");
            notificationBox.removeClass("is-hidden");
            $(window).on("keydown", escHandler);
            notificationBox.on("mousedown", closeBgdClick);
            timerId = setTimeout(closeNotification, 5000);
            notificationBtn.on("click", closeNotification);
          });
        }

        function closeNotification() {
          const scrollY = $("html").css("top");
          clearTimeout(timerId);
          notificationBox.addClass("is-hidden");
          notificationBox.off("mousedown", closeBgdClick);
          $("html").removeClass("modal__opened");
          window.scrollTo(0, parseInt(scrollY || "0") * -1);
          $(window).off("keydown", escHandler);
          $("html").css("scrollBehavior", "smooth");
        }

        //form validation
        const inputs = [inputNameEl, inputEmailEl, inputReviewEl];
        if ($(".feedback-case")[0].classList.contains("shown")) {
          inputs.push(inputCaseEl);
        }

        let isFormValid = true;
        inputs.forEach((inputEl) => {
          validateInput({ target: inputEl });
          if (!inputEl.value.trim() || inputEl.classList.contains("invalid")) {
            inputEl.classList.add("invalid");
            $(".feedback-alert").removeClass("hidden");
            isFormValid = false;
          }
        });

        const innerChoises = $(".feedback-modal .choices__inner")[0];
        const placeholderValue = $(
          ".feedback-modal .choices__inner .choices__item"
        )[0];
        if (placeholderValue.classList.contains("choices__placeholder")) {
          innerChoises.classList.add("invalid");
          $(".feedback-alert").removeClass("hidden");
          isFormValid = false;
        }

        if (isFormValid) {
          $.ajax({
            type: form.attr("method"),
            url: form.attr("action"),
            data: form.serialize(),
            success: function (response) {
              if (response.success) {
                form.trigger("reset");
                $(".feedback-alert").addClass("hidden");
                $(".feedback-backdrop").addClass("is-hidden");
                getNotification();
              } else {
                $(".feedback-alert").removeClass("hidden");
                console.log("Error: " + response.data);
              }
            },
            error: function (xhr, status, error) {
              console.log("Error: " + error);
            },
          });
        }
      });
    });
  }
});
