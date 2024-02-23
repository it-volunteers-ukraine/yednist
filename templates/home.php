<?php
/*
Template Name: home
*/
acf_form_head();
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
          <div class="swiper-wrapper values-section__wrapper">
            <?php while( have_rows('our_values_photos') ): the_row(); 
          $image = get_sub_field('our_values_img');
          ?>
            <div class="swiper-slide values-section__slide">
              <h3 class="page-title values-section__title"><?php echo get_sub_field('our_values_photo_title'); ?></h3>
              <div class="image-wrapper values-section__image">
                <?php echo wp_get_attachment_image( $image, 'full' ); ?>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
          <?php endif; ?>

          <?php get_template_part( 'template-parts/swiper-navigation'); ?>
        </div>

        <div class="values-section__flex">
          <?php if( have_rows('our_values_photos') ): ?>
          <ul class="values-flex__wrapper">
            <?php while( have_rows('our_values_photos') ): the_row(); 
            $image = get_sub_field('our_values_img');
          ?>
            <li class="values-flex__slide">
              <h3 class="page-title values-section__title"><?php echo get_sub_field('our_values_photo_title'); ?></h3>
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
          <div class="swiper-wrapper digits-section__wrapper">
            <?php while( have_rows('our_digits_block') ): the_row(); ?>
            <div class="swiper-slide digits-section__text">
              <p class="digits-section__number digits-js"><?php echo get_sub_field('number'); ?></p>
              <p class="digits-section__caption"><?php echo get_sub_field('caption'); ?></p>
            </div>
            <?php endwhile; ?>
          </div>
          <?php endif; ?>
          <?php get_template_part( 'template-parts/swiper-navigation'); ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section moments-section">
    <div class="container">
      <h2 class="section-title"><?php the_field('moments_title'); ?></h2>
      <div class="inner-container">

        <?php get_template_part( 'template-parts/slider'); ?>
        
      </div>
    </div>
  </section>

  <section class="section our-partners-section">
    <div class="container">
      <h2 class="section-title"><?php the_field('home_our_partners_title'); ?></h2>
      <div class="inner-container">

        <?php $images = get_field('home_our_partners_gallery'); ?>
        <div class="swiper our-partners-section__slider">
          <?php if( $images ): ?>
          <div class="swiper-wrapper our-partners-section__wrapper">
            <?php foreach( $images as $image ): ?>
            <div class="swiper-slide our-partners-section__photo">
              <div class="our-partners-section__image">
                <img class="our-partners-section__img" src="<?php echo esc_url($image['sizes']['medium_large']); ?>"
                  alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

        </div>

        <a class="button primary-button home_our_partners_btn"
          href="<?php echo esc_attr(get_field('all_partners_link', 'option') ); ?>"><?php the_field('all_partners_btn', 'option'); ?></a>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h2 class="section-title"><?php the_field('common_questions_title'); ?></h2>
      <div class="inner-container">

        <?php if( have_rows('common_questions_block') ): ?>
        <ul class="common-questions__wrapper">
          <?php while( have_rows('common_questions_block') ): the_row(); ?>
          <li class="common-questions__text ">

            <div aria-controls="panel<?php echo get_row_index(); ?>" role="button" aria-expanded="false"
              class="common-questions__box accordion">
              <p class="common-questions__question"><?php echo get_sub_field('common_question'); ?></p>

              <svg class="plus-icon" width="20px" height="20px">
                <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
              </svg>

              <svg class="minus-icon" width="20px" height="20px">
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#minus-icon"></use>
              </svg>
            </div>

            <div id="panel<?php echo get_row_index(); ?>" role="region" class="common-questions__answer panel">
              <?php echo get_sub_field('answer'); ?></div>

          </li>
          <?php endwhile; ?>
        </ul>
        <?php endif; ?>

      </div>
    </div>
  </section>

  <section class="section feedback-section">
    <div class="container">
      <h2 class="section-title"><?php the_field('feedbacks_title'); ?></h2>
      <div class="inner-container">

        <div class="feedback-section__box">

          <?php get_template_part( 'template-parts/feedback-posts' ); ?>

        </div>

      </div>

      <?php get_template_part( 'template-parts/feedback-form' ); ?>

    </div>
    </div>
  </section>

</main>



<?php get_footer(); ?>