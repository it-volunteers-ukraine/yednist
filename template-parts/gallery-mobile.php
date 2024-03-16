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
            'category_name' => 'multicultural-theater',    
            'posts_per_page' => 4,    
        );
        $my_posts = get_posts($params);

        foreach ($my_posts as $post) :                 
            $gallery_post_title = get_field('gallery-post-title', $post);    
            $gallery_post_link = $post->guid;   
            $gallery_post_img = get_field('gallery-post-image', $post)[0]['sizes']['medium_large'];
            $gallery_img_alt = get_field('gallery-post-image', $post)[0]['alt'];      
            $gallery_post_date = get_field('gallery-post-date', $post);
            ?>
            <div class="gallery-mobile-slide swiper-slide">
                <div class=" gallery-mobile-item">
                    <a href="<?php echo $gallery_post_link ?>">                  
                        <div class="gallery__post-img"><img src="<?php echo $gallery_post_img ?>" alt="<?php echo $gallery_img_alt ?>"></div> 
                        <div class="gallery__post-content">
                           <div class="gallery__post-block">
                               <p class="gallery__post-cat"><?php echo get_the_category()[0]->cat_name; ?></p>
                               <p class="gallery__post-title"><?php echo $gallery_post_title ?></p>
                           </div> 
                           <div class="gallery__post-block">
                               <p class="gallery__post-date"><?php echo $gallery_post_date ?></p>
                           </div>
                        </div> 
                    </a>       
                </div>
            </div>
        <?php wp_reset_postdata(); endforeach ?>     
    </div>  
    <div class="gallery-mobile-pagination swiper-pagination"></div>
</div>
    