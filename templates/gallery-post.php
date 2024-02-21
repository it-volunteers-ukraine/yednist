<?php
/*
* Template Name: gallery-post
* Template post type: post
*/
get_header();
global $post;
$gallery_post_text = get_field('gallery-post-text', $post);
$gallery_post_img = get_field('gallery-post-image', $post);
$gallery_img_alt = get_field('gallery-post-image', $post);

?>
<main>    
    <section class="section"> 
    <div class="container"> 
      <h2 class="page-title">gallery post</h2> 
      <div class="inner-container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <p><?php echo $gallery_post_text; ?></p>
        <?php foreach ($gallery_post_img as $img_list) :?>
        <div><img src="<?php echo $img_list['sizes']['medium_large'] ?>" alt="<?php echo $img_list['sizes']['medium_large']; ?>"></div>
        <?php endforeach ?>   
        <?php endwhile; else : ?>
            Sorry, no posts were found.
        <?php endif; ?> 
        
      </div> 
    </div> 
   </section>
<main>
<?php get_footer(); ?>