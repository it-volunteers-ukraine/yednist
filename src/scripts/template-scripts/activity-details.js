function initActivityForm() {
  const openActivityFormButtons = document.querySelectorAll(
    ".js-open-activity-form"
  );
  const activityBackdrop = document.getElementById("js-activity-form");

  function showModal() {
    const windowScrollY = window.scrollY;
    document.documentElement.style.scrollBehavior = "auto";
    activityBackdrop.classList.remove("is-hidden");
    document.documentElement.classList.add("modal__opened");
    activityBackdrop.addEventListener("mousedown", closeByBgdClick);
    window.addEventListener("keydown", closeByPressEscape);
    document.documentElement.style.top = `-${windowScrollY}px`;
  }

  function hideModal() {
    activityBackdrop.classList.add("is-hidden");
    activityBackdrop.removeEventListener("mousedown", closeByBgdClick);

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

  jQuery(document).ready(function ($) {
    if (openActivityFormButtons) {
      openActivityFormButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
          e.preventDefault();
          const postId = button.dataset.postId;

          function showLoader() {
            $(button).next(".button__loader").show();
          }

          function hideLoader() {
            $(button).next(".button__loader").hide();
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
                // После успешной загрузки контента вызываем showModal и добавляем обработчик для кнопки закрытия
                showModal();
                const closeActivityFormButton = document.getElementById(
                  "js-close-activity-form"
                );
                closeActivityFormButton.addEventListener("click", hideModal);
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
    }
  });
}
