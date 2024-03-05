<?php
/*
Template Name: gallery-photo
*/
get_header();
global $post;
?>
<main>  
    <?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
    <section class="section about"> 
        <div class="container">            
            <div class="inner-container">
               <h2 class="about__title page-title"><?php the_field('about-title'); ?></h2>
                <div class="about__body">
                <?php
            $posts_per_page =  (int) get_field('gallery-post-amount');
            $params = array(
                'category_name' => 'multicultural-theater',        
                'posts_per_page' => $posts_per_page,   
                'numberposts' => -1,
            );
            $my_posts = get_posts($params);

            foreach ($my_posts as $post) :                 
                $gallery_post_title = get_field('gallery-post-title', $post);    
                $gallery_post_link = $post->guid;   
                $gallery_post_img = get_field('gallery-post-image', $post);
                $gallery_img_alt = get_field('gallery-post-image', $post);      
                // $gallery_post_date = get_field('gallery-post-date', $post);
                ?>
                
                <?php foreach ($gallery_post_img as $img_list) :?>
            <div class="galery-post__img">
              <a data-fslightbox="gallery" href="<?php echo $img_list['url'] ?>">    
                <img src="<?php echo $img_list['sizes']['medium_large'] ?>" alt="<?php echo $img_list['sizes']['medium_large']; ?>">
              </a>              
            </div>               
          <?php endforeach ?>  
            
              <?php wp_reset_postdata(); endforeach ?>
                </div>
            </div>  
        </div>    
    </section>   
</main>
<?php get_footer(); ?>
