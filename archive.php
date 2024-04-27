<?php get_header();
?>
<main>
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="history-ua section">
    <div class="container">
      <div class="inner-container">
        <h2 class="history-ua__title page-title"><?php echo get_the_category()[0]->cat_name; ?></h2>
        <div class="history-ua-body">
          <div class="history-ua-swiper swiper">
            <div class="swiper-wrapper">
              <?php              
              $params = array(
                'category_name' => 'history',    
                'numberposts' => -1,    
              );
              $my_posts = get_posts($params);
              foreach ($my_posts as $post) :                 
                  $gallery_post_title = get_the_title();    
                  $gallery_post_link = $post->guid;   
                  $gallery_post_img = get_field('gallery-post-image', $post)[0]['sizes']['medium_large'];
                  $gallery_post_img_two = get_field('gallery-post-image', $post)[1]['sizes']['medium_large'];
                  $gallery_img_alt = get_field('gallery-post-image', $post)[0]['alt'];  
                  $gallery_img_alt_two = get_field('gallery-post-image', $post)[1]['alt'];  
                  ?>
              <div class="history-ua-slide swiper-slide">
                <a href="<?php echo $gallery_post_link ?>">
                  <h3 class="history-ua-title"><?php echo $gallery_post_title ?></h3>
                  <div class="history-ua-img">
                    <div class="history-ua-img-first"><img src="<?php echo $gallery_post_img ?>"
                        alt="<?php echo $gallery_img_alt ?>"></div>
                    <div class="history-ua-img-second"><img src="<?php echo $gallery_post_img_two ?>"
                        alt="<?php echo $gallery_img_alt_two ?>"></div>
                  </div>
                  <button class="history-ua-btn"><?php the_field('more_photo_btn', 'option'); ?></button>
                </a>
              </div>
              <?php wp_reset_postdata(); endforeach ?>
            </div>
            <?php get_template_part( 'template-parts/swiper-navigation' ); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>