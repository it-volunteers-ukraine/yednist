<div class="grid feedback-section__wrapper"></div>
<div class="loader"></div>

<?php get_template_part( 'template-parts/feedback-nav' ); ?>

<!-- AJAX -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
jQuery(document).ready(function($) {

  // Початок показу лоадера
  function showLoader() {
    $('.loader').show();
  }

  // Кінець показу лоадера
  function hideLoader() {
    $('.loader').hide();
  }

  // Отримання nonce
  function getFeedbacksNonce() {
    return "<?php echo wp_create_nonce("feedbacks_nonce"); ?>";
  }

  // Оновлення кнопок пагінації
  function updatePaginationButtons() {
    var prevButton = $('.feedback-prev');
    var nextButton = $('.feedback-next');

    // Встановлення стану кнопки "Prev"
    prevButton.prop('disabled', currentPage === 1);

    // Встановлення стану кнопки "Next"
    nextButton.prop('disabled', currentPage === totalPages);
  }

  // Завантаження постів
  function loadPosts(page) {
    var data = {
      action: 'load_feedbacks',
      nonce: getFeedbacksNonce(),
      width: viewportWidth,
      page: page
    };

    $.ajax({
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      type: 'post',
      data: data,
      beforeSend: showLoader,
      success: function(response) {
        hideLoader();
        totalPages = response.totalPages;
        totalPageEl.html(totalPages);
        $('.feedback-section__wrapper').html(response.html);
        updatePaginationButtons();
      },
      error: function(xhr, status, error) {
        hideLoader();
        console.error("Request failed: " + error);
      }
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
  $('.feedback-next').click(function() {
    currentPage++;
    if (currentPage > totalPages) {
      currentPage = totalPages;
    }
    loadPosts(currentPage);
    updateCurrentPage();
    updatePaginationButtons();
  });

  // Обробник кліку на кнопку "Prev"
  $('.feedback-prev').click(function() {
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
</script>