<?php
/*
* Template Name: gallery-post
* Template post type: post
*/
get_header();
global $post;
$gallery_post_title = get_field('gallery-post-title', $post); 
$gallery_post_text = get_field('gallery-post-text', $post);
$gallery_post_img = get_field('gallery-post-image', $post);
$gallery_img_alt = get_field('gallery-post-image', $post);

?>
<main> 
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="section galery-post"> 
    <div class="container">       
      <div class="inner-container">        
        <h2 class="galery-post__title page-title"><?php echo $gallery_post_title ?></h2>
        <div class="galery-post__body">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>   
          <div class="galery-post__content"><p class="galery-post__text"><?php echo $gallery_post_text; ?></p></div>            

          <?php foreach ($gallery_post_img as $img_list) :?>
            <div class="galery-post__img">
              <a data-fslightbox="gallery" href="<?php echo $img_list['url'] ?>">    
                <img src="<?php echo $img_list['sizes']['medium_large'] ?>" alt="<?php echo $img_list['sizes']['medium_large']; ?>">
              </a>              
            </div>               
          <?php endforeach ?>  

          <?php endwhile; else : ?>
              Sorry, no posts were found.
          <?php endif; ?> 
        </div>
      </div>            
    </div> 
  </section>
<main>
<?php get_footer(); ?>
