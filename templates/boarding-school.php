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
      <h2 class="page-title main__section__title"><?php the_title(); ?></h2>
      <div class="main__section__content">
        <?php 
          $main_photo = get_field("main_photo"); 
          $quotation_text = get_field("quotation_text"); 
          $video_link = get_field('video_link'); 
        ?>
        <div class="main__section__content__image">
          <?php if ($main_photo): ?>
            <img src="<?php echo esc_url($main_photo['url']); ?>" alt="<?php echo esc_attr($main_photo['alt']); ?>" style="display: block; margin: 0 auto;">
            <svg class="main__section__content__image__icon">
              <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#icon-youtube"></use>
            </svg>
          <?php endif; ?>
          <div id="videoModal" class="modal">
            <div class="modal-content">
              <iframe src='<?php echo $video_link ?>' frameborder="0" allowfullscreen autoplay></iframe>
            </div>
          </div>
        </div>
        <div class="main__section__content__quotation">
          <svg class="main__section__content__quotation__icon">
            <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#icon-bi_quote"></use>
          </svg>
          <p class="main__section__content__quotation__text"><?php echo $quotation_text ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section appeal__section">
  <div class="container">
    <h3 class="section-title"><?php the_field("appeal_title") ?></h3>
    <div class="swiper inner-container appeal__swiper">
      <div class="swiper-wrapper appeal__section__content">
        <?php while(have_rows('appeal_content')) : the_row(); 
          $text = get_sub_field('appeal_text');
        ?>
        <div class="swiper-slide appeal__section__content__wrapper">
          <p class="appeal__section__content__wrapper__text"><?php echo $text ?></p>
        </div>
        <?php endwhile; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

<section class="section goals__section">
  <div class="container">
    <h3 class="section-title"><?php the_field("goals_title") ?></h3>
    <div class="inner-container">
      <div class="swiper goals__section__swiper">
        <div class="swiper-wrapper goals__section__wrapper">
          <?php while(have_rows('goals_texts')) : the_row(); 
            $image = get_sub_field('goals_image');
            $text = get_sub_field('goals_text');
          ?>
          <div class="swiper-slide goals__section__wrapper__item">
            <img class="goals__section__wrapper__item__image" src='<?php echo $image['url'] ?>' />
            <p class="goals__section__wrapper__item__text"><?php echo $text ?></p>
          </div>
          <?php endwhile; ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <?php get_template_part( 'template-parts/slider'); ?>
    </div>
  </div>
</section>

<section class="section school__section">
  <div class="container">
    <h3 class="section-title"><?php the_field("school_title") ?></h3>
    <div class="inner-container">
      <div class="school__section__wrapper"><p class="school__section__wrapper__text"><?php the_field("school_text") ?></p></div>
        <ul class="school__section__list">
          <?php while(have_rows('school_advantages')) : the_row(); 
            $text = get_sub_field('school_advantage');
          ?>
            <li class="school__section__list__item"><?php echo $text ?><li>
          <?php endwhile; ?>
      </ul>
    </div>
  </div>
</section>

<section class="section stages__section">
  <div class="container">
    <h3 class="section-title"><?php the_field("stages_title") ?></h3>
    <div class="inner-container">
      <div class="stages__section__wrapper">
        <?php while(have_rows('stages_descriptions')) : the_row(); 
          $text = get_sub_field('stages_description');
        ?>
        <p class="stages__section__wrapper__text"><?php echo $text ?></p>
        <?php endwhile; ?>
        <?php $image = get_field("stages_image"); ?>
      </div>
      <div class="stages__section__image-wrapper"><img class="stages__section__wrapper__image" src='<?php echo $image['url'] ?>' alt='<?php echo $image['alt'] ?>'/></div>
    </div>
  </div>
</section>
<?php get_footer(); ?>