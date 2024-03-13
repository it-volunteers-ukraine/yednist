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
                <div class="inner-container wrapper-container">
                    <h1 class="page-title team-title"><?php the_title(); ?></h1>
                    <div class="team-image">
                        <img src="<?php the_field('image'); ?>" alt="team-image">
                    </div>
                    <h3 class="section-title additional-title"><?php the_field('second-title'); ?></h3>
                    <div class="swiper about-team_slider">
                        <div class="swiper-wrapper">
                            <div class="about-team">
                                <?php
                                $aboutTeam = get_field('about-team');
                                foreach ($aboutTeam as $row): ?>
                                    <div class="swiper-slide">
                                        <p class="info"><?= $row['info']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-pagination swiper-custom-pagination"></div>
                    </div>
                    <div class="founders">
                        <?php
                        $founders = get_field('founders');
                        foreach ($founders

                        as $row) : ?>
                        <div class="image">
                            <img src="<?= $row['founders-image']; ?>" alt="image">
                            <div class="placeholder"><?= $row['placeholder']; ?></div>
                        </div>
                        <div class="description">
                            <?= $row['description']; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


        <section class="section team-members">
            <div class="container">
                <h2 class="section-title members-title"><?php the_field('title'); ?></h2>
                <div class="inner-container wrapper-container">
                    <div class="wrapper">
                        <div class="swiper team_slider ">
                            <div class="swiper-wrapper grid">
                                <?php
                                $teamMembers = get_field('team-members');
                                foreach ($teamMembers as $row) : ?>
                                    <div class="swiper-slide">
                                        <div class="team-item">
                                            <div class="team-image size-block">
                                                <img src="<?= $row['image']; ?>" alt="image">
                                                <button class="show-info">
                                                    <img src="<?php the_field('arrow-icon') ?>" alt="arrow">
                                                </button>
                                                <div class="wrapper-info">
                                                    <div class="info"><?= $row['hover-info']; ?></div>
                                                    <div class="frame"></div>
                                                </div>
                                            </div>
                                            <span><?= $row['description']; ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-pagination swiper-custom-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php get_footer(); ?>