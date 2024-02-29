jQuery(document).ready(function ($) {
  const openActivityFormButtons = document.querySelectorAll(
    ".js-open-activity-form"
  );

  openActivityFormButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const postId = button.dataset.postId;

      function showLoader() {
        $(".activity-modal .loader").show();
      }

      function hideLoader() {
        $(".activity-modal .loader").hide();
      }

      function getActivityNonce() {
        return activity.nonce;
      }

      function loadActivity(postId) {
        var data = {
          action: "get_post_activity",
          nonce: getActivityNonce(),
          postId: postId,
        };

        $.ajax({
          url: activity.ajaxUrl,
          type: "post",
          data: data,
          beforeSend: showLoader,

          success: function (res) {
            hideLoader();
            $(".activity-modal").html(res.html);
          },
          error: function (xhr, status, error) {
            hideLoader();
            console.error("Request failed: " + error);
          },
        });
      }
      loadActivity(postId);
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const openActivityFormButtons = document.querySelectorAll(
    ".js-open-activity-form"
  );
  // const closeActivityFormButton = document.getElementById(
  //   "js-close-activity-form"
  // );
  const activityBackdrop = document.getElementById("js-activity-form");
  // const activityModalEl = document.querySelector(".activity-modal");

  //open-close modal
  if (openActivityFormButtons) {
    openActivityFormButtons.forEach((button) => {
      button.addEventListener("click", showModal);
    });

    // let screenHeight = window.innerHeight;
    // // const computedStyle = getComputedStyle(activityModalEl);
    // // const containerHeight = parseInt(computedStyle.height);

    // function lookForSizeChanges() {
    //   screenHeight = window.innerHeight;
    //   screenOrientation(screenHeight);
    // }

    // function screenOrientation(height) {
    //   // if (containerHeight > height) {
    //   //   activityModalEl.classList.add("horizontal");
    //   // } else {
    //   //   activityModalEl.classList.remove("horizontal");
    //   // }
    // }

    function showModal() {
      const windowScrollY = window.scrollY;
      document.documentElement.style.scrollBehavior = "auto";
      activityBackdrop.classList.remove("is-hidden");
      // screenOrientation(screenHeight);
      // closeActivityFormButton.addEventListener("click", hideForm);
      activityBackdrop.addEventListener("mousedown", closeByBgdClick);
      window.addEventListener("keydown", closeByPressEscape);
      // window.addEventListener("resize", lookForSizeChanges);

      document.documentElement.classList.add("modal__opened");
      document.documentElement.style.top = `-${windowScrollY}px`;
    }

    function hideModal() {
      activityBackdrop.classList.add("is-hidden");
      // closeActivityFormButton.removeEventListener("click", hideModal);
      activityBackdrop.removeEventListener("mousedown", closeByBgdClick);
      // activityModalEl.classList.remove("horizontal");

      const scrollY = parseInt(document.documentElement.style.top || "0");
      document.documentElement.classList.remove("modal__opened");
      window.scrollTo(0, -scrollY);
      document.documentElement.style.scrollBehavior = "smooth";
    }

    function closeByBgdClick(e) {
      if (e.target === activityBackdrop) {
        hideModal();
      }
    }

    function closeByPressEscape(e) {
      if (e.key === "Escape") {
        e.preventDefault();
        hideModal();
        window.removeEventListener("keydown", closeByPressEscape);
      }
    }
  }
});
