<?php
/*
Template Name: about
*/
get_header();
?>
<main>       
    <section class="section"> 
        <div class="container">
            <div class="inner-container">       
                <h2 class="page-title projects__title"><?php $current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : ''; echo (($current_language == 'EN') ? 'All' : (($current_language == 'УКР') ? 'Усі' : 'Wszystkie')) . ' ' . get_the_title(); ?></h2>
                <div class='projects__list__slider'>
                <?php
                $projects = new WP_Query(array(
                    'post_type' => 'projects',
                    'posts_per_page' => -1,
                ));

                if ($projects->have_posts() && have_rows('projects_descriptions')) {
                  $projects_button = get_field("projects_button_text");
                    while ($projects->have_posts() || have_rows('projects_descriptions')) {
                        $projects->the_post();
                        the_row();
                        
                        $project_description = get_sub_field('project_description');
                        $project_title = get_the_title();
                        $project_link = get_permalink();

                        echo '<div class="">';
                          echo '<h2>' . $project_title . '</h2>';
                          echo '<p>' . $project_description . '</p>';
                          echo '<a href='. $project_link .'>'. $projects_button .'</a>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                }
                ?>
                </div>
            </div> 
        </div> 
    </section>
</main>

<?php get_footer(); ?>