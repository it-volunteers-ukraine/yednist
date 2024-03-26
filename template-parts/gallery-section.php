<?php
/**
 * Template part for displaying posts
*/

$posts_per_page =  (int) get_field('gallery-post-amount');
$params = array(
    'category_name' => 'gallery',    
    'posts_per_page' => 4,      
    // 'posts_per_page' => $posts_per_page,  
    // 'numberposts' => -1, 
);
$my_posts = get_posts($params);

foreach ($my_posts as $post) :                 
    $gallery_post_title = get_field('gallery-post-title', $post);    
    $gallery_post_link = $post->guid;   
    $gallery_post_folder = get_field('gallery-post-folder', $post); 
    $gallery_post_img = get_field('gallery-post-image', $post)[0]['sizes']['medium_large'];
    $gallery_img_alt = get_field('gallery-post-image', $post)[0]['alt'];      
    $gallery_post_date = get_field('gallery-post-date', $post);
    ?>
    <div class="gallery__item">
        <a href="<?php echo $gallery_post_link ?>">                  
            <div class="gallery__post-img"><img src="<?php echo $gallery_post_img ?>" alt="<?php echo $gallery_img_alt ?>"></div> 
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
<?php wp_reset_postdata(); endforeach ?> 
    