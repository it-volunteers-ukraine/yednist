<?php
/*
Template Name: gallery
*/
get_header();
?>
<main>
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="section gallery">
    <div class="container">
      <div class="inner-container">
        <div class="gallery__header">
          <h2 class="gallery__title page-title"><?php the_field('gallery-title'); ?></h2>
          <p class="gallery__title-text"><?php the_field('gallery__title-text'); ?></p>
        </div>
        <div class="gallery__body">
          <?php
            $posts_per_page =  (int) get_field('gallery-post-amount');
            $params = array(
                'category_name' => 'gallery',
                'posts_per_page' => 1,    
                'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,   
            );
            $my_query = new WP_Query($params);

            while ($my_query->have_posts()) : $my_query->the_post(); ?>

          <?php get_template_part( 'template-parts/gallery-item' );?>

          <?php endwhile; ?>
        </div>

        <?php          
          if ( $my_query->max_num_pages > 1 ) :
          ?>
        <div class="pagination">
          <?php
              echo paginate_links( array(
                'base'      => get_pagenum_link( 1 ) . '%_%',
                'format'    => '/page/%#%',
                'current'   => max( 1, get_query_var( 'paged' ) ),
                'total'     => $my_query->max_num_pages,
                 'prev_text' => '<svg class="icon-pagination" width="40" height="40"><use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow-left"></use></svg>',
                'next_text' => '<svg class="icon-pagination" width="40" height="40"><use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow-right"></use></svg>',
              ) );
              ?>
        </div>
        <?php
          endif;
          wp_reset_postdata();
          ?>

      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>