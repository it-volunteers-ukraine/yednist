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
          <?php 

            if (have_rows('money_support_type')) : ?>
          <?php while (have_rows('money_support_type')) : the_row(); ?>

          <button class="support__tab support__tab-js"
            data-index="<?php echo get_row_index(); ?>"><?php the_sub_field('type'); ?></button>

          <?php 
                endwhile; 
            endif; ?>
        </div>

        <div class="moneysupport__section--list">

          <?php 
          
          $fields = get_field('money_support_type');
          
          if (have_rows('money_support_type')) : ?>

          <?php while (have_rows('money_support_type')) : the_row(); ?>

          <div aria-controls="panel<?php echo get_row_index(); ?>" role="button" aria-expanded="false"
            data-index="<?php echo get_row_index(); ?>" class="support__tab-js moneysupport_accordion">
            <p class="moneysupport__type"><?php echo get_sub_field('type'); ?></p>

            <svg class="plus-icon" width="20px" height="20px">
              <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
            </svg>

            <svg class="minus-icon" width="20px" height="20px">
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#minus-icon"></use>
            </svg>

          </div>


          <div class="moneysupport__block panel" id="panel<?php echo get_row_index(); ?>" role="region">
            <?php  $current_field = $fields[0]; ?>

            <?php if ($current_field) : ?>
            <?php foreach( $current_field as $rows ) { 
           foreach( $rows as $row ) {
          ?>


            <div class="moneysupport__name-value">
              <p class="moneysupport__name"><?php echo $row['name']; ?></p>
              <div class="current_account">
                <p id="" class="moneysupport__value"><?php echo $row['value']; ?></p>
                <?php
                      if( $row['icon_copy'] ) { ?>

                <button id="" class="icon_copy">
                  <svg width="24px" height="24px">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-copy_doc">
                    </use>
                  </svg>
                  <svg id="" class="hidden-checkmark" width="12px" height="12px">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-checkmark">
                    </use>
                  </svg>
                </button>
                <?php }?>
              </div>

            </div>

            <?php } ?>
            <?php } ?>
            <?php if( get_sub_field('paypal') ) { ?>

            <div class="moneysupport__buttons--box">
              <a href="/" class="button moneysupport__button">PayPal</a>
              <a href="/" class="button moneysupport__button">PayU</a>
            </div>

            <?php } ?>

            <?php endif; ?>
          </div>





          <?php endwhile; ?>
          <?php endif; ?>
        </div>

      </div>


    </div>
  </section>


</main>



<?php get_footer(); ?>