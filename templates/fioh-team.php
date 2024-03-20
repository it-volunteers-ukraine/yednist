<?php
/*
Template Name: fioh-team
*/
get_header();
?>

<main>
    <?php get_template_part('template-parts/breadcrumbs'); ?>
    <section class="section fioh-team__section">
        <div class="container">
            <div class="inner-container">
                <h1 class="fioh-team__title page-title">
                    <?php the_field('fioh-page_title'); ?>
                </h1>
                <div class="fioh-team__image-wrapper">
                    <?php if (get_field('fioh-page_photo-main')): ?>
                        <img src="<?php the_field('fioh-page_photo-main'); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section fioh-team__section">
        <div class="container">
            <h2 class="fioh-team__subtitle section-title">
                <?php the_field('fioh-team_appeal-title'); ?>
            </h2>
            <div class="inner-container">

                <div class="fioh-team__appeal-wrapper">
                    <p class="fioh-team__appeal-text-1">
                        <?php the_field('fioh-team_appeal-text-1'); ?>
                    </p>
                    <p class="fioh-team__appeal-text-2">
                        <?php the_field('fioh-team_appeal-text-2'); ?>
                    </p>
                    <p class="fioh-team__appeal-text-3">
                        <?php the_field('fioh-team_appeal-text-3'); ?>
                    </p>
                    <p class="fioh-team__appeal-text-4">
                        <?php the_field('fioh-team_appeal-text-4'); ?>
                    </p>
                    <p class="fioh-team__appeal-text-5">
                        <?php the_field('fioh-team_appeal-text-5'); ?>
                    </p>
                    <p class="fioh-team__appeal-text-6">
                        <?php the_field('fioh-team_appeal-text-6'); ?>
                    </p>
                </div>
                <div class="swiper fioh-team__appeal-wrapper-mobile">
                    <div class="swiper-wrapper ">
                        <div class="swiper-slide fioh-team__appeal-swiper-slide">
                            <p class="fioh-team__appeal-text-1">
                                <?php the_field('fioh-team_appeal-text-1'); ?>
                            </p>
                            <p class="fioh-team__appeal-text-2">
                                <?php the_field('fioh-team_appeal-text-2'); ?>
                            </p>

                            <p class="fioh-team__appeal-text-4">
                                <?php the_field('fioh-team_appeal-text-4'); ?>
                            </p>
                        </div>
                        <div class="swiper-slide fioh-team__appeal-swiper-slide">
                            <p class="fioh-team__appeal-text-5">
                                <?php the_field('fioh-team_appeal-text-5'); ?>
                            </p>
                            <p class="fioh-team__appeal-text-3">
                                <?php the_field('fioh-team_appeal-text-3'); ?>
                            </p>

                            <p class="fioh-team__appeal-text-6">
                                <?php the_field('fioh-team_appeal-text-6'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="swiper-pagination fioh-team__appeal-bullets"></div>
                </div>

            </div>
        </div>
    </section>
    <section class="section fioh-team__section">
        <div class="container">
            <h2 class="fioh-team__subtitle section-title">
                <?php the_field('fioh-team_projects-title'); ?>
            </h2>
            <div class="inner-container">

                <?php if (have_rows('fioh-team_projects-repeater')): ?>

                    <ul class="fioh-team__project__list">
                        <?php
                        while (have_rows('fioh-team_projects-repeater')):
                            the_row();
                            $title = get_sub_field('fioh-team_projects-repeater-title');
                            $link = get_sub_field('fioh-team_projects-repeater-link');
                            $photo = get_sub_field('fioh-team_projects-repeater-img');
                            ?>
                            <li class="fioh-team__project__item" style="display: none;">
                                <div class="fioh-team__project__img-wp">
                                    <img class="fioh-team__project__img" src="<?php echo $photo['url']; ?>"
                                        alt="<?php echo $photo['alt']; ?>" />
                                    <button class="fioh-team__project__img-btn">
                                        <img class="fioh-team__project__svg" src="<?php the_field('img_btn_play'); ?>" />
                                    </button>
                                </div>
                                <div class="fioh-team__modal ">
                                    <div class="fioh-team__modal_background">
                                        <div class="fioh-team__modal_window">
                                            <div class="fioh-team__modal_player">
                                                <?php echo $link; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="fioh-team__project__name">
                                    <p>
                                        <?php echo $title; ?>
                                    </p>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>

                <button class="button primary-button btn-show-all" style="display: none;">
                    <?php the_field('show_all'); ?>
                </button>
                <button class="button primary-button btn-hide-all" style="display: none;">
                    <?php the_field('hide'); ?>
                </button>
            </div>
        </div>
    </section>
    <section class="section fioh-team__section">
        <div class="container">
            <h2 class="fioh-team__subtitle section-title">
                <?php the_field('fioh-team_team-title'); ?>
            </h2>
            <div class="inner-container">
                <div class="swiper fioh-team__team-repeater">
                    <?php if (have_rows('fioh-team_team-repeater')): ?>
                        <ul class="swiper-wrapper">
                            <?php
                            $counter = 0;
                            while (have_rows('fioh-team_team-repeater')):
                                the_row();
                                $name = get_sub_field('fioh-team_team-repeater-name');
                                $age = get_sub_field('fioh-team_team-repeater-age');
                                $bio = get_sub_field('fioh-team_team-repeater-bio');
                                $image = get_sub_field('fioh-team_team-repeater-photo');
                                $count = count(get_field("fioh-team_team-repeater"));
                                $counter++;
                                ?>
                                <li class="fioh-team__team-repeater-item swiper-slide">
                                    <div class="fioh-team__team-repeater-img">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                                    </div>
                                    <div class="fioh-team__team-repeater-item-text-wrapper">
                                        <button class="fioh-team__team-repeater-item-readmore" data-show-text="<?php the_field('read_btn', 'option'); ?>" data-hide-text="<?php the_field('hide_btn', 'option'); ?>">
                                            <span><?php the_field('read_btn', 'option'); ?></span>
                                            <?php if (get_field('svg_down')): ?>
                                <img class="fioh-team__team-repeater-item-arrow"  width="12" height="6" src="<?php the_field('svg_down'); ?>" />
                            <?php endif; ?>
                                        </button>
                                        <p class="fioh-team__team-repeater-item-bio">
                                            <?php echo $bio; ?>
                                        </p>
                                        <p class="fioh-team__team-repeater-item-info">
                                            <span class="fioh-team__team-repeater-item-name">
                                                <?php echo $name; ?>
                                            </span>
                                            <span class="fioh-team__team-repeater-item-age">
                                                <?php echo $age; ?>
                                            </span>
                                        </p>
                                    </div>

                                    <button class="fioh-team__team-repeater-item-btn-circle">
                                        <?php if ($counter < 10): ?>
                                            <p class="fioh-team__btn-circle-1"><span>0</span>
                                                <span>
                                                    <?php echo $counter; ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($count >= 10): ?>
                                            <p class="fioh-team__btn-circle-1">
                                                <?php echo $counter; ?>
                                            <?php endif; ?>
                                        </p>
                                        <?php if ($count < 10): ?>
                                            <p class="fioh-team__btn-circle-2">
                                                <span>0</span>
                                                <span>
                                                    <?php echo $count; ?>
                                                </span>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ($count >= 10): ?>
                                            <p class="fioh-team__btn-circle-2">
                                                <?php echo $count; ?>
                                            </p>
                                        <?php endif; ?>
                                    </button>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>