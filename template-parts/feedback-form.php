<div class="feedback-backdrop" id="js-feedback-form">
  <div class="feedback-modal">

    <div class="feedback-modal__title-wrap">
      <h1 class="feedback-modal__title"><?php the_field('feedback_form_title'); ?></h1>
      <button class="feedback-modal__btn" type="button" id="js-close-feedback-form" aria-label="Close modal">
        <svg class="icon__cross">
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
        </svg>
      </button>
    </div>


    <div>

      <form id="new_post" name="new_post" method="post"
        action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">

        <div class="feedback-inputs__wrap">

          <div class="feedback-name-email__wrapper">
            <div class="feedback-input__wrapper"><label for="title">Name</label>
              <input type="text" id="title" value="" tabindex="1" size="20" name="title" />
            </div>

            <div class="feedback-input__wrapper"><label for="email">email</label>
              <input type="text" id="email" value="" tabindex="1" size="20" name="email" />
            </div>
          </div>


          <div class="feedback-select__wrap">
            <label for="program-select">В яких програмах громадської організації “Єдність” ви приймали участь?*</label>
            <select class="feedback-select-js" name="programs" id="program-select">
              <option value="">Виберіть програму...</option>
              <option>Моя дитина брала участь в освітніх програмах для підлітків</option>
              <option>Брав(ла) участь в курсах для дорослих</option>
              <option>Інше</option>
            </select>
          </div>

          <div class="feedback-case" id="case-js">
            <label for="case">Ваш варіант взаємодії з нами*</label>
            <input type="text" id="case" value="" tabindex="1" size="20" name="case" />
          </div>

          <div><label for="description">Ваш відгук*</label>
            <textarea id="description" tabindex="3" name="description" cols="50" rows="6"
              placeholder="Введіть текст"></textarea>
          </div>

        </div>

        <div class="feedback-modal__privacy">
          <label class="feedback-privacy__label">
            <input class="feedback-check" type="checkbox" name="privacy">
            <span>Я погоджуюся надати дані у формі для того, щоб зв'язатися з громадською організацією "Єдність". Дані,
              що містяться у змісті кореспонденції, обробляються відповідно до принципів,описаних у <a
                class="feedback-privacy__link" href="">Політиці конфеденційності.</a>*
            </span>
          </label>
        </div>

        <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" class="button primary-button" />
        </p>

        <input type="hidden" name="action" value="do_insert" />
        <input type="hidden" name="post_type" value="feedbacks" />
        <?php wp_nonce_field( 'do_insert_action', 'do_insert_nonce' ); ?>
      </form>
    </div>
  </div>
</div>

<script>
jQuery(document).ready(function($) {
  $('#new_post').submit(function(e) {
    e.preventDefault(); // Предотвращаем отправку формы по умолчанию

    var form = $(this);

    $.ajax({
      type: form.attr('method'),
      url: form.attr('action'),
      data: form.serialize(),
      success: function(response) {
        if (response.success) {
          alert(response.data); // Показываем уведомление в виде alert
          form.trigger('reset'); // Очищаем форму
        } else {
          alert('Error: ' + response.data); // Показываем ошибку в виде alert
        }
      },
      error: function(xhr, status, error) {
        alert('Error: ' + error); // Показываем ошибку в виде alert
      }
    });
  });
});
</script>