<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer__logo-wrapper">
                <div class="footer__logo">
                    <a href="#">
                        <?php if ( has_custom_logo() ) { echo get_custom_logo(); } ?>                
                    </a>       
                </div> 
                <button>
                </button>
            </div>
            <div class="footer__address-wrapper">
                <h2 class="footer-title"><?php the_field('org_title', 'option'); ?></h2>
                <p><?php the_field('address_label_1', 'option'); ?></p>
                <p><?php the_field('address_label_2', 'option'); ?></p>
                <p><?php the_field('address_label_3', 'option'); ?></p>
                <p><?php the_field('address_label_4', 'option'); ?></p>
            </div>
            <nav class="footer__nav-wrapper">
                <h3><?php the_field('nav_title', 'option'); ?></h3>
                <?php wp_nav_menu( [
                    'theme_location'       => 'footer',                          
                    'container'            => false,                           
                    'menu_class'           => 'footer__list',
                    'menu_id'              => false,    
                    'echo'                 => true,                         
                    'items_wrap'           => '<ul id="%1$s" class="footer_list %2$s">%3$s</ul>',  
                ] ) 
                ?>
            </nav>
            <div class="footer__social-wrapper">
                <h3><?php the_field('social_title', 'option'); ?></h3>
                <div class="footer__social-list">
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
    </div>
</footer>
<?php wp_footer(); ?>  
</body>
</html>
