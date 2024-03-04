jQuery(document).ready(function ($) {
  // Початок показу лоадера
  function showLoader() {
    $(".lastnews__section .loader").show();
  }

  // Кінець показу лоадера
  function hideLoader() {
    $(".lastnews__section .loader").hide();
  }

  hideLoader();

  function getNewsNonce() {
    return news.nonce;
  }

  function loadInitialNews(order, prev_order) {
    $.ajax({
      type: "POST",
      url: news.ajaxUrl,
      data: {
        nonce: getNewsNonce(),
        action: "load_initial_news",
        order: order,
        paged: 1,
        prev_order: prev_order,
      },
      beforeSend: showLoader,
      success: function (data) {
        hideLoader();
        button.parent().prevAll().remove();
        button.parent().before(data.html);
        paged = 2;

        if (paged > maxPages) {
          button.hide();
        } else {
          button.show();
        }

        maxPages = data.max_pages;
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  }

  var button = $("#loadmore a"),
    maxPages = button.data("max_pages");

  var order = $("#order").val();
  var prev_order = order;
  loadInitialNews(order, prev_order);

  // change order
  $("#order").change(function () {
    var order = $(this).val();
    prev_order = order;
    loadInitialNews(order, prev_order);
  });

  // load more news
  button.click(function (event) {
    event.preventDefault();
    var order = $("#order").val();
    loadMoreNews(order);
  });

  function loadMoreNews(order) {
    $.ajax({
      type: "POST",
      url: news.ajaxUrl,
      data: {
        nonce: getNewsNonce(),
        action: "load_initial_news",
        order: order,
        paged: paged,
        prev_order: prev_order,
      },
      beforeSend: showLoader,
      success: function (data) {
        hideLoader();
        button.parent().before(data.html);
        paged++;

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
