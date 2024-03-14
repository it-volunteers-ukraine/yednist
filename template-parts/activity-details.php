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
    <h2 class="activity__modal--title-mobile"><?php echo $post->post_title; ?></h2>
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
    <?php
    $no_registration = get_field('no_registration');
    if ($no_registration) {
    ?>
    <li class="activity__modal--item">
      <div class="activity__modal--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_no-symbol"></use>
        </svg>
      </div>
      <p class="activity__modal--text"><?php echo $no_registration; ?></p>
    </li>
    <?php }?>
    <li class="activity__modal--item">
      <a class="activity__modal--item" href="<?php the_field("google_maps_url") ?>" target="_blank" rel="noopener noreferrer">
        <div class="activity__modal--icon">
          <svg>
            <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon_map"></use>
          </svg>
        </div>
        <p class="activity__modal--text"><?php the_field('activity_location'); ?></p>
      </a>
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
        <?php the_field('activity_target'); ?>
      </p>
    </li>

  </ul>
</div>

<div class="activity__modal--content">
  <h1 class="activity__modal--title"><?php echo $post->post_title; ?></h1>
  <div class="activity__modal--line"></div>

  <?php $fullContent = get_field('activity_caption');
  $content = wp_trim_words($fullContent, 13, "...");
  $contentExcerpt = wp_trim_words($fullContent, 12, "..."); ?>

  <div class="activity__modal--detais-box">
    <?php if (strlen($content) > strlen($contentExcerpt)) { ?>
    <div class="activity__modal--detais-short"><?php echo $contentExcerpt?></div>

    <button id="" class='activity__modal--detais-open' type='button'><?php the_field('read_btn', 'option'); ?>
      <span class="activity__modal--detais--icon">
        <svg>
          <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-small_arrow"></use>
        </svg>
      </span>
    </button>

    <div class="activity__modal--detais-full hidden">
      <?php if($fullContent) echo $fullContent; ?>
    </div>

    <?php } else { ?>

    <div class="activity__modal--detais-full">
      <?php if($fullContent) echo $fullContent; ?>
    </div>

    <? } ?>

  </div>

  <div class="activity__modal--detais"><?php echo $fullContent?></div>

  <?php get_template_part( 'template-parts/activity-buttons' ); ?>
</div>

<button class="activity__modal--btn" type="button" id="js-close-activity-form" aria-label="Close modal">
  <svg class="icon__cross">
    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
  </svg>
</button>