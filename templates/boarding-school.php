<?php
/*
* Template Name: boarding-school
* Template post type: post
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
      <svg class="plus-icon" width="20px" height="20px">
        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
      </svg>
      <p>Відкриття школи-інтернату є стратегічною метою громадської організації "Єдність" на вересень 2024 року. Усі чинні проєкти, представлені на цьому сайті, є підготовчим етапом для досягнення цієї головної мети.</p>
      </div>
    </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>