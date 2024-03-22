<?php get_header();
/*
Template Name: category-history-ua
*/
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
              //$current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : '';
              //$category_name = ($current_language == 'EN') ? 'history-en' : (($current_language == 'УКР') ? 'history-ua' : 'history-pl');
              $params = array(
                'category_name' => 'history-ua',    
                'numberposts' => -1,    
              );
              $my_posts = get_posts($params);
              foreach ($my_posts as $post) :                 
                  $gallery_post_title = get_field('gallery-post-title', $post);    
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
                              <div class="history-ua-img-first"><img  src="<?php echo $gallery_post_img ?>" alt="<?php echo $gallery_img_alt ?>"></div> 
                              <div class="history-ua-img-second"><img  src="<?php echo $gallery_post_img_two ?>" alt="<?php echo $gallery_img_alt_two ?>"></div>
                          </div> 
                          <button class="history-ua-btn"><?php the_field('more_photo_btn', 'option'); ?></button>
                      </a>      
                  </div>  
              <?php wp_reset_postdata(); endforeach ?>  
            </div>
            <div class="swiper__nav--box">
              <div class="custom-button-prev">
                <svg class="">
                  <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
                </svg>
              </div>
            <div class="swiper-pagination swiper-custom-pagination"></div>
            <div class="custom-button-next">
              <svg class="">
                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-right"></use>
              </svg>
            </div>
          </div> 
        </div>
      </div>    
    </div>    
  </section>   
</main>
<?php get_footer(); ?>
