<?php
/*
Template Name: about
*/
get_header();
?>
<main>    
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>   
    <section class="section projects__section"> 
        <div class="container">
            <div class="inner-container">       
                <h2 class="page-title projects__title"><?php $current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : ''; echo (($current_language == 'EN') ? 'All' : (($current_language == 'УКР') ? 'Усі' : 'Wszystkie')) . ' ' . get_the_title(); ?></h2>
                <div class='swiper projects__swiper'>
                <div class='swiper-wrapper'>
                <?php
                $projects = new WP_Query(array(
                    'post_type' => 'projects',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                ));

                if ($projects->have_posts() && have_rows('projects_descriptions')) {
                  $projects_button = get_field("projects_button_text");
                    while ($projects->have_posts() || have_rows('projects_descriptions')) {
                        $projects->the_post();
                        the_row();
                        
                        $project_description = get_sub_field('project_description');
                        $project_images = (is_array(get_sub_field('project_images')) ? get_sub_field('project_images') : '');
                        $project_title = get_the_title();
                        $project_link = get_permalink();

                        echo '<div class="swiper-slide projects__swiper__item">';
                         echo '<div class="projects__swiper__item__content">';
                         echo '<div class="projects__swiper__item__content__wrapper">';
                         echo '<h2 class="projects__swiper__item__title">' . $project_title . '</h2>';
                         echo '<p class="projects__swiper__item__description">' . $project_description . '</p>';
                         echo '</div>';
                         echo '<a class="button secondary-button projects__swiper__item__button" href='. $project_link .'>'. $projects_button .'</a>';
                         echo '</div>';
                         if (!empty($project_images)) {
                          echo '<div class="photo">';
                          if (count($project_images) === 1) {
                              $image = $project_images[0]; // Получаем единственное изображение
                              echo '<img class="photo__photo single-image" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
                          } else {
                              foreach ($project_images as $index => $image) {
                                  echo '<img class="photo__photo" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
                              }
                          }
                          echo '</div>';
                      }
                        echo '</div>';  
                    }
                    wp_reset_postdata();
                }
                ?>
                </div>
              </div>
              <div class="swiper__nav--box">
               <div class="custom-button-prev">
                   <svg>
                     <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#arrow-left"></use>
                   </svg>
               </div>
               <div class="swiper-pagination projects__swiper__pagination"></div>

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