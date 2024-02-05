<?php
/*
Template Name: contacts
*/
get_header();
?>
<main>       
    <section class="section contacts__page"> 
        <div class="container">
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
                        <div class="contacts__page-image"><img src="<?php the_field('contacts__page-image'); ?>" alt="star"></div>
                        <div class="contacts__page-adress">
                            <h4 class="contacts__page-adress-title"><?php the_field('contacts-adress-title'); ?></h4>
                            <ul class="contacts__page-adress-list">
                                <li class="contacts__page-adress-item"><p class="contacts__page-adress-text">Option field</p></li>
                                <li class="contacts__page-adress-item"><p class="contacts__page-adress-text">Option field</p></li>
                                <li class="contacts__page-adress-item"><p class="contacts__page-adress-text">Option field</p></li>
                                <li class="contacts__page-adress-item"><p class="contacts__page-adress-text">Option field</p></li>
                            </ul>                            
                        </div>
                        <div class="contacts__page-social">
                            <ul class="contacts__page-social-list">
                                <li class="contacts__page-social-item">
                                    <a href="#" class="contacts__page-social-link">
                                        <svg class="icon">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#telegram" alt="telegram"></use>
                                        </svg>
                                        <p class="contacts__page-social-text">telegram Option field</p>
                                    </a>                                    
                                </li>  
                                <li>  
                                    <a href="#" class="contacts__page-social-link">
                                        <svg class="icon">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#facebook" alt="facebook"></use>
                                        </svg>
                                        <p class="contacts__page-social-text">facebook Option field</p>
                                    </a>                                     
                                </li> 
                                <li>                                     
                                    <a href="#" class="contacts__page-social-link">
                                        <svg class="icon">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#instagram" alt="instagram"></use>
                                        </svg> 
                                        <p class="contacts__page-social-text">instagram Option field</p>
                                    </a>
                                </li> 
                                <li>  
                                    <a href="#" class="contacts__page-social-link">
                                        <svg class="icon">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#phone" alt="phone"></use>
                                        </svg>
                                        <p class="contacts__page-social-text">phone Option field</p>
                                    </a>                                    
                                </li>
                                <li> 
                                    <a href="#" class="contacts__page-social-link">
                                        <svg class="icon">
                                            <use xlink:href="<?php bloginfo('template_url'); ?>/assets/images/sprite.svg#mail" alt="mail"></use>
                                        </svg>
                                        <p class="contacts__page-social-text">mail Option field</p>
                                    </a> 
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </section>
</main>
<?php get_footer(); ?>
