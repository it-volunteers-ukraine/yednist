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

  function isPagination() {
    var paginationBox = $(".activities-pagination__block");

    if (totalPages === 1) {
      paginationBox.addClass("hidden");
    }
  }

  // Оновлення кнопок пагінації
  function updatePaginationButtons() {
    if (totalPages === 1) {
      return;
    }
    var prevButton = $(".activities-prev");
    var nextButton = $(".activities-next");

    // Встановлення стану кнопки "Prev"
    prevButton.prop("disabled", currentPage === 1);

    // Встановлення стану кнопки "Next"
    nextButton.prop("disabled", currentPage === totalPages);
  }

  // Підсвічення активного bullet
  function currentBullet() {
    var bulletArray = $(".bullets").children().toArray();
    var activeIndex = currentPage - 1;
    var activeBullet = bulletArray[activeIndex];
    $(activeBullet).addClass("active");
  }

  function countBullets() {
    var bulletsBox = $(".bullets");
    bulletsBox.empty();
    if (totalPages > 1) {
      for (let i = 1; i <= totalPages; i++) {
        bulletsBox.append('<div class="one-bullet"></div>');
      }
      currentBullet();
    }
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
        isPagination();
        updatePaginationButtons();
        countBullets();
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

  // Обробник кліку на bullet
  $(".bullets").on("click", ".one-bullet", function () {
    $(".active").removeClass("active");
    var index = $(this).index();
    currentPage = index + 1;
    loadPosts(currentPage);
    updateCurrentPage();
    updatePaginationButtons();
    currentBullet();
  });

  $(".activities__wrapper").swipe({
    swipeLeft: function (e) {
      // Обробка свайпу вліво
      if (currentPage < totalPages) {
        currentPage++;
        loadPosts(currentPage);
        updateCurrentPage();
        updatePaginationButtons();
      }
    },
    swipeRight: function (e) {
      // Обробка свайпу вправо
      if (currentPage > 1) {
        currentPage--;
        loadPosts(currentPage);
        updateCurrentPage();
        updatePaginationButtons();
      }
    },
    threshold: 75, // Мінімальна відстань, яка вважається свайпом
  });

  // Початкове завантаження постів
  loadPosts(currentPage);
  updateCurrentPage();
});
