<div class="feedback-pagination__block">
  <button class="button secondary-button feedback-pagination__button" type="submit"
    id="js-open-feedback-form"><?php echo esc_attr(get_field('write_down_feedback', 'option') ); ?></button>
  <div class="numbers-pagination">
    <span class="current-page"></span>
    /
    <span class="total-pages"></span>
  </div>
  <div class="feedback-navigation__box">
    <button class="custom-button-prev feedback-prev" type="button">
      <svg class="">
        <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
      </svg>
    </button>
    <button class="custom-button-next feedback-next" type="button">
      <svg class="">
        <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-right"></use>
      </svg>
    </button>
  </div>
</div>