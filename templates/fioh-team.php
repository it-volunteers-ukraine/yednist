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
                    <p class="fioh-team__appeal-text-3">
                        <?php the_field('fioh-team_appeal-text-3'); ?>
                    </p>
                    </div>
                    <div class="swiper-slide fioh-team__appeal-swiper-slide">
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

                <?php
                // $total_rows = count(get_field("fioh-team_projects-repeater")); # всього постів
                // $count = 0;  # лічильник
                // $number = 3; # скільки відображати на сторінці
                ?>

                <?php
                // Якщо є вкладені поля
                if (have_rows("fioh-team_projects-repeater")) { ?>

                    <ul class="fioh-team__project__list">


                    </ul>
                <?php } ?>


                <div class="loadmore-wrapper">
                    <button class="btn acf-loadmore button primary-button" <?php if ($total_rows < $count): ?>
                            style="display: block;" <?php endif; ?>>
                        показати ще
                    </button>
                    <button class="btn acf-hide button primary-button" style="display: none;">
                        сховати
                    </button>
                </div>

                <!-- AJAX завантаження -->

                <script>

                    let my_repeater_field_post_id = <?php echo $post->ID; ?>;
                    let my_repeater_field_offset = 0;
                    let my_repeater_field_nonce = "<?php echo wp_create_nonce("my_repeater_field_nonce"); ?>";
                    let my_repeater_ajax_url = "<?php echo admin_url("admin-ajax.php"); ?>";
                    let my_repeater_more = true;
                    let buttonACF = document.querySelector(".acf-loadmore");
                    let buttonHIDE = document.querySelector(".acf-hide");
                    
                    acf_repeater_show_more()

                    buttonACF.addEventListener("click", acf_repeater_show_more)
                    buttonHIDE.addEventListener("click", () => {
                        const list = document.querySelector(".fioh-team__project__list")
                        list.innerHTML = ""
                        my_repeater_field_offset = 0;
                        acf_repeater_show_more()

                    })

                    function acf_repeater_show_more() {
                        buttonACF.classList.add("loading");
                        // робимо AJAX запит
                        jQuery.post(
                            my_repeater_ajax_url,
                            {
                                // AJAX, який ми налагодили в PHP
                                action: "acf_repeater_show_more",
                                post_id: my_repeater_field_post_id,
                                offset: my_repeater_field_offset,
                                nonce: my_repeater_field_nonce,
                                width: window.innerWidth,
                            },
                            function (json) {
                                // додаємо контент в контейнер
                                // цей ідентифікатор має відповідати контейнеру
                                // до якого ви хочете додати контент
                                jQuery(".fioh-team__project__list").append(json["content"]);
                                // оновимо зміщення
                                my_repeater_field_offset = json["offset"];
     
                                // перевіримо, чи є ще що завантажити
                                if (!json["more"]) {
                                    // якщо ні, сховаємо кнопку завантаження
                                    jQuery(".acf-loadmore").css("display", "none");
                                } else {
                                    buttonACF.classList.remove("loading")
                                    jQuery(".acf-loadmore").css("display", "block");
                                }
                            },
                            "json"
                        );
                    }

                </script>
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
                                <button class="fioh-team__team-repeater-item-btn-circle ">
                                    <?php echo $counter; ?>
                                    <?php echo $count; ?>
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