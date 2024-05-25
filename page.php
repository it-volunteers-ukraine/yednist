<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-it-volunteers
 */

get_header();?>

<section class="section" style="margin-top: 120px;">
  <div class="container">
    <div class="inner-container">

      <?php the_content();
//get_sidebar(); ?>

    </div>
  </div>
</section>
<?php get_footer();