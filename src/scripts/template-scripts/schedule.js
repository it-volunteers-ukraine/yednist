jQuery(document).ready(function ($) {
  // Початок показу лоадера
  function showLoader() {
    $(".loader").show();
  }

  // Кінець показу лоадера
  function hideLoader() {
    $(".loader").hide();
  }

  // Отримання nonce
  function getActivitiesNonce() {
    return activities.nonce;
  }

  // Оновлення кнопок пагінації
  function updatePaginationButtons() {
    var prevButton = $(".activities-prev");
    var nextButton = $(".activities-next");

    // Встановлення стану кнопки "Prev"
    prevButton.prop("disabled", currentPage === 1);

    // Встановлення стану кнопки "Next"
    nextButton.prop("disabled", currentPage === totalPages);
  }

  // Завантаження постів
  function loadPosts(page) {
    var data = {
      action: "load_activities",
      nonce: getActivitiesNonce(),
      width: viewportWidth,
      page: page,
    };

    $.ajax({
      url: activities.ajaxUrl,
      type: "post",
      data: data,
      beforeSend: showLoader,
      success: function (response) {
        hideLoader();
        totalPages = response.totalPages;
        totalPageEl.html(totalPages);
        $(".activities__wrapper").html(response.html);
        updatePaginationButtons();
      },
      error: function (xhr, status, error) {
        hideLoader();
        console.error("Request failed: " + error);
      },
    });
  }

  // Початок скрипту
  var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
  var currentPageEl = $(".current-page");
  var totalPageEl = $(".total-pages");
  var currentPage = 1;
  var totalPages = 1;

  // Оновлення поточної сторінки
  function updateCurrentPage() {
    currentPageEl.html(currentPage);
  }

  // Обробник кліку на кнопку "Next"
  $(".activities-next").click(function () {
    currentPage++;
    if (currentPage > totalPages) {
      currentPage = totalPages;
    }
    loadPosts(currentPage);
    updateCurrentPage();
    updatePaginationButtons();
  });

  // Обробник кліку на кнопку "Prev"
  $(".activities-prev").click(function () {
    currentPage--;
    if (currentPage < 1) {
      currentPage = 1;
    }
    loadPosts(currentPage);
    updateCurrentPage();
    updatePaginationButtons();
  });

  // Початкове завантаження постів
  loadPosts(currentPage);
  updateCurrentPage();
});
