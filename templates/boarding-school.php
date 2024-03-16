<?php
/*
* Template Name: boarding-school
* Template Post Type: post, page, projects
*/
get_header();
?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
<section class="section">
  <div class="container">
    <div class="inner-container">
    <h2 class="page-title school__section__title"><?php the_title(); ?></h2>
    <div class="school__section__content">
    <?php $main_photo = get_field("main_photo"); $quotation_text = get_field("quotation_text"); $video_link = get_field('video_link'); ?>
      <div class="school__section__content__image">
      <?php if ($main_photo): ?>
        <img src="<?php echo esc_url($main_photo['url']); ?>" alt="<?php echo esc_attr($main_photo['alt']); ?>" style="display: block; margin: 0 auto;">
        <svg class="school__section__content__image__icon">
          <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#icon-youtube"></use>
        </svg>
      <?php endif; ?>
      <div id="videoModal" class="modal">
      <div class="modal-content">
        <iframe src='<?php echo $video_link ?>' frameborder="0" allowfullscreen autoplay></iframe>
      </div>
    </div>
      </div>
      <div class="school__section__content__quotation">
      <svg class="school__section__content__quotation__icon">
        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#icon-bi_quote"></use>
      </svg>
      <p class="school__section__content__quotation__text"><?php echo $quotation_text ?></p>
      </div>
    </div>
    </div>
  </div>
</section>
<section class="section appeal__section">
  <div class="container">
    <h3 class="section-title"><?php the_field("appeal-title") ?></h3>
    <div class="inner-container appeal__section__content">
    <?php while(have_rows('appeal_content')) : the_row(); 
      $text = get_sub_field('appeal_text');
    ?>
      <div class="appeal__section__content__wrapper swiper-slide"><p class="appeal__section__content__wrapper__text"><?php echo $text ?></p></div>
    <?php endwhile; ?>
    <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<?php get_footer(); ?>