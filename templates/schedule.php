<?php
/*
Template Name: schedule
*/
acf_form_head();
get_header();

?>
<main class="main">
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="section activities__section">
    <div class="container">
      <div class="inner-container">
        <h1 class="page-title"><?php the_field('schedule_page_title'); ?></h1>

        <div class="activities__wrapper"></div>

        <?php get_template_part( 'template-parts/loader' ); ?>
        <?php get_template_part( 'template-parts/custom-nav' ); ?>

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
          <div aria-controls="panel-<?php the_field($day_slug, 'options'); ?>" role="button" aria-expanded="false"
            class="activity__table-title schedule-accordion">
            <p><?php the_field($day_slug, 'options'); ?></p>
            <div class="activity__table-arrow"></div>
          </div>
          <div id="panel-<?php the_field($day_slug, 'options'); ?>" role="region"
            class="activity__table-box schedule-panel">
            <?php foreach ($activities as $post) { ?>
            <div class="activity__table-row">
              <div class="activity__table-time">

                <?php
                  if( have_rows('activity_time') ):

                      while( have_rows('activity_time') ) : the_row();

                          $day = get_sub_field('day');
                          if($day==$day_slug){
                            echo get_sub_field('time');
                          }

                      endwhile;
                  endif;?>
              </div>
              <?php get_template_part( 'template-parts/one-activity-row' );?>
            </div>
            <?php } ?>
          </div>
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