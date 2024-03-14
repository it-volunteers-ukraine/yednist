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

        <div class="">

          <?php  $args = array(
            'post_type' => 'activities',
            'post_status' => 'publish',
            'tax_query' => array(
            array(
              'taxonomy' => 'activities-categories',
              'field'    => 'slug',
              'terms'    => 'temporal_activities'
            )
          )
          );

          $query = new WP_Query($args); ?>

          <?php if ($query->have_posts()) : ?>

          <div class="activities__wrapper is-hidden">
            <?php  while ($query->have_posts()) : $query->the_post(); ?>

            <?php get_template_part('template-parts/one-activity'); ?>

            <?php endwhile; ?>
          </div>
          <?php   endif; ?>

        </div>

        <?php get_template_part( 'template-parts/custom-nav' ); ?>
        <?php wp_reset_postdata(); ?>
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
            'meta_key'       => 'activity_time_1_order_time',
            'tax_query'      => array(
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
                if (have_rows('activity_time', $activity->ID)) {
                    while (have_rows('activity_time', $activity->ID)) {
                        the_row();
                        $day = get_sub_field('day');
                        $activities_by_day[$day][] = $activity;
                    }
                }
            }

// Сортування активностей всередині кожної групи по часу, з урахуванням дня у subfield репітера
  foreach ($activities_by_day as $day_slug => $activities) {
    $activity_times = array();   
    foreach ($activities as $key => $activity) {
        if (have_rows('activity_time', $activity->ID)) {
            $rows = get_field('activity_time', $activity->ID); 
            foreach ($rows as $row) {
                $day = $row['day'];
                if ($day == $day_slug) {
                    $activity_time = array(
                        'time' => $row['order_time'],
                        'post_id' => $activity->ID
                    );
                    array_push($activity_times, $activity_time) ;
                }
            }
        }
    }
    // Сортування массиву активностей по часу
    usort($activity_times, function($a, $b) {
        $time_a = strtotime($a['time']);
        $time_b = strtotime($b['time']);
        return $time_a - $time_b;
    });
    // Новий масив активностей, відсортований відповідно масиву $activity_times
    $sorted_activities = array_map(function($activity_time) use ($activities) {
        foreach ($activities as $activity) {
            if ($activity->ID == $activity_time['post_id']) {
                return $activity;
            }
        }
    }, $activity_times);

    $activities = $sorted_activities; ?>

        <div class="activity__table">
          <div aria-controls="panel-<?php the_field($day_slug, 'options'); ?>" role="button" aria-expanded="false"
            class="activity__table-title schedule-accordion">
            <p><?php the_field($day_slug, 'options'); ?></p>
            <div class="activity__table-arrow">
              <svg>
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-arrow-down"></use>
              </svg>
            </div>
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
                            $order_time = get_sub_field('order_time');
                            $finish_time = get_sub_field('finish_time');
                            echo "<span>{$order_time} - {$finish_time}</span>";
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

        <form method="POST" class="lastnews_form">
          <select name="order" id="order" class="lastnews_select">
            <option value="DESC"><?php the_field('new_at_the_begining'); ?></option>
            <option value="ASC"><?php the_field('old_at_the_begining'); ?></option>
          </select>
          <input type="hidden" id="prev_order" value="<?php echo $order; ?>">
        </form>

        <div class="lastnews__wrapper">

          <?php

            $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $max_pages = ceil(wp_count_posts('news')->publish / 5);
            ?>

          <div id="loadmore-news">
            <?php  get_template_part('template-parts/loader'); ?>
            <a href="#" class="button primary-button loadnews-btn" data-max_pages="<?php echo $max_pages ?>"
              data-paged="<?php echo $paged ?>" data-order="<?php echo $order ?>">
              <?php the_field("last_news_button", "options"); ?>
            </a>
          </div>



        </div>
      </div>
    </div>
  </section>

  <div class="activity-backdrop is-hidden" id="js-activity-form">

    <div class="activity-modal">

    </div>

  </div>

</main>



<?php get_footer(); ?>