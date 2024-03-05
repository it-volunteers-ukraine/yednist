<div class='swiper projects__section__swiper'>
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
                        $project_id = get_the_ID();
                        $terms = get_the_terms($project_id, 'projects-mark');

                        echo '<div class="swiper-slide projects__section__swiper__item">';
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                echo '<div class="projects__section__swiper__item__mark"><p class="projects__section__swiper__item__mark__message">' . $term->name . '</p></div>';
                            }
                        }
                         echo '<div class="projects__section__swiper__item__content">';
                         echo '<div class="projects__section__swiper__item__content__wrapper">';
                         echo '<h3 class="projects__section__swiper__item__title">' . $project_title . '</h3>';
                         echo '<p class="projects__section__swiper__item__description">' . $project_description . '</p>';
                         echo '</div>';
                         echo '<a class="button secondary-button projects__section__swiper__item__button" href='. $project_link .'>'. $projects_button .'</a>';
                         echo '</div>';
                         if (!empty($project_images)) {
                          echo '<div class="projects__section__swiper__item__photo__container">';
                          if (count($project_images) === 1) {
                              $image = $project_images[0];
                              echo '<img class="single-image" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
                          } else {
                              foreach ($project_images as $index => $image) {
                                  echo '<img class="projects__section__swiper__item__photo" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
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