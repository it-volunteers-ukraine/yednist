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

    <header class="header" style="">
    <div class="header__container">
                <div class="menu__body" id="">
                               <div class="menu__container">
                                    <div class="menu__content">
                                        <div class="menu__close-button">
                                            <svg class="menu__icon">
                                <use href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#close"></use></svg>
                            </div>
                                <?php
                                $current_language = pll_current_language('name');
                                $menu_id = ($current_language == 'EN') ? 'header-menu-english' : $current_language === 'UK' ? 'header-menu' : 'header-menu-polish';
                                $menu_items = wp_get_nav_menu_items($menu_id);
                                $middle_index = ceil(5);
                                
                                $menu_left = array_slice($menu_items, 0, $middle_index);
                                $menu_last = array_key_last($menu_items);
                                $menu_right = array_slice($menu_items, $middle_index);
                                
                                echo '<ul class="header__first__list" style="display:flex;align-items: center;
                                width: 100%;
                                justify-content: space-between;">';
                                foreach ($menu_left as $menu_item) {
                                    $current_class = (is_page($menu_item->object_id)) ? 'current_page_item' : '';
                                    echo '<li class="menu-item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                                }
                                echo '</ul>';
                                ?>
                                 <div class="header__logo" style="justify-self: center;">
                                <?php
                                if (has_custom_logo()) {
                                    echo get_custom_logo();
                                }
                                ?>
                                </div>
                                <?php
                                echo '<ul class="header__second__list" style="display:flex;align-items: center;
                                width: 100%;
                                justify-content: space-between;">';
                                    foreach ($menu_right as $index => $menu_item) {
                                        if ($index !== 2) {
                                            $current_class = (is_page($menu_item->object_id)) ? 'current_page_item' : '';
                                            echo '<li class="menu-item ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                                        } else {
                                            if (function_exists('pll_the_languages')) {
                                                $languages = pll_the_languages(array('show_names' => 1, 'show_flags' => 1, 'raw' => 1));
                                                echo '<li class="language-dropdown">';
                                                if (is_array($languages)) {
                                                    foreach ($languages as $language) {
                                                        if($current_language === $language['name']){
                                                            echo '<p class="language__current">' . esc_attr($language['name']) . '</p>';
                                                            echo ''.$language['flag'].'';
                                                        }
                                                    } 
                                                        echo '<div class="language-dropdown-content">';
                                                        foreach ($languages as $language) {
                                                         if($current_language === $language['name']){
                                                            echo '<div class="language-wrapper current"">';
                                                             echo '<input type="radio" style="width: 16px;" checked />';
                                                             echo '<label class="language-label">'. esc_html($language['name']) .' '.$language['flag'].'</label>';
                                                             echo '</div>';
                                                         }
                                                         else{
                                                             echo '<a href="' . esc_url($language['url']) . '" class="language-wrapper">';
                                                             echo '<input type="radio" style="width: 16px;" />';
                                                             echo '<label class="language-label">'. esc_html($language['name']) .' '.$language['flag'].'</label>';
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