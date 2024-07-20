<?php
/*
Template Name: multicenter
*/
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

          $lang_tab = 'for_all';
          if(function_exists('pll_current_language')){
          $my_lang = pll_current_language();
          
            if ( $my_lang == 'en' ) { 
            $lang_tab = 'for_all-en';
            }
            if ( $my_lang == 'pl' ) { 
            $lang_tab = 'for_all-pl';
            }
          }
          
        $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : $lang_tab;

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

          <button type="button" class="<?php echo esc_attr($tab_classes); ?> tab-accordion"
            data-active="<?php echo $tab_slug ?>" aria-controls="panel-<?php echo $tab_slug; ?>" aria-expanded="false">

            <span class=""><?php echo esc_html($tab_label); ?></span>

            <svg class="plus-icon" width="24px" height="24px">
              <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
            </svg>

            <svg class="minus-icon" width="24px" height="24px">
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#minus-icon"></use>
            </svg>

          </button>

          <div id="panel-<?php echo $tab_slug; ?>" role="region" class="classes__container mobile panel">

            <div id="loadmore-classes" class="classes__load--mobile">
              <?php  get_template_part('template-parts/loader'); ?>
              <a href="#" class="button primary-button classes__load--btn" data-max_pages="<?php echo $max_pages ?>"
                data-paged="<?php echo $paged ?>">
                <?php the_field("last_news_button", "options"); ?>
              </a>
            </div>
          </div>

          <?php } ?>
        </div>

        <div class="classes__container">

          <?php 
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $args = array(
            'post_type'      => 'activities',
            'posts_per_page' => 5,
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

            $max_pages = ceil($posts_count / 5);
            ?>

          <div id="loadmore-classes" class="classes__load">
            <?php  get_template_part('template-parts/loader'); ?>
            <a href="#" class="button primary-button classes__load--btn" data-max_pages="<?php echo $max_pages ?>"
              data-paged="<?php echo $paged ?>">
              <?php the_field("last_news_button", "options"); ?>
            </a>
          </div>

        </div>

      </div>
    </div>
  </section>

  <section class="section invite__section">

    <div class="container">
      <h2 class="section-title"><?php the_field('invite_title'); ?></h2>
      <div class="inner-container">

        <div class="invite__wrapper">

          <div class="invite__text--box">
            <h2 class="invite__subtitle"><?php the_field('invite_subtitle'); ?></h2>
            <div class="invite__text"><?php the_field('invite_text'); ?></div>
          </div>
          <div class="invite__form" name="invite__form" method="post">

            <?php echo do_shortcode('[contact-form-7 id="4c8e395" title="Форма ЗАПРОШУЄМО ДО СПІВПРАЦІ"]') ?>

            <div id="invite__backdrop--notification" class="invite__backdrop--notification is-hidden">
              <div class="invite__notification">
                <button id="invite__notification--btn" class="invite__notification--btn" type="button"
                  id="js-close-invite-form" aria-label="Close modal">
                  <svg class="icon__cross">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#cross-icon"></use>
                  </svg>
                </button>
                <p class="invite__notification--title"><?php the_field('notification_title'); ?></p>
                <p class="invite__notification--text"><?php the_field('notification_text'); ?></p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>



</main>



<?php get_footer(); ?>