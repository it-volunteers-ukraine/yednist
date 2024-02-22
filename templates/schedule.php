<?php
/*
Template Name: schedule
*/
acf_form_head();
get_header();

?>
<main class="main">
  <section class="section activities__section">
    <div class="container">
      <div class="inner-container">
        <h1 class="page-title"><?php the_field('schedule_page_title'); ?></h1>

        <div class="activities__wrapper"></div>


        <div class="activities-pagination__block">
          <div class="activities-navigation__box">
            <button class="custom-button-prev activities-prev" type="button">
              <svg class="">
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
              </svg>
            </button>
            <button class="custom-button-next activities-next" type="button">
              <svg class="">
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-right"></use>
              </svg>
            </button>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="section schedule__section">

    <div class="container">
      <h2 class="section-title"><?php the_field('classes_schedule_title'); ?></h2>
      <div class="inner-container">

      </div>
    </div>
  </section>

  <section class="section lastnews__section">

    <div class="container">
      <h2 class="section-title"><?php the_field('last_news_title'); ?></h2>
      <div class="inner-container">

      </div>
    </div>
  </section>
</main>



<?php get_footer(); ?>