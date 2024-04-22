<article class="classes__article">
  <div class="classes__caption">
    <div class="classes__box">
      <div class="classes__img-wrap">
        <?php 
      $image = get_field('activity_small_image');
      $size = 'medium'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
          echo wp_get_attachment_image( $image, $size );
      } ?>
      </div>

    </div>


    <div class="classes__content">
      <h1 class="classes__title"><?php echo $post->post_title; ?></h1>

      <?php $fullContent = get_field('activity_caption');
      $content = wp_trim_words($fullContent, 13, "...");
      $contentExcerpt = wp_trim_words($fullContent, 12, "..."); ?>


      <div class="classes__detais"><?php echo $fullContent?></div>



      <ul class="classes__description">
        <li class="classes__title-mobile">
          <h2><?php echo $post->post_title; ?></h2>
        </li>
        <li class="classes__item">

          <a class="classes__item item__link" href="<?php the_field ("event_calendar_link", "options") ?>">
            <div class="classes__icon">
              <svg>
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_calendar"></use>
              </svg>
            </div>
            <p class="classes__text"><?php the_field('activity_date'); ?></p>

          </a>
        </li>

        <li class="classes__item">
          <a class="classes__item item__link" href="<?php the_field("google_maps_url") ?>" target="_blank"
            rel="noopener noreferrer">
            <div class="classes__icon">
              <svg>
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_map"></use>
              </svg>
            </div>
            <p class="classes__text"><?php the_field('activity_location'); ?></p>
          </a>
        </li>

        <li class="classes__item">
          <div class="classes__icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_people"></use>
            </svg>
          </div>
          <p class="classes__text">
            <?php the_field('activity_target'); ?>
          </p>
        </li>

        <li class="classes__item">
          <div class="classes__icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_money"></use>
            </svg>
          </div>
          <p class="classes__text"><?php the_field('activity_price'); ?></p>
        </li>

      </ul>
    </div>

  </div>

  <div class="classes__detais-box">
    <?php if (strlen($content) > strlen($contentExcerpt)) { ?>
    <div class="classes__detais-short"><?php echo $contentExcerpt?></div>

    <button id="" class='classes__detais-open' type='button'><?php the_field('read_btn', 'option'); ?>
      <span class="classes__detais--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-small_arrow"></use>
        </svg>
      </span>
    </button>

    <div class="classes__detais-full hidden">
      <?php if($fullContent) echo $fullContent; ?>
    </div>

    <?php } else { ?>

    <div class="classes__detais-full">
      <?php if($fullContent) echo $fullContent; ?>
    </div>

    <? } ?>

    <div class="classes_btns--mobile hidden">
      <?php get_template_part( 'template-parts/activity-buttons' ); ?>
      <a href="<?php the_field("ask_btn_link", "options") ?>" class="button secondary-button classes__button">
        <?php the_field("ask_btn", "options") ?>
      </a>
    </div>

  </div>

  <div class="classes_btns">
    <?php get_template_part( 'template-parts/activity-buttons' ); ?>
    <a href="<?php the_field("ask_btn_link", "options") ?>" class="button secondary-button classes__button">
      <?php the_field("ask_btn", "options") ?>
    </a>
  </div>

</article>