<?php
/**
 * Template part for displaying posts
*/
?>

<div class="swiper gallery-mobile-swiper">
  <div class="swiper-wrapper">
    <?php
        $posts_per_page =  (int) get_field('gallery-post-amount');
        $params = array(
            'category_name' => 'gallery',    
            'posts_per_page' => 4,
            'orderby' => 'date',    
        );
        $my_posts = get_posts($params);

        foreach ($my_posts as $post) : ?>

    <div class="gallery-mobile-slide swiper-slide">
      <?php get_template_part( 'template-parts/gallery-item' );?>
    </div>
    <?php wp_reset_postdata(); endforeach ?>
  </div>
  <div class="gallery-mobile-pagination swiper-pagination"></div>
</div>