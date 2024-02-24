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

        <?php get_template_part( 'template-parts/loader' ); ?>

        <div class="activities-pagination__block">

          <button class="activities__button-prev activities-prev" aria-label="previous slide" type="button">
            <svg class="">
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
            </svg>
          </button>

          <div class="bullets"></div>

          <button class="activities__button-next activities-next" type="button" aria-label="next slide">
            <svg class="">
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-right"></use>
            </svg>
          </button>

        </div>

      </div>
    </div>
  </section>

  <section class="section schedule__section">
    <div class="container">
      <h2 class="section-title"><?php the_field('classes_schedule_title'); ?></h2>
      <div class="inner-container">

        <?php 
            $args = array( 
                'post_type'      => 'activities',
                'numberposts'    => -1,
                'order'          => 'ASC',  
                'orderby' => 'meta_value',
	              'meta_key' => 'activity_time',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'activities-categories',
                        'field'    => 'slug',
                        'terms'    => 'constant_activities'
                    )
                )
            );

            $activities_array = get_posts( $args ); ?>

        <?php 
            // ключ - це день тижня, а значення - це масив активностей
            $activities_by_day = array(
                'monday'    => array(),
                'tuesday'   => array(),
                'wednesday' => array(),
                'thursday'  => array(),
                'friday'    => array(),
                'saturday'  => array(),
                'sunday'    => array()
            );

            // Групування активностей по дням тижня
            foreach ($activities_array as $activity) {
                $category = get_the_terms($activity->ID, 'activities-categories');
                foreach ($category as $cat) {
                    $slug = $cat->slug;
                    if (array_key_exists($slug, $activities_by_day)) {
                        $activities_by_day[$slug][] = $activity;
                    }
                }
            }

            // Выводим активности для каждого дня недели
            foreach ($activities_by_day as $day_slug => $activities) { ?>
        <div class="activity__table">
          <div class="activity__table-title"><?php the_field($day_slug, 'options'); ?></div>
          <?php foreach ($activities as $post) {
                        get_template_part( 'template-parts/one-activity-row' );
                    } ?>
        </div>
        <?php } ?>

        <?php wp_reset_postdata(); ?>
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