<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wp-it-volunteers
 */

get_header();
?>

	<main id="primary">
		<section class="section error-404 not-found page-404__section">
			 <div class="container page-404__container">
				<div class="inner-container page-404__inner-container">
					<p class="page-404__left-title"> <?php the_field('404-title', 'option'); ?></p>
			<p class="page-404__right-title"> <?php the_field('404-title', 'option'); ?></p>
			<div class="page-404__wrapper">
			<h1 class="page-404__main-title"> 
				<?php the_field('404-title', 'option'); ?></h1>
			<p class="page-404__main-text"><?php the_field('404-text', 'option'); ?></p>
			<a class="button primary-button"
                        href="<?php echo esc_attr(get_field('404-btn-link', 'option') ); ?>">
            <?php the_field('404-btn-name', 'option'); ?></a>
			</div>
			 </div>
			 </div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php get_footer(); ?>