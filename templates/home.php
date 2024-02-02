<?php
/*
Template Name: home
*/
get_header();
?>
<main class="front-page__main">

  <section class="hero-section">

    <div class="container">

      <div class="inner-container hero-inner__container">
        <div class="hero-wrapper__title">
          <h2 class="hero-section__subtitle"><?php the_field('hero_subtitle'); ?></h2>
          <h1 class="hero-section__title"><?php the_field('hero_title'); ?></h1>
        </div>

        <div class="image-wrapper hero-wrapper__img">
          <?php 
            $image = get_field('hero_photo');
            $size = 'large';
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
          } ?>
        </div>

        <div class="hero-wrapper__text">
          <p class="hero-section__text"><?php the_field('hero_text'); ?></p>
          <div class="hero-btn__container">
            <a class="button primary-button hero-button"
              href="<?php echo esc_attr(get_field('support_link', 'option') ); ?>"><?php the_field('support_btn', 'option'); ?></a>
            <a class="button secondary-button hero-button"
              href="<?php echo esc_attr(get_field('event_calendar_link', 'option') ); ?>"><?php the_field('event_calendar_btn', 'option'); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section values-section">
    <div class="container">
      <h2 class="section-title"><?php the_field('our_values_title'); ?></h2>
      <div class="inner-container">

        <div class="swiper values-section__slider">
          <?php if( have_rows('our_values_photos') ): ?>
          <ul class="swiper-wrapper values-section__wrapper">
            <?php while( have_rows('our_values_photos') ): the_row(); 
          $image = get_sub_field('our_values_img');
          ?>
            <li class="swiper-slide values-section__slide">
              <h3 class="page-title values-section__title"><?php echo get_sub_field('our_values_photo_title'); ?></h3>
              <div class="image-wrapper values-section__image">
                <?php echo wp_get_attachment_image( $image, 'full' ); ?>
              </div>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>

          <div class="swiper-pagination"></div>
        </div>

        <div class="values-section__flex">
          <?php if( have_rows('our_values_photos') ): ?>
          <ul class="values-flex__titles">
            <?php while( have_rows('our_values_photos') ): the_row(); ?>
            <h3 class="page-title values-section__title"><?php echo get_sub_field('our_values_photo_title'); ?></h3>
            <?php endwhile; ?>
          </ul>

          <ul class="values-flex__wrapper">
            <?php while( have_rows('our_values_photos') ): the_row(); 
            $image = get_sub_field('our_values_img');
          ?>
            <li class="values-flex__slide">
              <div class="image-wrapper values-section__image">
                <?php echo wp_get_attachment_image( $image, 'full' ); ?>
              </div>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>
        </div>

        <h3 class="section-title values-section__subtitle"><?php the_field('our_values_subtitle'); ?></h3>

        <?php if( have_rows('our_values_texts') ): ?>
        <ul class="values-section__texts">
          <?php while( have_rows('our_values_texts') ): the_row(); ?>
          <li class="values-section__text">
            <p><?php echo get_sub_field('our_values_text'); ?></p>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php endif; ?>

      </div>
    </div>

  </section>

  <section class="section digits-section">
    <div class="container">
      <h2 class="section-title"><?php the_field('our_digits_title'); ?></h2>
      <div class="inner-container">

        <div class="swiper digits-section__slider">
          <?php if( have_rows('our_digits_block') ): ?>
          <ul class="swiper-wrapper digits-section__wrapper">
            <?php while( have_rows('our_digits_blok') ): the_row(); ?>
            <li class="swiper-slide digits-section__text">
              <p id="digits-js" class="digits-section__number digits-js"><?php echo get_sub_field('number'); ?></p>
              <p class="digits-section__caption"><?php echo get_sub_field('caption'); ?></p>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section moments-section">
    <div class="container">
      <h2 class="section-title"><?php the_field('moments_title'); ?></h2>
      <div class="inner-container">

        <?php $images = get_field('moments_gallery'); ?>
        <div class="swiper moments-section__slider">
          <?php if( $images ): ?>
          <ul class="swiper-wrapper moments-section__wrapper">
            <?php foreach( $images as $image ): ?>
            <li class="swiper-slide moments-section__photo">
              <div class="image-wrapper moments-section__image">
                <img class="swiper-lazy" loading="lazy" src="<?php echo esc_url($image['sizes']['medium_large']); ?>"
                  alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>

          <div class="swiper-pagination swiper-custom-pagination"></div>
          <div class="swiper-custom-navigation">
            <div class="custom-button-prev">
              <svg class="">
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
              </svg>
            </div>
            <div class="custom-button-next">
              <svg class="">
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-right"></use>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>



<?php get_footer(); ?>