<?php
/**
 * Template part for displaying posts
*/
?> 
<div class="about-history-swiper swiper"> 
    <div class="swiper-wrapper">    
        <?php
        $posts_per_page =  (int) get_field('gallery-post-amount');
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
            <div class="about-history-slide swiper-slide">                
                <a href="<?php echo $gallery_post_link ?>">                                                     
                    <h3 class="about-history-title"><?php echo $gallery_post_title ?></h3>                                        
                    <div class="about-history-img">
                        <div class="about-history-img-first"><img  src="<?php echo $gallery_post_img ?>" alt="<?php echo $gallery_img_alt ?>"></div> 
                        <div class="about-history-img-second"><img  src="<?php echo $gallery_post_img_two ?>" alt="<?php echo $gallery_img_alt_two ?>"></div>
                    </div> 
                    <button class="about-history-btn"><?php the_field('more_photo_btn', 'option'); ?></button>
                </a>      
            </div>  
        <?php wp_reset_postdata(); endforeach ?>     
    </div> 
    <?php get_template_part( 'template-parts/swiper-navigation' ); ?> 
</div>
