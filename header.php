<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title></title>
</head>

<body>
    <div class="wrapper">
    <header class="header">
        <div class="header__container">
               
                <div class="menu__body" id="">
                               <div class="menu__container">
                                    <div class="menu__content">
                                        <div class="menu__close-button"><svg class="menu__icon">
                                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#close"></use>
                            </svg></div>
                                    <?php wp_nav_menu([
                                            'theme_location'       => 'header',
                                            'container'            => false,
                                            'menu_class'           => 'menu__list',
                                            'menu_id'              => false,
                                            'echo'                 => true,
                                            'items_wrap'           => '<ul id="%1$s" class="header__first__list %2$s">%3$s</ul>',
                                        ]);
                                        ?>
                                        <div class="header__logo">
                                            <?php
                                            if (has_custom_logo()) {
                                                echo get_custom_logo();
                                            }
                                            ?>
                                        
                                        </div>
                            <ul class="header__second__list">
                                <li class="menu-item">
                                        <a href="<?php echo esc_attr(get_field('first-item-link', 'option') ); ?>"><?php the_field('first-item-name', 'option'); ?></a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?php echo esc_attr(get_field('last-item-link', 'option') ); ?>"><?php the_field('last-item-name', 'option'); ?></a>
                                    </li>
                                    <li>UKR</li>
                                    <li><a class="secondary_button button header__button" href="<?php echo esc_attr(get_field('header-button-link', 'option') ); ?>" >
                                        <?php the_field('header-button-name', 'option'); ?></a></li>
                            </ul>
                                    </div>
                               </div>
                               <div class="header__burger__logo">
                                            <?php
                                            if (has_custom_logo()) {
                                                echo get_custom_logo();
                                            }
                                            ?>
                                    
                                        </div>
                      <div class="burger">
                          <span></span>
                      </div>
                </div>
        </div>
    </header>