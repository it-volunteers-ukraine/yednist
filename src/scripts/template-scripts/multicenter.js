jQuery(document).ready(function ($) {
  function showLoader() {
    $(".loader").show();
    $(".classes__container.mobile").addClass("loading-overlay");
    $(".classes__container").addClass("loading-overlay");
  }

  function hideLoader() {
    $(".loader").hide();
    $(".classes__container.mobile").removeClass("loading-overlay");
    $(".classes__container").removeClass("loading-overlay");
  }

  hideLoader();

  function getClassesNonce() {
    return multicenter_ajax.nonce;
  }

  var active_cat = "for_all";
  var prev_active_cat = active_cat;
  var button = $("#loadmore a");
  var paged = 1;
  var maxPages = button.data("max_pages");

  var tabs = $(".tab");
  tabs.on("click", onTabClick);

  function onTabClick(e) {
    var activeBtn = $(e.target);
    tabs.removeClass("tab-active");
    activeBtn.addClass("tab-active");
    if (activeBtn.data("active") !== prev_active_cat) {
      active_cat = activeBtn.data("active");
      loadClasses(active_cat, prev_active_cat);
      prev_active_cat = active_cat;
    }
  }

  function loadClasses(active_cat, prev_active_cat) {
    $.ajax({
      type: "POST",
      url: multicenter_ajax.ajaxUrl,
      data: {
        nonce: getClassesNonce(),
        action: "load_classes",
        paged: 1,
        active_cat: active_cat,
        prev_active_cat: prev_active_cat,
      },
      beforeSend: showLoader,
      success: function (data) {
        hideLoader();
        button.parent().prevAll().remove();
        button.parent().before(data.html);
        paged = 2;

        maxPages = data.max_pages;

        if (paged > maxPages) {
          button.hide();
        } else {
          button.show();
        }

        const panel = $(".tab-accordion.active").next();
        panel.css("maxHeight", panel.prop("scrollHeight") + "px");
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  loadClasses(active_cat, prev_active_cat);

  // load more news
  button.click(function (event) {
    event.preventDefault();
    loadMoreClasses(active_cat);
  });

  function loadMoreClasses(active_cat) {
    $.ajax({
      type: "POST",
      url: multicenter_ajax.ajaxUrl,
      data: {
        nonce: getClassesNonce(),
        action: "load_classes",
        paged: paged,
        active_cat: active_cat,
        prev_active_cat: prev_active_cat,
      },
      beforeSend: showLoader,
      success: function (data) {
        hideLoader();
        button.parent().before(data.html);
        paged++;

        maxPages = data.max_pages;

        if (paged > maxPages) {
          button.hide();
        }

        const panel = $(".tab-accordion.active").next();
        panel.css("maxHeight", panel.prop("scrollHeight") + "px");
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  // hide & show comments
  const theme_uri = multicenter_ajax.theme_directory_uri;
  const hide_btn = multicenter_ajax.hide_btn;
  const read_btn = multicenter_ajax.read_btn;

  document.addEventListener("click", (e) => {
    const btn = e.target;
    if (btn.className === "classes__detais-open") {
      const fullText = btn.nextElementSibling;
      const shortText = btn.previousElementSibling;
      const textBox = btn.parentNode;
      const panelEl = textBox.parentNode.parentNode;
      const buttonBox = textBox.children[textBox.children.length - 1];

      if (fullText.classList.contains("hidden")) {
        btn.innerHTML = `${hide_btn}
        <span class="activity__modal--detais--icon active">
         <svg>
          <use href="${theme_uri}/assets/images/sprite.svg#icon-small_arrow">
          </use></svg></span>`;
        fullText.classList.remove("hidden");
        buttonBox.classList.remove("hidden");
        shortText.classList.add("hidden");
        panelEl.style.maxHeight = panelEl.scrollHeight + "px";
      } else {
        btn.innerHTML = `${read_btn}
        <span class="activity__modal--detais--icon">
        <svg>
          <use href="${theme_uri}/assets/images/sprite.svg#icon-small_arrow"></use>
        </svg>
      </span>`;
        fullText.classList.add("hidden");
        buttonBox.classList.add("hidden");
        shortText.classList.remove("hidden");
        panelEl.style.maxHeight = panelEl.scrollHeight + "px";
      }
    }
  });

  // accordion
  const acc = document.getElementsByClassName("tab-accordion");

  for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      const activeAccordion = document.querySelector(".tab-accordion.active");
      if (activeAccordion && activeAccordion !== this) {
        activeAccordion.classList.remove("active");
        activeAccordion.setAttribute("aria-expanded", "false");
        const activePanel = activeAccordion.nextElementSibling;
        activePanel.style.maxHeight = null;
      }

      this.classList.toggle("active");
      this.parentNode.scrollIntoView({ behavior: "smooth", block: "nearest" });

      if (this.classList.contains("active")) {
        this.setAttribute("aria-expanded", "true");
      } else this.setAttribute("aria-expanded", "false");

      const panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }

  //form
  const wpcf7Elm = document.querySelector(".wpcf7");
  const notificationBackdropEl = document.getElementById(
    "invite__backdrop--notification"
  );
  const closeNotificationBtn = document.getElementById(
    "invite__notification--btn"
  );
  const submitNotificationEl = document.getElementById("submit-notification");

  wpcf7Elm.addEventListener("wpcf7mailsent", getNotification, false);

  let timerId;

  function getNotification() {
    const windowScrollY = window.scrollY;
    document.documentElement.style.scrollBehavior = "auto";
    notificationBackdropEl.classList.remove("is-hidden");
    document.documentElement.classList.add("modal__opened");
    document.documentElement.style.top = `-${windowScrollY}px`;
    timerId = setTimeout(() => {
      closeNotification();
    }, 5000);
    closeNotificationBtn.addEventListener("click", closeNotification);
    notificationBackdropEl.addEventListener("mousedown", closeNotification);
  }

  function closeNotification() {
    notificationBackdropEl.classList.add("is-hidden");
    notificationBackdropEl.removeEventListener("mousedown", closeNotification);
    closeNotificationBtn.removeEventListener("click", closeNotification);
    const scrollY = parseInt(document.documentElement.style.top || "0");
    document.documentElement.classList.remove("modal__opened");
    window.scrollTo(0, -scrollY);
    document.documentElement.style.scrollBehavior = "smooth";
    clearTimeout(timerId);
  }

  wpcf7Elm.addEventListener("wpcf7invalid", getSubmitNotification, false);

  function getSubmitNotification() {
    submitNotificationEl.classList.add("active");
    setTimeout(() => {
      submitNotificationEl.classList.remove("active");
    }, 5000);
  }
});
