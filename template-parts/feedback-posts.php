<div class="grid feedback-section__wrapper"></div>
<div class="loader"></div>

<?php get_template_part( 'template-parts/feedback-nav' ); ?>

<!-- AJAX -->
<script>
jQuery(document).ready(function($) {

  $('.loader').show();
  var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
  var currentPageEl = $(".current-page");
  var totalPageEl = $(".total-pages");
  var currentPage = 1;
  var totalPages = 1;

  function loadPosts(page) {
    var data = {
      action: 'load_feedbacks',
      width: viewportWidth,
      page: page
    };

    $.ajax({
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      type: 'post',
      data: data,
      beforeSend: function() {
        // Показываем лоадер перед отправкой запроса
        $('.loader').show();
      },
      success: function(response) {
        $('.loader').hide();
        totalPages = response.totalPages;
        totalPageEl.html(totalPages);
        $('.feedback-section__wrapper').html(response.html);
        // Проверяем, должны ли кнопки "Next" и "Prev" быть активными или неактивными
        updatePaginationButtons();
      },
      error: function(xhr, status, error) {
        $('.loader').hide();
        console.error("Request failed: " + error);
      }
    });
  }

  function updatePaginationButtons() {
    // Если текущая страница равна 1, делаем кнопку "Prev" неактивной
    if (currentPage === 1) {
      $('.feedback-prev').prop('disabled', true);
    } else {
      $('.feedback-prev').prop('disabled', false);
    }

    // Если текущая страница равна общему количеству страниц, делаем кнопку "Next" неактивной
    if (currentPage === totalPages) {
      $('.feedback-next').prop('disabled', true);
    } else {
      $('.feedback-next').prop('disabled', false);
    }
  }

  currentPageEl.html(currentPage);

  loadPosts(currentPage);

  $('.feedback-next').click(function() {
    currentPage++;
    if (currentPage > totalPages) {
      currentPage = totalPages;
    }
    loadPosts(currentPage);
    currentPageEl.html(currentPage);
    // Проверяем, должны ли кнопки "Next" и "Prev" быть активными или неактивными после перехода на новую страницу
    updatePaginationButtons();
  });

  $('.feedback-prev').click(function() {
    currentPage--;
    if (currentPage < 1) {
      currentPage = 1;
    }
    loadPosts(currentPage);
    currentPageEl.html(currentPage);
    // Проверяем, должны ли кнопки "Next" и "Prev" быть активными или неактивными после перехода на новую страницу
    updatePaginationButtons();
  });
});
</script>