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
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

        <div class="container">
            <h2 class="fioh-team__subtitle section-title">
                <?php the_field('fioh-team_projects-title'); ?>
            </h2>
            <div class="inner-container">

                <?php if (have_rows('fioh-team_projects-repeater')): ?>

                    <ul class="fioh-team__project__list">
                        <?php
                        the_row();
                        $title = get_sub_field('fioh-team_projects-repeater-title');
                        $link = get_sub_field('fioh-team_projects-repeater-link');
                        ?>

                        <li class="fioh-team__project__item">
                            <div class="fioh-team__project__link">
                                <?php echo $link; ?>
                            </div>
                            <div class="fioh-team__project__name">
                                <p>
                                    <?php echo $title; ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>

                <button class="button primary-button btn-show-all" style="display: none;">
                    <?php the_field('show_all_videos', 'option'); ?>
                </button>
                <button class="button primary-button btn-hide-all" style="display: none;">
                    <?php the_field('hide_btn', 'option'); ?>
                </button>
            </div>
        </div>
        <script>
            const post_id = <?php echo $post->ID; ?>;
            const my_repeater_field_nonce = '<?php echo wp_create_nonce('my_repeater_field_nonce'); ?>';
            const my_repeater_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
            let itemsCount = getitemsCount();
            let startIndex = 1;
            let total;

            const showAllBtn = document.querySelector('.btn-show-all')
            const hideAllBtn = document.querySelector('.btn-hide-all')
            showAllBtn.addEventListener("click", () => {
                loadProjects();
                showAllBtn.style.display = "none"
                hideAllBtn.style.display = "block"
            })
            hideAllBtn.addEventListener("click", () => {
                const items = document.querySelectorAll(".fioh-team__project__item")
                const itemsArr = Array.from(items)
                const slicedArr = itemsArr.slice(getitemsCount())
                slicedArr.forEach(el => el.remove())
                hideAllBtn.style.display = "none"
                startIndex = getitemsCount()
                if (total > startIndex) {
                    showAllBtn.style.display = "block"
                }
            })

            function getitemsCount() {
                if (window.innerWidth > 1349.98) {
                    return 3;
                } else if (window.innerWidth > 767.98) {
                    return 2;
                } else {
                    return 1;
                }
            }
            function loadProjects() {
                // робимо AJAX запит
                jQuery.post(
                    my_repeater_ajax_url,
                    {
                        // AJAX, який ми налагодили в PHP
                        action: "acf_repeater_show_more",
                        nonce: my_repeater_field_nonce,

                        start: startIndex,
                        end: itemsCount,
                        post_id
                    },
                    function (json) {
                        // додаємо контент в контейнер
                        // цей ідентифікатор має відповідати контейнеру
                        // до якого ви хочете додати контент
                        jQuery(".fioh-team__project__list").append(json["content"]);
                        // оновимо зміщення
                        startIndex = Number(json["end"]);
                        total = Number(json["total"])
                        // itemsCount =startIndex +getitemsCount()
                        itemsCount = total
                        // перевіримо, чи є ще що завантажити
                        if (!json["more"]) {
                            showAllBtn.style.display = "none"
                        } else {
                            showAllBtn.style.display = "block"
                        }
                    },
                    "json"
                );
            }

            loadProjects();
        </script>
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
                                        <button class="fioh-team__team-repeater-item-readmore">
                                            <?php the_field('read_btn', 'option'); ?>
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