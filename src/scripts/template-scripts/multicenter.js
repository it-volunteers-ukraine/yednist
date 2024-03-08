jQuery(document).ready(function ($) {
  // Початок показу лоадера
  function showLoader() {
    $(".loader").show();
  }

  // Кінець показу лоадера
  function hideLoader() {
    $(".loader").hide();
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
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }
});
