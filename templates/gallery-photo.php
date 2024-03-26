<?php
/*
Template Name: gallery-photo
*/
get_header();
global $post;
?>
<main>  
    <?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
    <section class="section galery-post"> 
        <div class="container">            
            <div class="inner-container">  
               <h2 class="galery-post__title page-title"><?php the_field('gallery-photo__title'); ?></h2>             
                <div class="galery-post__body">
                    <?php    
                    $params = array(
                        'category_name' => 'gallery',  
                        'numberposts' => -1,
                    );
                    $my_posts = get_posts($params);

                    foreach ($my_posts as $post) : 
                        $gallery_post_img = get_field('gallery-post-image', $post);
                        $gallery_img_alt = get_field('gallery-post-image', $post);     
                        
                        foreach ($gallery_post_img as $img_list) :?>
                            <div class="galery-post__img">
                                <a data-fslightbox="gallery-photo" href="<?php echo $img_list['url'] ?>">    
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
