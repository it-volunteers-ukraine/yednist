<?php
/*
Template Name: thank-you
*/
get_header();

?>
<main class="main">
  <section class="breadcrumbs__section">
    <div class="container">
      <div class="breadcrumbs__line"></div>
    </div>
  </section>
  <section class="section thank__section">
    <div class="container">
      <div class="inner-container thank__section--container">
        <div class="thank__section--text"><?php the_field('thank_text'); ?></div>
        <a class="button primary-button thank__section--button"
          href='<?php the_field('back_to_home_link'); ?>'><?php the_field('back_to_home'); ?></a>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>