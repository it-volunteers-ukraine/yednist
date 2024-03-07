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
                    <div class="about-team">
                        <?php
                        $aboutTeam = get_field('about-team');
                        foreach ($aboutTeam as $row): ?>
                            <div class="item">
                                <p class="info"><?= $row['info']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="founders">
                        <?php
                        $founders = get_field('founders');
                        foreach ($founders as $row) : ?>
                        <div class="image">
                            <img src="<?= $row['founders-image']; ?>" alt="image">
                            <div class="placeholder"><?= $row['placeholder']; ?></div>
                        </div>
                        <p class="description"><?= $row['description']; ?></p>
                    </div>
                    <?php endforeach; ?>
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