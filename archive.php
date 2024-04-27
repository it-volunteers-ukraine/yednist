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
                'posts_per_page' => 6,    
                'paged'          => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,   
            );
            $my_query = new WP_Query($params);

            while ($my_query->have_posts()) : $my_query->the_post();
              $gallery_post_title = get_field('gallery-post-title');    
              $gallery_post_link = get_permalink();   
              $gallery_post_folder = get_field('gallery-post-folder'); 
              $gallery_post_img = get_field('gallery-post-image', $post)[0]['sizes']['medium_large'];
              $gallery_img_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);      
              $gallery_post_date = get_field('gallery-post-date');
            ?>
              <div class="gallery__item">
                <a href="<?php echo $gallery_post_link ?>">  
                  <?php if (has_post_thumbnail()): ?>
                    <div class="gallery__post-img"><?php the_post_thumbnail('medium_large'); ?></div>
                  <?php else: ?>
                    <div class="gallery__post-img"><img src="<?php echo $gallery_post_img ?>" alt="<?php echo $gallery_img_alt ?>"></div>
                  <?php endif; ?>
                  <div class="gallery__post-content">
                    <div class="gallery__post-block">
                      <p class="gallery__post-cat"><?php echo $gallery_post_folder ?></p>
                      <p class="gallery__post-title"><?php echo $gallery_post_title ?></p>
                    </div> 
                    <div class="gallery__post-block">
                      <p class="gallery__post-date"><?php echo $gallery_post_date ?></p>
                    </div>
                  </div> 
                </a>
              </div>        
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
                'prev_text' => '<svg class="icon-pagination"><use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#prev-pagination" alt="prev"></use></svg>',
                'next_text' => '<svg class="icon-pagination"><use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#next-pagination" alt="next"></use></svg>',
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
