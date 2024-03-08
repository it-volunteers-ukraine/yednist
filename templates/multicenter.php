<?php
/*
Template Name: multicenter
Template Post Type: post, page, projects
*/
acf_form_head();
get_header();

?>
<main class="main">
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="section multicenter__section">
    <div class="container">
      <div class="inner-container">
        <h1 class="page-title multicenter__section--title"><?php the_title(); ?></h1>

        <div class="multicenter__image">
          <div class="multicenter__image--wrap">
            <?php 
            $image = get_field('multicenter_image');
            $size = 'large';
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
          } ?>

          </div>
        </div>

        <div class="multicenter__quote--wrapper">

          <div class="multicenter__quote--icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-bi_quote"></use>
            </svg>
          </div>

          <div class="multicenter__quote">
            <?php the_field('multicenter_quote'); ?>
          </div>

        </div>

      </div>
    </div>
  </section>


  <section class="section classes__section">

    <div class="container">
      <h2 class="section-title"><?php the_field('classes_title'); ?></h2>
      <div class="inner-container">

        <div class="classes__tabs--container">
          <?php
        $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'for_all';

        $taxonomy_terms = get_terms(array(
          'taxonomy' => 'activities-target',
          'hide_empty' => false,
          'meta_key' => 'order_number',
          'orderby' => 'meta_value'
        ));

        foreach ($taxonomy_terms as $term) {
          $tab_slug = $term->slug;
          $tab_label = $term->name;
          $tab_classes = ($active_tab === $tab_slug) ? 'tab tab-active' : 'tab';
          ?>
          <button type="button" class="<?php echo esc_attr($tab_classes); ?>"
            data-active="<?php echo $tab_slug ?>"><?php echo esc_html($tab_label); ?></button>
          <?php } ?>
        </div>

        <div class="classes__container">

          <?php 
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $args = array(
            'post_type'      => 'activities',
            'posts_per_page' => 1,
            'paged'          => $paged,
            'orderby'        => 'modified',
            'order'          => 'DESC',
            'post_status'    => 'publish',
            'tax_query'      => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy'=> 'activities-categories',
                            'field' => 'slug',
                            'terms' => 'constant_activities',
                        ),
                        array(
                            'taxonomy'=> 'activities-target',
                            'field' => 'slug',
                            'terms' => $tab_slug,
                        )
                    )
            );

            $query = new WP_Query($args);
            $posts_count = $query->found_posts; 

            $max_pages = ceil($posts_count / 1);
            ?>

          <div id="loadmore">
            <?php  get_template_part('template-parts/loader'); ?>
            <a href="#" class="button primary-button loadnews-btn" data-max_pages="<?php echo $max_pages ?>"
              data-paged="<?php echo $paged ?>">
              <?php the_field("last_news_button", "options"); ?>
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>

  <section class="section classes__section">

    <div class="container">
      <h2 class="section-title"><?php the_field('invite_title'); ?></h2>
      <div class="inner-container">

      </div>
    </div>
  </section>



</main>



<?php get_footer(); ?>