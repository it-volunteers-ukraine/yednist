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
          <?php 
            $image = get_field('multicenter_image');
            $size = 'large';
            if( $image ) {
                echo wp_get_attachment_image( $image, $size );
          } ?>

        </div>

        <div class="multicenter__quote--wrapper">

          <div class="multicenter__quote">
            <?php the_field('multicenter_quote'); ?>
          </div>

          <div class="multicenter__quote--icon">
            <svg>
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-bi_quote"></use>
            </svg>
          </div>

        </div>

      </div>
    </div>
  </section>


  <section class="section __section">

    <div class="container">
      <h2 class="section-title"><?php the_field('last_news_title'); ?></h2>
      <div class="inner-container">

        <!-- <form method="POST" class="lastnews_form">
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

          <div id="loadmore">
            <?php  get_template_part('template-parts/loader'); ?>
            <a href="#" class="button primary-button loadnews-btn" data-max_pages="<?php echo $max_pages ?>"
              data-paged="<?php echo $paged ?>" data-order="<?php echo $order ?>">
              <?php the_field("last_news_button", "options"); ?>
            </a>
          </div>

 -->

        <!-- </div> -->
      </div>
    </div>
  </section>



</main>



<?php get_footer(); ?>