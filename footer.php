<footer>
    <div class="container footer-container">
        <div class="footer-top-container">
            <div class="footer__logo-wrapper">
                <div class="footer__logo">
                    <?php if (has_custom_logo()) {
                        echo get_custom_logo();
                    } ?>
                    <h2 class="footer-title-tablet">
                        <?php the_field('org_title', 'option'); ?>
                    </h2>
                </div>
                <div class="footer-label-tablet">
                    <?php get_template_part('template-parts/address'); ?>
                </div>
                <div class="footer-icons-mobile">
                    <?php
                    $link = get_field('social_link_1', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="footer-btn-icon" href="<?php echo esc_url($link_url); ?>"
                            target="<?php echo esc_attr($link_target); ?>">
                            <?php if (get_field('social_icon_1', 'option')): ?>
                                <img src="<?php the_field('social_icon_1', 'option'); ?>" />
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>


                    <?php
                    $link = get_field('social_link_2', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="footer-btn-icon" href="<?php echo esc_url($link_url); ?>"
                            target="<?php echo esc_attr($link_target); ?>">
                            <?php if (get_field('social_icon_2', 'option')): ?>
                                <img src="<?php the_field('social_icon_2', 'option'); ?>" />
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>

                    <?php
                    $link = get_field('social_link_3', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="footer-btn-icon" href="<?php echo esc_url($link_url); ?>"
                            target="<?php echo esc_attr($link_target); ?>">
                            <?php if (get_field('social_icon_3', 'option')): ?>
                                <img src="<?php the_field('social_icon_3', 'option'); ?>" />
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <a class="button primary-button footer-btn-mob"
                    href="<?php echo esc_attr(get_field('support_link', 'option')); ?>">
                    <?php the_field('support_btn', 'option'); ?>
                </a>

            </div>
            <div class="footer__address-wrapper">
                <h2 class="footer-title">
                    <?php the_field('org_title', 'option'); ?>
                </h2>
                <h3 class="footer-about-title-mobile acc-show">
                    <?php the_field('about__title', 'option'); ?><svg class="acc-plus-icon" width="20px" height="20px">
                        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
                    </svg>

                    <svg class="acc-minus-icon" width="20px" height="20px">
                        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#minus-icon"></use>
                    </svg>
                </h3>
                <div class="footer-label acc-container">
                    <?php get_template_part('template-parts/address'); ?>
                </div>
            </div>
            <nav class="footer__nav-wrapper">
                <h3 class="acc-show">
                    <?php the_field('nav_title', 'option'); ?>
                    <svg class="acc-plus-icon" width="20px" height="20px">
                        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
                    </svg>

                    <svg class="acc-minus-icon" width="20px" height="20px">
                        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#minus-icon"></use>
                    </svg>
                </h3>

                <?php wp_nav_menu([
                    'theme_location' => 'footer',
                    'container' => false,
                    'menu_class' => 'footer__list',
                    'menu_id' => false,
                    'echo' => true,
                    'items_wrap' => '<ul id="%1$s" class="footer_list acc-container %2$s">%3$s</ul>',
                ])
                    ?>
            </nav>
            <div class="footer__social-wrapper">
                <h3 class="acc-show">
                    <?php the_field('social_title', 'option'); ?>

                    <svg class="acc-plus-icon" width="20px" height="20px">
                        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#plus-icon"></use>
                    </svg>

                    <svg class="acc-minus-icon" width="20px" height="20px">
                        <use href="<?php echo get_template_directory_uri() ?>/assets/images/sprite.svg#minus-icon"></use>
                    </svg>
                </h3>
                <div class="footer__social-list acc-container">
                    <?php
                    $link = get_field('social_link_1', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($link_title); ?>
                        </a>
                    <?php endif; ?>

                    <?php
                    $link = get_field('social_link_2', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($link_title); ?>
                        </a>
                    <?php endif; ?>

                    <?php
                    $link = get_field('social_link_3', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($link_title); ?>
                        </a>
                    <?php endif; ?>

                    <a href="mailto:<?php the_field('social_mail', 'option') ?>">
                        <?php the_field('social_mail', 'option') ?>
                    </a>

                    <a href="tel:<?php the_field('social_phone', 'option') ?>">
                        <?php the_field('social_phone', 'option') ?>
                    </a>
                </div>
                <?php
                    $link = get_field('policy', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="footer-policy" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($link_title); ?>
                        </a>
                    <?php endif; ?>
            </div>
        </div>
        <div class="footer-bottom-container">
            <p class="footer-copy-wrapper">
                <span>Copyright </span>
                <span> &copy
                    
                </span>
                <span><?php echo date("Y"); ?></span>
                <span> Fundacja "Jednosc"
            </p>
            </p>

                <?php
                    $link = get_field('policy', 'option');
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="footer-policy-wrapper" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($link_title); ?>
                        </a>
                    <?php endif; ?>

        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>