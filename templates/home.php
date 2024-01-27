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
          <h2 class="hero-section__subtitle"><?php echo get_field('hero_subtitle'); ?></h2>
          <h1 class="hero-section__title"><?php echo get_field('hero_title'); ?></h1>
        </div>

        <div class="hero-wrapper__img">
          <?php 
            $image = get_field('hero_photo');
            $size = 'large';
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
          } ?>
        </div>

        <div class="hero-wrapper__text">
          <p class="hero-section__text"><?php echo get_field('hero_text'); ?></p>
          <div class="hero-btn__container">
            <a class="button hero-button primary-button" href=""><?php echo get_field('support_btn', 'option'); ?></a>
            <a class="button hero-button secondary-button"
              href=""><?php echo get_field('event_calendar_btn', 'option'); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>



<?php get_footer(); ?>