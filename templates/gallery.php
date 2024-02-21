<?php
/*
Template Name: gallery
*/
get_header();
?>
<main>    
    <section class="section gallery"> 
      <div class="container"> 
        <div class="gallery__border">
          <div class="inner-container">
            <div class="gallery__header">
              <h2 class="gallery__title page-title"><?php the_field('gallery-title'); ?></h2> 
              <p class="gallery__title-text"><?php the_field('gallery__title-text'); ?><p>
            </div>
            <div class="gallery__body">
              <?php
              $posts_per_page =  (int) get_field('gallery-post-amount');
              $params = array(
                  'category_name' => 'multicultural-theater',        
                  'posts_per_page' => $posts_per_page,   
              );
              $my_posts = get_posts($params);

              foreach ($my_posts as $post) :                 
                $gallery_post_title = get_field('gallery-post-title', $post);    
                $gallery_post_link = $post->guid;   
                $gallery_post_img = get_field('gallery-post-image', $post)[0]['sizes']['medium_large'];
                $gallery_img_alt = get_field('gallery-post-image', $post)[0]['alt'];      
                $gallery_post_date = get_field('gallery-post-date', $post);
                ?>
                <div class="gallery__item">
                  <a href="<?php echo $gallery_post_link ?>">                  
                    <div class="gallery__post-img"><img src="<?php echo $gallery_post_img ?>" alt="<?php echo $gallery_img_alt ?>"></div> 
                    <div class="gallery__post-content">
                      <p class="gallery__post-cat"><?php echo get_the_category()[0]->cat_name; ?></p>
                      <p class="gallery__post-title"><?php echo $gallery_post_title ?></p> 
                      <p class="gallery__post-date"><?php echo $gallery_post_date ?></p>
                    </div> 
                  </a> 
                </div>        
              <?php endforeach ?>
            </div>
          </div>
        </div>
      </div>
   </section>
</main>
<?php get_footer(); ?>
