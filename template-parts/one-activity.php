<div class="one-activity-js activity__flip-card" onclick="
if (window.innerWidth < 991.98) {
  const flipCardInner = this.querySelector('.activity__flip-card-inner'); 
  flipCardInner.classList.toggle('flipped'); }">

  <div class="activity__flip-card-inner">

    <div class="activity__flip-card-front">
      <div class="activity__flip-card-img">
        <?php 
        $image = get_field('activity_big_image');
        $size = 'medium_large'; // (thumbnail, medium, large, full or custom size)
        if( $image ) {
            echo wp_get_attachment_image( $image, $size );
        } ?>
      </div>
    </div>

    <div class="activity__flip-card-back">
      <div class="flip-card-back-second"></div>
      <div class="flip-card-back-first">
        <ul class="activity__description">
          <li class="activity__item">
            <div class="activity__icon">
              <svg>
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_calendar"></use>
              </svg>
            </div>
            <p class="activity__text"><?php the_field('activity_date'); ?></p>
          </li>
          <li class="activity__item">
            <a class="activity__item" href="<?php the_field("google_maps_url") ?>" target="_blank"
              rel="noopener noreferrer">
              <div class="activity__icon">
                <svg>
                  <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_map"></use>
                </svg>
              </div>
              <p class="activity__text"><?php the_field('activity_location'); ?></p>
            </a>
          </li>
          <li class="activity__item">
            <div class="activity__icon">
              <svg>
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_money"></use>
              </svg>
            </div>
            <p class="activity__text"><?php the_field('activity_price'); ?></p>
          </li>
          <li class="activity__item">
            <div class="activity__icon">
              <svg>
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_people"></use>
              </svg>
            </div>
            <p class="activity__text">
              <?php the_field('activity_target'); ?>
            </p>
          </li>
        </ul>
        <?php get_template_part( 'template-parts/activity-buttons' ); ?>
        <?php $learn_more = get_field('activity_learn_more_btn');
        $post_id = get_the_ID();
        if($learn_more) { ?>
        <div class="learn__more--wrap">
          <button class="button secondary-button activity__button js-open-activity-form"
            data-post-id="<?php echo $post_id; ?>">
            <?php echo $learn_more; ?>
          </button>
          <div class="button__loader hidden"></div>
        </div>
        <?php } ?>
      </div>
    </div>

  </div>
</div>