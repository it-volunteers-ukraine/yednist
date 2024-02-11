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

      <div class="feedback-modal__auth">

        <div class="feedback-modal__box">
          <div class="feedback-modal__wrapper">
            <label for="contactName">Ваше ім’я*</label>
            <input id="contactName" class="feedback-modal__input" type="text" name="name"
              placeholder="Введіть Ваше ім’я">
          </div>

          <div class="feedback-modal__wrapper">
            <label for="contactEmail">Електронна пошта*</label>
            <input id='contactEmail' class="feedback-modal__input" type="email" name="mail"
              placeholder="johndoe@gmail.com" />
          </div>
        </div>

        <div class="feedback-modal__opt">
          <label for="feedbackPrograms">В яких програмах громадської організації “Єдність” ви приймали участь?*</label>
          <select id='feedbackPrograms' class='feedback-modal__input' placeholder="Виберіть програму..."></select>
        </div>

        <div class="feedback-modal__case">
          <label for="yourCase">Ваш варіант взаємодії з нами*</label>
          <input id='yourCase' class="feedback-modal__input" type="text" name="yourCase"
            placeholder="Як ми з Вами співпрацювали" />
        </div>

        <div>
          <label for="contactFeedback" class="feedback-form__text">Ваш відгук*</label>
          <textarea class="feedback-modal__input" id='contactFeedback' name="comments" cols="30" rows="10"
            placeholder="Напишіть Ваше повідомлення..."></textarea>
        </div>
      </div>

      <div class="feedback-modal__privacy">
        <div class="feedback-check__box">
          <input id="contactAgreement" class="feedback-check" type="checkbox" name="privacy">
        </div>
        <label for="contactAgreement" class="feedback-privacy__label">Я погоджуюся надати дані у формі для того, щоб
          зв'язатися з громадською організацією "Єдність". Дані, що
          містяться у змісті кореспонденції, обробляються відповідно до принципів, описаних у <a
            class="feedback-privacy__link" href="https://pdp.nacs.gov.ua/pages/zahyst-pers-dannih"
            target="_blank">Політиці конфіденційності.</a>*
        </label>
      </div>
      <div class="feedback-btn__wrap">
        <!-- <div class="feedback-submit-notification" id="submit-notification">Будь-ласка, заповніть усі обов'язкові поля.
        </div> -->
        <button class="button primary-button feedback-button" type="submit">Відправити</button>
      </div>
    </form>

  </div>
</div>