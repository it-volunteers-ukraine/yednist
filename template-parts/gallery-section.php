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

foreach ($my_posts as $post) : ?>

<?php get_template_part( 'template-parts/gallery-item' );?>

<?php wp_reset_postdata(); endforeach ?>