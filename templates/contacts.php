<?php
/*
Template Name: contacts
*/
get_header();
?>
<main>       
    <section class="section contacts__page"> 
        <div class="container">
            <div class="contacts__page-border">
                <div class="inner-container">
                    <div class="contacts__page-body">                    
                        <div class="contacts__form">
                           <h2 class="contacts__page-title page-title"><?php the_field('contacts-form-title'); ?></h2> 
                            <div id="contactForm" name="form-contact" class="form__contacts" method="post">
                                <?php echo do_shortcode('[contact-form-7 id="7ddce3e" title="Contact Form"]') ?>
                                
                                <div id="popup-success" class="popup closen">
                                    <div class="popup__container">                                                      
                                        <button class="popup__close" type="button">&#215;</button>
                                        <p class="popup__title"><?php the_field('popup__title'); ?></p>
                                        <p class="popup__text"><?php the_field('popup__text'); ?></p>                                      
                                    </div> 
                                </div> 
                            </div>

                        </div>
                        <div class="contacts__page-content">
                            <h2 class="contacts__page-title page-title"><?php the_field('contacts-contact-title'); ?></h2> 
                            <div class="contacts__page-image"><img src="<?php the_field('contacts__page-image'); ?>" alt="hero"></div>
                            <div class="contacts__page-adress">
                                <h4 class="contacts__page-adress-title"><?php the_field('contacts-adress-title'); ?></h4>
                                <ul class="contacts__page-adress-list">
                                    <li class="contacts__page-adress-item"><a href="<?php the_field('contacts-adress-link'); ?>" target="_blank"><p class="contacts__page-adress-text"><?php the_field('address_label_1', 'option'); ?></p></a></li>
                                    <li class="contacts__page-adress-item"><p class="contacts__page-adress-text"><?php the_field('address_label_2', 'option'); ?></p></li>
                                    <li class="contacts__page-adress-item"><p class="contacts__page-adress-text"><?php the_field('address_label_3', 'option'); ?></p></li>
                                    <li class="contacts__page-adress-item"><p class="contacts__page-adress-text"><?php the_field('address_label_4', 'option'); ?></p></li>
                                </ul>                            
                            </div>
                            <div class="contacts__page-social">
                                <ul class="contacts__page-social-list"> 
                                    <li class="contacts__page-social-item">
                                        <?php
                                        $link = get_field('social_link_1', 'option');
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                        ?>
                                        <a href="<?php echo esc_url($link_url); ?>" target="_blank">
                                            <svg class="icon">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#telegram" alt="telegram"></use>
                                            </svg>
                                           <?php echo esc_html($link_title); ?>
                                        </a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="contacts__page-social-item">
                                        <?php
                                        $link = get_field('social_link_2', 'option');
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                        ?>
                                        <a href="<?php echo esc_url($link_url); ?>" target="_blank">
                                            <svg class="icon">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#facebook" alt="facebook"></use>
                                            </svg>
                                           <?php echo esc_html($link_title); ?>
                                        </a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="contacts__page-social-item">
                                        <?php
                                        $link = get_field('social_link_3', 'option');
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                        ?>
                                        <a href="<?php echo esc_url($link_url); ?>" target="_blank">
                                            <svg class="icon">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#instagram" alt="instagram"></use>
                                            </svg>
                                           <?php echo esc_html($link_title); ?>
                                        </a>
                                        <?php endif; ?>
                                    </li>
                                   <li> 
                                        <a href="tel:<?php the_field('social_phone', 'option') ?>">
                                            <svg class="icon">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#phone" alt="phone"></use>
                                            </svg>
                                            <?php the_field('social_phone', 'option') ?>
                                       </a> 
                                    </li>
                                    <li> 
                                        <a href="mailto:<?php the_field('social_mail', 'option') ?>">
                                            <svg class="icon">
                                                <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#mail" alt="mail"></use>
                                            </svg>
                                            <?php the_field('social_mail', 'option') ?>
                                       </a> 
                                    </li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div>    
        </div> 
    </section>
</main>
<?php get_footer(); ?>
