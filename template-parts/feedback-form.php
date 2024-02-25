<div class="feedback-backdrop is-hidden" id="js-feedback-form">

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

            <div class="feedback-input__wrapper"><label for="title"><?php the_field('feedback_your_name'); ?></label>
              <input type="text" id="title" value="" size="20" name="title" class="input-name" />
            </div>

            <div class="feedback-input__wrapper"><label for="email"><?php the_field('feedback_your_email'); ?></label>
              <input type="text" id="email" value="" size="20" name="email" class="input-email" />
            </div>

          </div>


          <div class="feedback-select__wrap">

            <label for="program-select"><?php the_field('feedback_select_program_name'); ?></label>
            <select class="feedback-select-js" name="programs" id="program-select">
              <option value=""><?php the_field('feedback_placeholder'); ?></option>

              <?php if( have_rows('feedback_select_program') ):

                while( have_rows('feedback_select_program') ) : the_row();

                    $sub_value = get_sub_field('prorgam_name'); ?>
              <option><?php echo $sub_value; ?></option>

              <?php endwhile;

              endif; ?>

            </select>

          </div>


          <div class="feedback-case" id="case-js">

            <label for="case"><?php the_field('feedback_your_case'); ?></label>
            <input type="text" id="case" value="" size="20" name="case" maxlength="350" class="input-case" />

          </div>


          <div>

            <label for="description"><?php the_field('feedback_your_review'); ?></label>
            <div class="textarea-box">
              <textarea class="input-review" id="description" name="description" cols="50" rows="6" maxlength="1000"
                placeholder="Введіть текст"></textarea>
            </div>

          </div>

        </div>

        <div class="feedback-modal__privacy">

          <label class="feedback-privacy__label">
            <input class="feedback-check" type="checkbox" name="privacy" required>
            <span><?php the_field('feedback_policy_text'); ?><a class="feedback-privacy__link"
                href="<?php the_field("policy", "options"); ?>"><?php the_field('feedback_policy_name'); ?></a>*
            </span>
          </label>

        </div>


        <div class="feedback__btn--wrap">
          <div class="feedback-alert hidden"><?php the_field('feedback_alert'); ?></div>
          <input type="submit" value="<?php the_field('send_btn', 'options'); ?>" id="submit" name="submit"
            class="button primary-button" />
        </div>

        <input type="hidden" name="action" value="do_insert" />
        <input type="hidden" name="post_type" value="feedbacks" />
        <?php wp_nonce_field( 'do_insert_action', 'do_insert_nonce' ); ?>

      </form>

    </div>
  </div>

</div>

<div class="feedback-backdrop__notification is-hidden feedback-notification-js">
  <div class="feedback-notification">
    <button class="feedback-modal__btn close-notification-btn" type="button" aria-label="Close notification">
      <svg class="icon__cross">
        <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
      </svg>
    </button>
    <div class="feedback-notification__title"><?php the_field("feedback_thanks"); ?></div>
    <div class="feedback-notification__text"><?php the_field("feedback_text"); ?></div>
  </div>
</div>