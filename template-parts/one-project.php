<?php 
if (isset($args['child'])) {
    $child = $args['child'];
}
if (isset($args['parent_page'])) {
    $parent_page = $args['parent_page'];
}

        $projects_button = get_field("projects_button_text", $parent_page->ID);
        $project_description = get_field('project_description', $child->ID);
        $project_images = get_field('project_images', $child->ID);
        $project_title = get_the_title($child->ID);
        $project_link = get_permalink($child->ID);
        $project_id = $child->ID;
        $terms = get_the_terms($project_id, 'projects-mark');
        echo '<div class="projects__section__swiper__item">';
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
        echo '<a class="button secondary-button projects__section__swiper__item__button" href=' . $project_link . '>' . $projects_button . '</a>';
        echo '</div>';

        if (!empty($project_images)) {
          echo '<div class="projects__section__swiper__item__photo__container">';
          if (count($project_images) === 1) {
            $image = $project_images[0];
            echo '<div class="projects__section__swiper__item__photo__wrapper"><img class="single-image" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
          } else {
            foreach ($project_images as $index => $image) {
              echo '<div class="projects__section__swiper__item__photo__wrappers"><img class="projects__section__swiper__item__photo" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
            }
          }
          echo '</div>';
        }
        echo '</div>';
      