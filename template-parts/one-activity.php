<div class="flip-card">
  <div class="activity-box flip-card-inner">
    <div class="activity__wrap--img flip-card-front">
      <?php 
      $image = get_field('activity_big_image');
      $size = 'medium_large'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
          echo wp_get_attachment_image( $image, $size );
      } ?>
    </div>
    <div class="flip-card-back">
      <ul class="activity__description">
        <li class="activity__item">
          <div class="activity__icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_calendar"></use>
            </svg>
          </div>
          <div class="activity__text"><?php the_field('activity_date'); ?></div>
        </li>
        <li class="activity__item">
          <div class="activity__icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_map"></use>
            </svg>
          </div>
          <div class="activity__text"><?php the_field('activity_location'); ?></div>
        </li>
        <li class="activity__item">
          <div class="activity__icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_money"></use>
            </svg>
          </div>
          <div class="activity__text"><?php the_field('activity_price'); ?></div>
        </li>
        <li class="activity__item">
          <div class="activity__icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_people"></use>
            </svg>
          </div>
          <div class="activity__text"><?php ?></div>
        </li>

      </ul>

      <?php

      $activity_name = 'activity_registration';
      if( get_field('select_btn') == 'Перейти в Telegram' ) {
      $activity_name = 'activity_telegram';
    }
      if( get_field('select_btn') == 'Купити квиток' ) {
      $activity_name = 'activity_buy_ticket';
    }

      $activity = get_field($activity_name);
      if( $activity ): ?>
      <a class="button primary-button activity__button"
        href="<?php echo esc_url( $activity['link'] ); ?>"><?php echo esc_html( $activity['btn'] ); ?></a>
      <?php endif; ?>

      <?php $learn_more = get_field('activity_learn_more_btn');
      if($learn_more) { ?>
      <a class="button secondary-button activity__button"
        href="<?php the_permalink(); ?>"><?php  echo $learn_more; ?></a>
      <?php } ?>
    </div>
  </div>
</div>