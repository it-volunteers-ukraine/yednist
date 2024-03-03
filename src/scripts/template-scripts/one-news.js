jQuery(document).ready(function ($) {
  // Початок показу лоадера
  function showLoader() {
    $(".lastnews__section .loader").show();
  }

  // Кінець показу лоадера
  function hideLoader() {
    $(".lastnews__section .loader").hide();
  }

  function getNewsNonce() {
    return news.nonce;
  }

  var button = $("#loadmore a"),
    paged = button.data("paged"),
    maxPages = button.data("max_pages");

  button.click(function (event) {
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: news.ajaxUrl,
      data: {
        nonce: getNewsNonce(),
        paged: paged,
        action: "load_latest_news",
      },
      beforeSend: showLoader,
      success: function (data) {
        hideLoader();
        paged++;
        button.parent().before(data.html);

        if (paged == maxPages) {
          button.remove();
        }
      },
    });
  });
});
