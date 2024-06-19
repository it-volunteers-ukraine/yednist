<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <title>It-volunteers</title>
</head>

<body <?php body_class(); ?>>
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
              <ul class="header__first__list">
                <?php
                $current_language = (function_exists('pll_current_language')) ? pll_current_language('name') : '';
                $menu_id = ($current_language == 'EN') ? 'header-menu-english' : (($current_language == 'УКР') ? 'header-menu-ukrainian' : 'header-menu-polski');
                $menu_items = wp_get_nav_menu_items($menu_id);
                $middle_index = ceil(6);
                $menu_left = array_slice($menu_items, 0, $middle_index);
                $menu_right = array_slice($menu_items, $middle_index);

                foreach ($menu_left as $index => $menu_item) {
                    $current_class = (is_page($menu_item->object_id)) ? ' header__current__page' : '';
                    $current_post_id = get_queried_object_id();
                    $gallery_title = ($current_language == 'EN') ? 'Gallery' : (($current_language == 'УКР') ? 'Галерея' : 'Galeria');
                    $projects_title = ($current_language == 'EN') ? 'Projects' : (($current_language == 'УКР') ? 'Проєкти' : 'Projekty');
                    $aboutus_title = ($current_language == 'EN') ? 'About us' : (($current_language == 'УКР') ? 'Про нас' : 'O nas');
                    $team_title = ($current_language == 'EN') ? 'Team' : (($current_language == 'УКР') ? 'Команда' : 'Zespół');

                    $parent_slug = ($current_language == 'EN') ? 'projects-en' : (($current_language == 'УКР') ? 'projects-uk' : 'projects-pl');
                    $parent_page = get_page_by_path($parent_slug);
                    $child_pages = get_pages(array(
                        'child_of' => $parent_page->ID,
                        'sort_column' => 'post_date',
                        'sort_order' => 'DESC'
                    ));
                  if ($menu_item->title === $gallery_title) {
                    if(is_category(($current_language == 'EN') ? 'gallery-en' : (($current_language == 'УКР') ? 'gallery' : 'gallery-pl'))){
                      $current_class .= ' header__current__page';
                    }
                    if(get_post_type($current_post_id) === 'post'){
                      $current_class .= ' header__current__page';
                    }
                  }
                  if ($menu_item->title === $projects_title) {
                    echo '<li class="header__menu__projects ' . esc_attr($current_class) . '"><div class="header__projects__content"><p>' . esc_html($menu_item->title) . '</p><svg class="header__projects__icon"><use href="' . get_template_directory_uri() . '/assets/images/sprite.svg#icon-arrow-down"></use></svg></div><ul class="header__projects__menu"><li class="header__projects__menu__item ' . esc_attr((is_page($menu_item->object_id)) ? ' header__current__page' : '') . '"><a href="' . esc_url($menu_item->url) . '">' . (($current_language == 'EN') ? 'All' : (($current_language == 'УКР') ? 'Усі' : 'Wszystkie')) . ' <span class="header__projects__menu__item__text">' . esc_html($menu_item->title) . '</span></a></li>';
                    foreach ($child_pages as $child_page) {
                      $child_current_class = (is_page($child_page->ID)) ? ' header__current__page' : '';
                      echo '<li class="header__projects__menu__item' . esc_attr($child_current_class) . '"><a href="' . esc_url(get_permalink($child_page->ID)) . '">' . esc_html($child_page->post_title) . '</a></li>';
                    }
                    echo '</ul></li>';
                  } else if($index >= 1 && $index <= 3){
                    if($menu_item->title === $aboutus_title){
                      echo '<li class="header__menu__about ' . esc_attr($current_class) . '"><div class="header__about__content"><p>' . esc_html($menu_item->title) . '</p><svg class="header__about__icon"><use href="' . get_template_directory_uri() . '/assets/images/sprite.svg#icon-arrow-down"></use></svg></div>';
                    }
                    if ($index >= 1 && $index <= 3) {
                      echo '<ul class="header__about__menu">';
                      foreach ($menu_items as $sub_menu_item) {
                          if ($sub_menu_item->title === $team_title || $sub_menu_item->title === $gallery_title || $sub_menu_item->title === $aboutus_title) {
                              $current_sub_class = (is_page($sub_menu_item->object_id)) ? ' header__current__page' : '';
                              echo '<li class="header__about__menu__item ' . esc_attr($current_sub_class) . '"><a href="' . esc_url($sub_menu_item->url) . '">' . esc_html($sub_menu_item->title) . '</a></li>';
                          }
                      }
                      echo '</ul>';
                  }
                    echo '</li>';
                  } else {
                    echo '<li class="header__menu__item' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                  }
                }

                ?>
              </ul>
              <div class="header__logo">
                <?php
                    if (has_custom_logo()) {
                        echo get_custom_logo();
                    }
                    ?>
              </div>
              <ul class="header__second__list">
                <?php
                  $menu_right_count = count($menu_right);

                  foreach ($menu_right as $index => $menu_item) {
                      $current_class = (is_page($menu_item->object_id)) ? ' header__current__page' : '';
                      if ($index === 3) {
                        if ( class_exists( 'WooCommerce' ) ) {
                          echo '<li class="header__menu__item cart"><a class="cart-contents" href="' . esc_url( wc_get_cart_url() ) . '" ><svg class="header__menu__item__cart"><use href="' . get_template_directory_uri() . '/assets/images/sprite.svg#icon-shopping-bag"></use></svg><span class="header__menu__item__cart-count ' . (WC()->cart->get_cart_contents_count() > 0 ? 'visible' : '') . '">' . WC()->cart->get_cart_contents_count() . '</span></a>
                         </li>';
                        }
                        echo '<li class="button primary-button header__button ' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                    } else if ($index !== 2){
                        echo '<li class="header__menu__item' . esc_attr($current_class) . '"><a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
                      } else if($index === 2) {
                        if (function_exists('pll_the_languages')) {
                            $languages = pll_the_languages(array('show_names' => 1, 'show_flags' => 1, 'raw' => 1));
                            echo '<li class="language__dropdown">';
                            if (is_array($languages)) {
                                foreach ($languages as $language) {
                                    if ($current_language === $language['name']) {
                                        echo '<p class="language__current">' . esc_attr($language['name']) . '</p> ' . $language['flag'] . '';
                                    }
                                }
                                echo '<div class="language__dropdown__content">';
                                foreach ($languages as $language) {
                                    if ($current_language === $language['name']) {
                                        echo '<div class="language__wrapper current"><input class="language__input" type="radio" checked /><label class="language__label">' . esc_html($language['name']) . ' ' . $language['flag'] . '</label></div>';
                                    } else {
                                        echo '<a href="' . esc_url($language['url']) . '" class="language__wrapper"><input class="language__input" type="radio" onchange="redirectToPage(\'' . esc_url($language['url']) . '\')"/><label class="language__label">' . esc_html($language['name']) . ' ' . $language['flag'] . '</label></a>';
                                    }
                                }
                                echo '</div>';
                            }
                            echo '</li>';
                        }
                    }
                    
                  }
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