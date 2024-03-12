<?php
/*
* Template Name: boarding-school
* Template Post Type: post, page, projects
*/
get_header();
?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
<section class="section">
  <div class="container">
    <div class="inner-container">
    <h2 class="page-title school__section__title"><?php the_title(); ?></h2>
    <div class="school__section__content">
      <div></div>
      <div class="school__section__content__quotation">
      <svg class="school__section__content__quotation__icon">
        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#icon-bi_quote"></use>
      </svg>
      <p class="school__section__content__quotation__text"><?php the_field("quotation_text") ?></p>
      </div>
    </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>