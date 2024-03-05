<?php
/*
Template Name: team
*/
get_header();
?>


    <main>
        <?php get_template_part('template-parts/breadcrumbs'); ?>
        <section class="section our-team">
            <div class="container">
                <div class="inner-container">
                    <h1 class="page-title team-title"><?php the_title(); ?></h1>
                    <div class="team-image">
                        <img src="<?php the_field('image'); ?>" alt="team-image">
                    </div>
                </div>
            </div>
        </section>


        <section class="section team-members">
            <div class="container">
                <h2 class="section-title members-title"><?php the_field('title'); ?></h2>
                <div class="inner-container">
                    <div class="swiper team_slider wrap">
                        <div class="swiper-wrapper grid">
                            <?php
                            $teamMembers = get_field('team-members');
                            foreach ($teamMembers as $row) : ?>
                                <div class="swiper-slide">
                                    <div class="team-image size-block">
                                        <img src="<?= $row['image']; ?>" alt="image">
                                        <div class="block">
                                            <div class="info"><?= $row['hover-info']; ?></div>
                                        </div>
                                    </div>
                                    <span><?= $row['description']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php get_template_part('template-parts/swiper-navigation'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php get_footer(); ?>