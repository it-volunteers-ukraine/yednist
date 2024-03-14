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
                        foreach ($founders as $row) : ?>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                                        <rect width="40" height="40" rx="20" fill="white" fill-opacity="0.6"/>
                                                        <path d="M6.66675 18.75C5.97639 18.75 5.41675 19.3096 5.41675 20C5.41675 20.6904 5.97639 21.25 6.66675 21.25V18.75ZM34.2173 20.8839C34.7055 20.3957 34.7055 19.6043 34.2173 19.1161L26.2623 11.1612C25.7742 10.673 24.9827 10.673 24.4946 11.1612C24.0064 11.6493 24.0064 12.4408 24.4946 12.9289L31.5656 20L24.4946 27.0711C24.0064 27.5592 24.0064 28.3507 24.4946 28.8388C24.9827 29.327 25.7742 29.327 26.2623 28.8388L34.2173 20.8839ZM6.66675 21.25H33.3334V18.75H6.66675V21.25Z" fill="#0D0D0D"/>
                                                    </svg>
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