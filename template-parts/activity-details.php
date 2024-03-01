<?php

$post = $args['post'];
// print_r($post);
?>

<div class="activity__modal--caption">
  <div class="activity__modal--box">
    <div class="activity__modal--img-wrap">
      <?php 
      $image = get_field('activity_small_image');
      $size = 'medium'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
          echo wp_get_attachment_image( $image, $size );
      } ?>
    </div>
    <h1 class="activity__modal--title-mobile"><?php echo $post->post_title; ?></h1>
  </div>
  <ul class="activity__modal--description">
    <li class="activity__modal--item">
      <div class="activity__modal--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_calendar"></use>
        </svg>
      </div>
      <p class="activity__modal--text"><?php the_field('activity_date'); ?></p>
    </li>
    <li class="activity__modal--item">
      <div class="activity__modal--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_map"></use>
        </svg>
      </div>
      <p class="activity__modal--text"><?php the_field('activity_location'); ?></p>
    </li>
    <li class="activity__modal--item">
      <div class="activity__modal--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_money"></use>
        </svg>
      </div>
      <p class="activity__modal--text"><?php the_field('activity_price'); ?></p>
    </li>
    <li class="activity__modal--item">
      <div class="activity__modal--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_people"></use>
        </svg>
      </div>
      <p class="activity__modal--text">
        <?php
              $category = get_the_terms($post->ID, 'activities-target');
              foreach ($category as $cat) {
                echo $cat->name;
              }?>
      </p>
    </li>

  </ul>
</div>

<div class="activity__modal--content">
  <h1 class="activity__modal--title"><?php echo $post->post_title; ?></h1>
  <div class="activity__modal--line"></div>
  <div class="activity__modal--detais"><?php the_field('activity_caption'); ?></div>

  <?php

      $activity_name = 'activity_telegram';
      if( get_field('select_btn') == 'Зареєструватись' ) {
      $activity_name = 'activity_registration';
    }
      if( get_field('select_btn') == 'Купити квиток' ) {
      $activity_name = 'activity_buy_ticket';
    }

      $activity = get_field($activity_name);
      $class_name = $activity_name == 'activity_telegram' ? 'secondary-button':'primary-button';
      if( $activity ): ?>
  <a class="button <?php echo $class_name; ?> activity__button" target="_blank"
    href="<?php echo esc_url( $activity['link'] ); ?>"><?php echo esc_html( $activity['btn'] ); ?></a>
  <?php endif; ?>
</div>

<button class="activity__modal--btn" type="button" id="js-close-activity-form" aria-label="Close modal">
  <svg class="icon__cross">
    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
  </svg>
</button>