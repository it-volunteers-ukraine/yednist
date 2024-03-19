<?php
/*
Template Name: support
*/
get_header();

?>
<main class="main">
  <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
  <section class="section support__section">
    <div class="container">
      <div class="inner-container support__section--container">
        <h1 class="page-title support__section--title"><?php the_title(); ?></h1>

        <p class="support__section--text"><?php the_field('support__text'); ?></p>

      </div>
    </div>
  </section>


  <section class="section moneysupport__section">

    <div class="container">
      <h2 class="section-title"><?php the_field('money_support_title'); ?></h2>
      <div class="inner-container">

        <div class="moneysupport__section--tabs">

        </div>


      </div>
    </div>
  </section>


</main>



<?php get_footer(); ?>