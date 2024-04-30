const openActivityFormButtons = document.querySelectorAll(
  ".js-open-activity-form"
);
const activityBackdrop = document.getElementById("js-activity-form");
const activityModalEl = document.querySelector(".activity-modal");

let screenHeight = window.innerHeight;
const computedStyle = getComputedStyle(activityModalEl);
let containerHeight = parseInt(computedStyle.height);

const theme_uri = uri_object.theme_directory_uri;
const hide_btn = uri_object.hide_btn;
const read_btn = uri_object.read_btn;

document.addEventListener("click", (e) => {
  const btn = e.target;
  if (btn.className === "activity__modal--detais-open") {
    const fullText = btn.nextElementSibling;
    const shortText = btn.previousElementSibling;

    if (fullText.classList.contains("hidden")) {
      btn.innerHTML = `${hide_btn}
        <span class="activity__modal--detais--icon active">
        <svg>
          <use href="${theme_uri}/assets/images/sprite.svg#icon-small_arrow"></use></svg></span>`;

      fullText.classList.remove("hidden");
      shortText.classList.add("hidden");
    } else {
      btn.innerHTML = `${read_btn}
        <span class="activity__modal--detais--icon">
        <svg>
          <use href="${theme_uri}/assets/images/sprite.svg#icon-small_arrow"></use>
        </svg>
      </span>`;

      fullText.classList.add("hidden");
      shortText.classList.remove("hidden");
    }

    let containerHeight = parseInt(getComputedStyle(activityModalEl).height);
    if (screenHeight < containerHeight) {
      activityModalEl.style.transition = "none";
      activityModalEl.classList.add("horizontal");
    } else {
      activityModalEl.classList.remove("horizontal");
      activityModalEl.style.transition = "$transition-function";
    }
  }
});

function lookForSizeChanges() {
  screenHeight = window.innerHeight;
  screenOrientation(screenHeight);
}

function screenOrientation(height) {
  if (containerHeight > height) {
    activityModalEl.classList.add("horizontal");
  } else {
    activityModalEl.classList.remove("horizontal");
  }
}

function showModal() {
  const windowScrollY = window.scrollY;
  activityBackdrop.classList.remove("is-hidden");
  document.documentElement.classList.add("modal__opened");
  screenOrientation(screenHeight);
  window.addEventListener("resize", lookForSizeChanges);
  activityBackdrop.addEventListener("mousedown", closeByBgdClickActivity);
  window.addEventListener("keydown", closeByPressEscape);
  document.documentElement.style.top = `-${windowScrollY}px`;
}

function hideModal() {
  activityBackdrop.classList.add("is-hidden");
  activityBackdrop.removeEventListener("mousedown", closeByBgdClickActivity);

  const scrollY = parseInt(document.documentElement.style.top || "0");
  document.documentElement.classList.remove("modal__opened");
  activityModalEl.classList.remove("horizontal");
  window.scrollTo(0, -scrollY);
}

function closeByBgdClickActivity(e) {
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

function updateModalHeight() {
  const newContainerHeight = activityModalEl.scrollHeight;
  if (newContainerHeight !== containerHeight) {
    containerHeight = newContainerHeight;
    screenOrientation(screenHeight);
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
              showModal();
              updateModalHeight();
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
        openActivityFormButtons.forEach((button) => {
          button.removeEventListener("click", loadActivity);
        });

        loadActivity(postId);
      });
    });
  }
});
