<footer>
    <div class="container">
        <div class="footer-top-container">
            <div class="footer__logo-wrapper">
                <div class="footer__logo">
                    <a href="#">
                        <?php if ( has_custom_logo() ) { echo get_custom_logo(); } ?>                
                    </a>
                    <h2 class="footer-title-tablet"><?php the_field('org_title', 'option'); ?></h2>       
                </div> 
                <div class="footer-label-tablet">
                <p><?php the_field('address_label_1', 'option'); ?></p>
                <p><?php the_field('address_label_2', 'option'); ?></p>
                <p><?php the_field('address_label_3', 'option'); ?></p>
                <p><?php the_field('address_label_4', 'option'); ?></p>
                </div>
                <div class="footer-icons-mobile">
                    icons
                </div>
                <button class="button primary-button"><?php the_field('btn_text', 'option'); ?>
                </button>
            </div>
            <div class="footer__address-wrapper">
                <h2 class="footer-title"><?php the_field('org_title', 'option'); ?></h2>
                <h3 class="footer-about-title-mobile acc-show"><?php the_field('social_title', 'option'); ?></h3>
                <div class="footer-label acc-container">
                <p><?php the_field('address_label_1', 'option'); ?></p>
                <p><?php the_field('address_label_2', 'option'); ?></p>
                <p><?php the_field('address_label_3', 'option'); ?></p>
                <p><?php the_field('address_label_4', 'option'); ?></p>
                </div>
            </div>
            <nav class="footer__nav-wrapper">
                <h3 class="acc-show"><?php the_field('nav_title', 'option'); ?></h3>
                <?php wp_nav_menu( [
                    'theme_location'       => 'footer',                          
                    'container'            => false,                           
                    'menu_class'           => 'footer__list',
                    'menu_id'              => false,    
                    'echo'                 => true,                         
                    'items_wrap'           => '<ul id="%1$s" class="footer_list acc-container %2$s">%3$s</ul>',  
                ] ) 
                ?>
            </nav>
            <div class="footer__social-wrapper">
                <h3 class="acc-show"><?php the_field('social_title', 'option'); ?></h3>
                <div class="footer__social-list acc-container">
                    <?php 
                    $link = get_field('social_link_1', 'option');
                    if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                    </a>
                    <?php endif; ?>

                    <?php 
                    $link = get_field('social_link_2', 'option');
                    if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                    </a>
                    <?php endif; ?>

                    <?php 
                    $link = get_field('social_link_3', 'option');
                    if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" 
                    target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                    </a>
                    <?php endif; ?>
                
                    <a href="mailto:<?php the_field('social_mail', 'option') ?>">
                    <?php the_field('social_mail', 'option') ?>
                    </a>

                    <a href="tel:<?php the_field('social_phone', 'option') ?>">
                    <?php the_field('social_phone', 'option') ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom-container">
            <p>Copyright 2024 Fundacja "Jednosc"</p>
            <p>політика конфіденційності</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>  
</body>
</html>
