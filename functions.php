<?php
if ( ! function_exists('wp_it_volunteers_setup')) {
    function wp_it_volunteers_setup() {
        add_theme_support( 'custom-logo',
            array(
                'height'      => 64,
                'width'       => 64,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
        add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'wp_it_volunteers_setup' );
}

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'wp_it_volunteers_scripts' );

function wp_it_volunteers_scripts() {
  wp_enqueue_style( 'main', get_stylesheet_uri() );
  wp_enqueue_style( 'wp-it-volunteers-style', get_template_directory_uri() . '/assets/styles/main.css', array('main') );
  wp_enqueue_style('swiper-style', "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css", array('main'));

  wp_enqueue_script( 'wp-it-volunteers-scripts', get_template_directory_uri() . '/assets/scripts/main.js', array(), false, true );
  wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@10.0.0/swiper-bundle.min.js', array(), false, true);

    if ( is_page_template('templates/home.php') ) {
        wp_enqueue_style( 'home-style', get_template_directory_uri() . '/assets/styles/template-styles/home.css', array('main') );
        wp_enqueue_script( 'home-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/home.js', array(), false, true );
    }

    if ( is_page_template('templates/about.php') ) {
        wp_enqueue_style( 'about-style', get_template_directory_uri() . '/assets/styles/template-styles/about.css', array('main') );
        wp_enqueue_script( 'about-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/about.js', array(), false, true );
    }

    if ( is_page_template('templates/contacts.php') ) {
        wp_enqueue_style( 'contacts-style', get_template_directory_uri() . '/assets/styles/template-styles/contacts.css', array('main') );
        wp_enqueue_script( 'contacts-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/contacts.js', array(), false, true );
    }


    if ( is_page_template('templates/partners.php')) {
        wp_enqueue_style( 'partners-style', get_template_directory_uri() . '/assets/styles/template-styles/partners.css',array('main'));
    }

    if (is_singular() && locate_template('template-parts/swiper-navigation.php')) {
    wp_enqueue_style('swiper-navigation-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/swiper-navigation.css', array('main'));
  }

    if (is_singular() && locate_template('template-parts/swiper-pagination.php')) {
      wp_enqueue_style('swiper-pagination-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/swiper-pagination.css', array('main'));
    }
    
    if (is_singular() && locate_template('template-parts/feedback-posts.php')) {
      wp_enqueue_style('feedback-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/feedback-posts.css', array('main'));
    }

    if (is_singular() && locate_template('template-parts/address.php')) {
      wp_enqueue_style('address', get_template_directory_uri() . '/assets/styles/template-parts-styles/address.css', array('main'));
    }

    if (is_singular() && locate_template('template-parts/feedback-form.php')) {
      wp_enqueue_style('feedback-form', get_template_directory_uri() . '/assets/styles/template-parts-styles/feedback-form.css', array('main'));
      wp_enqueue_script( 'feedback-form-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/feedback-form.js', array(), false, true );
    }

}
/** add fonts */
function add_google_fonts() {
  wp_enqueue_style( 'google_web_fonts', 'https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;900&family=Fira+Sans+Extra+Condensed:ital,wght@0,200;0,300;0,400;0,500;1,400&display=swap', [], null );
}

add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

/** Register menus */
function wp_it_volunteers_menus() {
    $locations = array(
        'header' => __( 'Header Menu', 'wp-it-volunteers' ),
        'footer' => __( 'Footer Menu', 'wp-it-volunteers' ),
    );

    register_nav_menus( $locations );
}

add_action( 'init', 'wp_it_volunteers_menus');


/** ACF add options page */
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
}