<?php
/*
Template Name: projects
*/
get_header();
?>
<main>    
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
    <section class="section projects__section"> 
        <div class="container">
            <div class="inner-container">       
                <h2 class="page-title projects__section__title"><?php $current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : ''; echo (($current_language == 'EN') ? 'All' : (($current_language == 'УКР') ? 'Усі' : 'Wszystkie')) . ' ' . get_the_title(); ?></h2>
                <div class='swiper projects__section__swiper'>
                <?php get_template_part( 'template-parts/projects-list' ); ?>   
              </div>

              <div class="swiper__nav--box">
               <div class="custom-button-prev">
                   <svg>
                     <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
                   </svg>
               </div>
               <div class="swiper-pagination projects__section__swiper__pagination"></div>
               <div class="custom-button-next">
                   <svg>
                     <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-right"></use>
                   </svg>
                 </div>
              </div>

            </div> 
        </div> 
    </section>
</main>

<?php get_footer(); ?>