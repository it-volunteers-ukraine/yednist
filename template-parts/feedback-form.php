<div class="feedback-backdrop is-hidden" id="js-feedback-form">
  <div class="feedback-modal">

    <div class="feedback-modal__title-wrap">
      <h1 class="feedback-modal__title"><?php the_field('feedback_form_title'); ?></h1>
      <button class="feedback-modal__btn" type="button" id="js-close-feedback-form">
        <svg class="icon__cross">
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
        </svg>
      </button>
    </div>

    <form class="">


      <?php 
        $form = get_field('feedback_form');
        if($form) : ?>
      <?php echo $form?>
      <?php endif; ?>



      <!-- <div class="feedback-modal__auth">

        <div class="feedback-modal__wrapper">
          <label class="">
            <span class="feedback-form__text">Ім'я</span>
            <input class="feedback-modal__input" type="text" name="name" placeholder="Іван Іванов">
          </label>
        </div>

        <div class="feedback-modal__wrapper">
          <label>
            <span class="feedback-form__text">Пошта</span>
            <input class="feedback-modal__input" type="email" name="mail" placeholder="mail@...">
          </label>
        </div>

        <label>
          <span class="feedback-form__opt">Участь</span>
          <textarea name="comments" cols="30" rows="1" placeholder="Виберіть"></textarea>
        </label>

        <label>
          <span class="feedback-form__text">Коментар</span>
          <textarea name="comments" cols="30" rows="10" placeholder="Введіть текст"></textarea>
        </label>
      </div>

      <div class="feedback-modal__privacy">
        <label class="feedback-privacy__label">
          <input class="feedback-check" type="checkbox" name="privacy">
          <span>Погоджуюся з розсилкою та приймаю <a class="privacy__link" href=""> Умови договору</a>
          </span>
        </label>
      </div>

      <button class="button primary-button" type="submit">Відправити</button> -->
    </form>

  </div>
</div>