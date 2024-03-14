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
  function getFeedbacksNonce() {
    return myAjax.nonce;
  }

  // Оновлення кнопок пагінації
  function updatePaginationButtons() {
    var prevButton = $(".feedback-prev");
    var nextButton = $(".feedback-next");

    // Встановлення стану кнопки "Prev"
    prevButton.prop("disabled", currentPage === 1);

    // Встановлення стану кнопки "Next"
    nextButton.prop("disabled", currentPage === totalPages);
  }

  // Завантаження постів
  function loadPosts(page) {
    var data = {
      action: "load_feedbacks",
      nonce: getFeedbacksNonce(),
      width: viewportWidth,
      page: page,
    };

    $.ajax({
      url: myAjax.ajaxUrl,
      type: "post",
      data: data,
      beforeSend: showLoader,
      success: function (response) {
        hideLoader();
        totalPages = response.totalPages;
        totalPageEl.html(totalPages);
        $(".feedback-section__wrapper").html(response.html);
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
  $(".feedback-next").click(function () {
    currentPage++;
    if (currentPage > totalPages) {
      currentPage = totalPages;
    }
    loadPosts(currentPage);
    updateCurrentPage();
    updatePaginationButtons();
  });

  // Обробник кліку на кнопку "Prev"
  $(".feedback-prev").click(function () {
    currentPage--;
    if (currentPage < 1) {
      currentPage = 1;
    }
    loadPosts(currentPage);
    updateCurrentPage();
    updatePaginationButtons();
  });

  $(".feedback-section__wrapper").swipe({
    swipeLeft: function (e) {
      // Обробка свайпу вліво
      if (currentPage < totalPages) {
        currentPage++;
        loadPosts(currentPage);
        updateCurrentPage();
      }
    },
    swipeRight: function (e) {
      // Обробка свайпу вправо
      if (currentPage > 1) {
        currentPage--;
        loadPosts(currentPage);
        updateCurrentPage();
      }
    },
    threshold: 75, // Мінімальна відстань, яка вважається свайпом
  });

  // Початкове завантаження постів
  loadPosts(currentPage);
  updateCurrentPage();

  // hide & show comments
  const hide_btn = myAjax.hide_btn;
  const read_btn = myAjax.read_btn;

  document.addEventListener("click", (e) => {
    const btn = e.target;
    if (btn.className === "feedback-open__btn") {
      const fullText = btn.nextElementSibling;
      const shortText = btn.previousElementSibling;

      if (fullText.classList.contains("hidden")) {
        btn.innerHTML = `${hide_btn}`;
        fullText.classList.remove("hidden");
        shortText.classList.add("hidden");
      } else {
        btn.innerHTML = `${read_btn}`;
        fullText.classList.add("hidden");
        shortText.classList.remove("hidden");
      }
    }
  });
});
