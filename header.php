<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <title>It-volunteers</title>
</head>

<body>
    <div class="wrapper">
    <header class="header">
    <div class="header__container">
        <div class="header__body" id="">
            <div class="header__menu__container">
                <div class="header__menu__content">
                    <div class="header__menu__close-button">
                        <svg class="header__menu__icon">
                            <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#close"></use>
                        </svg>
                    </div>
                        <?php
                            $current_language = pll_current_language('name');
                            $menu_id = ($current_language == 'EN') ? 'header-menu-english' : (($current_language == 'УКР') ? 'header-menu' : 'header-menu-polish');
                            $menu_items = wp_get_nav_menu_items($menu_id);
                            $middle_index = ceil(8);
                                
                            $menu_left = array_slice($menu_items, 0, $middle_index);
                            $menu_last = array_key_last($menu_items);
                            $menu_right = array_slice($menu_items, $middle_index);

                            $inside_projects = false;
                                
                            echo '<ul class="header__first__list">';

                            foreach ($menu_left as $index => $menu_item) {
                            $current_class = (is_page($menu_item->object_id)) ? 'header__current__page' : '';
                            if ($index === 2) {
                                $inside_projects = true;
                                echo '<li class="header__menu__projects ' . esc_attr($current_class) . '"><div class="header__projects__content"><p>' . esc_html($menu_item->title) . '</p><svg class="header__projects__icon">
                                <use href="' . get_template_directory_uri() . '/assets/images/sprite.svg#icon-arrow-down"></use>
                                </svg></div>';
                                echo '<ul class="header__projects__menu">';
                                echo '<li class="header__projects__menu__item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">Усі ' . esc_html($menu_item->title) . '</a></li>';
                            }

                            if ($inside_projects && ($index >= 3 && $index <= 5)) {
                                if (is_singular()) {
                                    $current_post_id = get_queried_object_id();
                                    $current_class = ($current_post_id == $menu_item->object_id) ? 'header__current__page' : '';
                                }
                                echo '<li class="header__projects__menu__item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                            } elseif ($inside_projects && $index > 5) {
                                echo '</ul>';
                                $inside_projects = false;
                                echo '<li class="header__menu__item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                            } elseif($index !== 2) {
                                echo '<li class="header__menu__item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                            }
                        }

                            echo '</ul>';
                        ?>
                            <div class="header__logo">
                        <?php
                            if (has_custom_logo()) {
                                echo get_custom_logo();
                            }
                            ?>
                            </div>
                        <?php
                            echo '<ul class="header__second__list">';
                                foreach ($menu_right as $index => $menu_item) {
                                if ($index !== 2) {
                                    $current_class = (is_page($menu_item->object_id)) ? 'current_page_item' : '';
                                    echo '<li class="header__menu__item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                                } else {
                                    if (function_exists('pll_the_languages')) {
                                    $languages = pll_the_languages(array('show_names' => 1, 'show_flags' => 1, 'raw' => 1));
                                    echo '<li class="language__dropdown">';
                                    if (is_array($languages)) {
                                        foreach ($languages as $language) {
                                            if($current_language === $language['name']){
                                                echo '<p class="language__current">' . esc_attr($language['name']) . '</p>';
                                                echo ''.$language['flag'].'';
                                            }
                                        } 
                                        echo '<div class="language__dropdown__content">';
                                        foreach ($languages as $language) {
                                            if($current_language === $language['name']){
                                                echo '<div class="language__wrapper current"">';
                                                echo '<input class="language__input" type="radio" checked />';
                                                echo '<label class="language__label">'. esc_html($language['name']) .' '.$language['flag'].'</label>';
                                                echo '</div>';
                                            }
                                            else{
                                                echo '<a href="' . esc_url($language['url']) . '" class="language__wrapper">';
                                                echo '<input class="language__input" type="radio" onchange="redirectToPage(\'' . esc_url($language['url']) . '\')"/>';
                                                echo '<label class="language__label">'. esc_html($language['name']) .' '.$language['flag'].'</label>';
                                                echo '</a>';
                                            }
                                        }
                                            echo '</div>';
                                                    
                                        }
                                            echo '</li>';
                                        }
                                            
                                            echo '<li class="button secondary_button header__button ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                                        }
                                    }
                                echo '</ul>';
                        ?>
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