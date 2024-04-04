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

            if (have_rows('money_support_type', "options")) : ?>
          <?php while (have_rows('money_support_type', "options")) : the_row(); ?>

          <button class="support__tab support__tab-js"
            data-current_index="<?php echo get_row_index(); ?>"><?php the_sub_field('type'); ?></button>

          <?php 
                endwhile; 
                
            endif; ?>
        </div>

        <div class="moneysupport__block_desktop"></div>

        <div class="moneysupport__section--list">

          <?php 
          
          $fields = get_field('money_support_type', "options");
          
          if (have_rows('money_support_type', "options")) : ?>

          <?php while (have_rows('money_support_type', "options")) : the_row(); ?>

          <div aria-controls="panel<?php echo get_row_index(); ?>" role="button" aria-expanded="false"
            data-index="<?php echo get_row_index(); ?>" class="moneysupport_accordion">
            <p class="moneysupport__type"><?php echo get_sub_field('type'); ?></p>

            <svg class="plus-icon" width="20px" height="20px">
              <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
            </svg>

            <svg class="minus-icon" width="20px" height="20px">
              <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#minus-icon"></use>
            </svg>

          </div>



          <?php if (have_rows('fields')) : ?>
          <div class="moneysupport__block panel" id="panel<?php echo get_row_index(); ?>" role="region">
            <?php while (have_rows('fields')) : the_row(); ?>


            <div class="moneysupport__name-value">
              <p class="moneysupport__name"><?php the_sub_field('name'); ?></p>
              <div class="current_account">
                <p id="" class="moneysupport__value"><?php the_sub_field('value'); ?></p>
                <?php
                      if( get_sub_field('icon_copy') ) { ?>

                <button class="icon_copy" aria-label="copy string">
                  <svg width="20px" height="20px">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-copy_doc">
                    </use>
                  </svg>
                  <svg class="hidden-checkmark copy_current_account-js" width="12px" height="12px">
                    <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#icon-checkmark">
                    </use>
                  </svg>
                </button>
                <?php }?>
              </div>

            </div>

            <?php endwhile; ?>

            <?php if( get_sub_field('paypal') ) { 

            get_template_part('template-parts/support-details-btns');

             } ?>

            <?php endif; ?>
          </div>

          <?php endwhile; ?>
          <?php endif; ?>

        </div>


      </div>
  </section>


</main>



<?php get_footer(); ?>