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
  wp_enqueue_style('choices-style', "https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css", array('main'));

  wp_enqueue_script('swiper-scripts', 'https://cdn.jsdelivr.net/npm/swiper@10.0.0/swiper-bundle.min.js', array(), false, true);
  wp_enqueue_script( 'wp-it-volunteers-scripts', get_template_directory_uri() . '/assets/scripts/main.js', array(), false, true );  
  wp_enqueue_script('choices-scripts', 'https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js', array(), false, true);
  //wp_enqueue_script('imask-scripts', 'https://unpkg.com/imask', array(), false, true);

    if ( is_page_template('templates/home.php') ) {
        wp_enqueue_style( 'home-style', get_template_directory_uri() . '/assets/styles/template-styles/home.css', array('main') );
        wp_enqueue_script( 'jquery-scripts', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), false, true );
        wp_enqueue_script( 'touch-swipe-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js', array(), false, true );
        wp_enqueue_script( 'home-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/home.js', array('touch-swipe-scripts'), false, true );
    }

    if ( is_page_template('templates/about.php') ) {
        wp_enqueue_style( 'about-style', get_template_directory_uri() . '/assets/styles/template-styles/about.css', array('main') );
        wp_enqueue_script( 'about-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/about.js', array(), false, true );
    }

    if ( is_page_template('templates/contacts.php') ) {
        wp_enqueue_style( 'contacts-style', get_template_directory_uri() . '/assets/styles/template-styles/contacts.css', array('main') );
        wp_enqueue_script( 'contacts-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/contacts.js', array(), false, true );
    }

    if ( is_page_template('templates/projects.php') ) {
      wp_enqueue_style( 'projects-style', get_template_directory_uri() . '/assets/styles/template-styles/projects.css', array('main') );
  }

    if ( is_page_template('templates/partners.php')) {
        wp_enqueue_style( 'partners-style', get_template_directory_uri() . '/assets/styles/template-styles/partners.css',array('main'));
    }


    if ( is_page_template('templates/team.php')) {
        wp_enqueue_style( 'team-style', get_template_directory_uri() . '/assets/styles/template-styles/team.css',array('main'));
        wp_enqueue_script( 'team-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/team.js', array(), false, true );
    }
    

    if ( is_page_template('templates/gallery-post.php') ) {
      wp_enqueue_style( 'gallery-post-style', get_template_directory_uri() . '/assets/styles/template-styles/gallery-post.css', array('main') );
      wp_enqueue_script( 'gallery-post-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/gallery-post.js', array(), false, true );
      wp_enqueue_script( 'fslightbox-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/fslightbox.js', array(), false, true );
    }

    if ( is_page_template('templates/boarding-school.php') ) {
      wp_enqueue_style( 'boarding-school-style', get_template_directory_uri() . '/assets/styles/template-styles/boarding-school.css', array('main') );
      wp_enqueue_script( 'boarding-school-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/boarding-school.js', array(), false, true );
    }
    
    if ( is_page_template('templates/fioh-team.php') ) {
      wp_enqueue_style( 'fioh-team-style', get_template_directory_uri() . '/assets/styles/template-styles/fioh-team.css', array('main') );
      wp_enqueue_script( 'fioh-team-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/fioh-team.js', array(), false, true );
    }
    if ( is_page_template('templates/support.php') ) {
      wp_enqueue_style( 'support-style', get_template_directory_uri() . '/assets/styles/template-styles/support.css', array('main') );
      wp_enqueue_script( 'jquery-scripts', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), false, true );
      wp_enqueue_script( 'support-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/support.js', array('jquery-scripts'), false, true );
      wp_localize_script( 'support-scripts', 'support', array(
        'url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('support_nonce'),
    ));
    }

    if ( is_page_template('templates/schedule.php') ) {
        wp_enqueue_style( 'schedule-style', get_template_directory_uri() . '/assets/styles/template-styles/schedule.css', array('main') );
        wp_enqueue_script( 'jquery-scripts', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), false, true );
        wp_enqueue_script( 'touch-swipe-scripts', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js', array(), false, true );
        wp_enqueue_script( 'schedule-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/schedule.js', array('touch-swipe-scripts'), false, true );
        wp_localize_script( 'schedule-scripts', 'uri_object', array(
        'theme_directory_uri' => get_template_directory_uri(),
        'hide_btn'=> get_field("hide_btn", "option"),
        'read_btn'=> get_field("read_btn", "option")
        ));
        
    }

    if ( is_page_template('templates/multicenter.php') ) {
      wp_enqueue_style( 'multicenter-style', get_template_directory_uri() . '/assets/styles/template-styles/multicenter.css', array('main') );
      wp_enqueue_script( 'jquery-scripts', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), false, true );
      wp_enqueue_script( 'multicenter-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/multicenter.js', array('jquery-scripts'), false, true );
      wp_localize_script( 'multicenter-scripts', 'multicenter_ajax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('multicenter_nonce'),
        'theme_directory_uri' => get_template_directory_uri(),
        'hide_btn'=> get_field("hide_btn", "option"),
        'read_btn'=> get_field("read_btn", "option")
      ));
    }

    if ( is_page_template('templates/new-project.php') ) {
      wp_enqueue_style( 'new-project-style', get_template_directory_uri() . '/assets/styles/template-styles/new-project.css', array('main') );
    }

    if (is_singular() && locate_template('template-parts/swiper-navigation.php')) {
    wp_enqueue_style('swiper-navigation-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/swiper-navigation.css', array('main'));
  }

    if (is_singular() && locate_template('template-parts/slider.php')) {
      wp_enqueue_style('slider-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/slider.css', array('main'));
      wp_enqueue_script( 'slider-scripts', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/slider.js', array(), false, true );
    }

    if (is_singular() && locate_template('template-parts/projects-list.php')) {
      wp_enqueue_style('projects-list-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/projects-list.css', array('main'));
      wp_enqueue_script( 'projects-list-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/projects-list.js', array(), false, true );

    }

    if (is_singular() && locate_template('template-parts/feedback-posts.php')) {
      wp_enqueue_style('feedback-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/feedback-posts.css', array('main'));
      wp_enqueue_script('feedback-page-scripts', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/feedback-posts.js', array('home-scripts'), false, true);
      wp_localize_script('feedback-page-scripts', 'myAjax', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('feedbacks_nonce'),
            'hide_btn'=> get_field("hide_btn", "option"),
            'read_btn'=> get_field("read_more_btn", "option")
          ));
    }

    if (is_singular() && locate_template('template-parts/address.php')) {
      wp_enqueue_style('address', get_template_directory_uri() . '/assets/styles/template-parts-styles/address.css', array('main'));
    }

    if (is_singular() && locate_template('template-parts/feedback-form.php')) {
      wp_enqueue_style('feedback-form', get_template_directory_uri() . '/assets/styles/template-parts-styles/feedback-form.css', array('main'));
      wp_enqueue_script( 'feedback-form-scripts', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/feedback-form.js', array('home-scripts'), false, true );
    }

    if (is_singular() && locate_template('template-parts/feedback-nav.php')) {
      wp_enqueue_style('feedback-nav', get_template_directory_uri() . '/assets/styles/template-parts-styles/feedback-nav.css', array('main'));
    }
    
    if (is_singular() && locate_template('template-parts/one-comment.php')) {
      wp_enqueue_style('one-comment', get_template_directory_uri() . '/assets/styles/template-parts-styles/one-comment.css', array('main'));
    }

    if (is_singular() && locate_template('template-parts/one-activity.php')) {
      wp_enqueue_style('one-activity', get_template_directory_uri() . '/assets/styles/template-parts-styles/one-activity.css', array('main'));
    }

    if (is_singular() && locate_template('template-parts/loader.php')) {
      wp_enqueue_style('loader-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/loader.css', array('main'));
    }
    if (is_singular() && locate_template('template-parts/one-activity-row.php')) {
      wp_enqueue_style('activity-row', get_template_directory_uri() . '/assets/styles/template-parts-styles/one-activity-row.css', array('main'));
    }
    if (is_singular() && locate_template('template-parts/activity-buttons.php')) {
      wp_enqueue_style('activity-buttons', get_template_directory_uri() . '/assets/styles/template-parts-styles/activity-buttons.css', array('main'));
    }
    if (is_singular() && locate_template('template-parts/custom-nav.php')) {
      wp_enqueue_style('custom-nav', get_template_directory_uri() . '/assets/styles/template-parts-styles/custom-nav.css', array('main'));
    }
    if (is_singular() && locate_template('template-parts/breadcrumbs.php')) {
      wp_enqueue_style('breadcrumbs', get_template_directory_uri() . '/assets/styles/template-parts-styles/breadcrumbs.css', array('main'));
    }
    if (is_singular() && locate_template('template-parts/activity-details.php')) {
      wp_enqueue_style('activity-details', get_template_directory_uri() . '/assets/styles/template-parts-styles/activity-details.css', array('main'));
      wp_enqueue_script( 'activity-details', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/activity-details.js', array('schedule-scripts'), false, true );
      wp_localize_script('activity-details', 'activity', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('activity_nonce'),
        ));
    }
    if (is_singular() && locate_template('template-parts/one-news.php')) {
      wp_enqueue_style('one-news-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/one-news.css', array('main'));
      wp_enqueue_script( 'one-news-script', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/one-news.js', array('schedule-scripts'), false, true );
      wp_localize_script('one-news-script', 'news', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('news_nonce'),
        ));
    }    
    if (is_singular() && locate_template('template-parts/gallery-mobile.php')) {
      wp_enqueue_style('gallery-mobile-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/gallery-mobile.css', array('main'));
      wp_enqueue_script( 'gallery-mobile-scripts', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/gallery-mobile.js', array(), false, true );
    }
    if (is_singular() && locate_template('template-parts/about-history.php')) {
      wp_enqueue_style('about-history-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/about-history.css', array('main'));
      wp_enqueue_script( 'about-history-scripts', get_template_directory_uri() . '/assets/scripts/template-parts-scripts/about-history.js', array(), false, true );
    }
    if ( is_singular() && locate_template('templates/multicenter.php') ) {
      wp_enqueue_style( 'multicenter-style', get_template_directory_uri() . '/assets/styles/template-styles/multicenter.css', array('main') );
      wp_enqueue_script( 'jquery-scripts', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), false, true );
      wp_enqueue_script( 'multicenter-scripts', get_template_directory_uri() . '/assets/scripts/template-scripts/multicenter.js', array('jquery-scripts'), false, true );
      wp_localize_script( 'multicenter-scripts', 'multicenter_ajax', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('multicenter_nonce'),
        'theme_directory_uri' => get_template_directory_uri(),
        'hide_btn'=> get_field("hide_btn", "option"),
        'read_btn'=> get_field("read_btn", "option")
      ));
    }
      if ( is_singular() && locate_template('template-parts/one-class.php') ) {
      wp_enqueue_style( 'one-class-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/one-class.css', array('main') );
    }  
      if ( is_singular() && locate_template('template-parts/support-details-btns.php') ) {
      wp_enqueue_style( 'support-btns-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/support-details-btns.css', array('main') );
    }  
    if ( is_singular() && locate_template('template-parts/one-project.php') ) {
      wp_enqueue_style( 'one-project-style', get_template_directory_uri() . '/assets/styles/template-parts-styles/one-project.css', array('main') );
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


/*** AJAX feedbacks */
add_action('wp_ajax_load_feedbacks', 'load_feedbacks');
add_action('wp_ajax_nopriv_load_feedbacks', 'load_feedbacks');

function load_feedbacks() {
  // Перевірка nonce
  if (!isset($_POST["nonce"]) || !wp_verify_nonce($_POST["nonce"], "feedbacks_nonce")) {
    exit;
  }
  
  // Отримання параметрів з AJAX-запиту
  $page = $_POST['page'];
  $width = $_POST['width'];
  
  // Визначення кількості постів на сторінку залежно від ширини
  $number = get_feedbacks_per_page($width);

  // Отримання загальної кількості постів та кількості сторінок
  $total_posts = wp_count_posts('feedbacks')->publish;
  $total_pages = ceil($total_posts / $number);

  // Побудова запиту для отримання постів
  $args = array(
    'post_type' => 'feedbacks',
    'posts_per_page' => $number,
    'orderby' => 'modified',
    'paged' => $page,
    'post_status' => 'publish'
  );

  $query = new WP_Query($args);
  ob_start();
  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>
<?php get_template_part('template-parts/one-comment'); ?>
<?php endwhile;
  endif;

  $html = ob_get_clean();
  wp_reset_postdata();

  // Відправка відповіді JSON з HTML та кількістю сторінок
  wp_send_json(array('html' => $html, 'totalPages' => $total_pages));
  wp_die();
}

// Визначення кількості постів на сторінку залежно від ширини
function get_feedbacks_per_page($width) {
  if ($width > 1349.98) {
    return 6;
  } elseif ($width > 767.98) {
    return 4;
  } else {
    return 1;
  }
}


// AJAX for writing reviews into CPT "Feedbacks"
add_action('wp_ajax_do_insert', 'do_insert');
add_action('wp_ajax_nopriv_do_insert', 'do_insert');

function do_insert() {
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['do_insert_nonce'] ) && wp_verify_nonce( $_POST['do_insert_nonce'], 'do_insert_action' ) ) {

        if (empty($_POST['title']) || !preg_match('/^[^\d]+$/', $_POST['title'])) {
            wp_send_json_error( 'Please enter a valid title.' ); 
        }

        if (empty($_POST['email']) || !preg_match('/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/', $_POST['email'])) {
            wp_send_json_error( 'Please enter a valid email address.' ); 
        }

        if (empty($_POST['description']) || empty($_POST['programs'])) {
            wp_send_json_error( 'Please fill all necessary fields.' ); 
        }
        

        $post = array(
            'post_title'    => $_POST['title'],
            'post_content'  => $_POST['description'],
            'post_status'   => 'pending',
            'post_type'     => 'feedbacks'
        );

        $post_id = wp_insert_post($post);
            
        if ($post_id) {

            update_field('your_email', $_POST['email'], $post_id);

            $author_role = !empty($_POST['case']) ? $_POST['case'] : $_POST['programs'];
            update_field('author_role', $author_role, $post_id);
            
            wp_send_json_success( 'Post added successfully!' );
        } else {
            wp_send_json_error( 'Failed to add post.' );
        }
    }
}


// ajax activity details
add_action('wp_ajax_get_post_activity', 'get_post_activity');
add_action('wp_ajax_nopriv_get_post_activity', 'get_post_activity');

function get_post_activity() {

    if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'activity_nonce' ) ) {
        wp_send_json_error( 'Nonce verification failed' );
    }

    if (isset($_POST['postId'])) {

      $post = get_post($_POST['postId']);

      $res = [
      'status' => false,
      'html' => ''
      ];

      if($post){
      ob_start();
      get_template_part( 'template-parts/activity-details', null, ['post' => $post]);
      $html = ob_get_clean();

      $res = [
      'status' => true,
      'html' => $html
      ];

      wp_send_json($res);
      }}

    wp_die();
}


// news ajax
add_action('wp_ajax_load_initial_news', 'load_initial_news');
add_action('wp_ajax_nopriv_load_initial_news', 'load_initial_news');

function load_initial_news() {
    if (!isset($_POST["nonce"]) || !wp_verify_nonce($_POST["nonce"], "news_nonce")) {
        exit;
    }

    $order = !empty($_POST['order']) ? $_POST['order'] : 'DESC';
    $paged = !empty($_POST['paged']) ? $_POST['paged'] : 1;
    $lang = !empty($_POST['lang']) ? $_POST['lang'] : 'uk';

    if ($_POST['prev_order'] && $_POST['prev_order'] !== $order) {
        $paged = 1;
    }

    $args = array(
        'post_type'      => 'news',
        'posts_per_page' => 5,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => $order,
        'post_status'    => 'publish',
        'lang' => $lang,
    );

    $query = new WP_Query($args);
    
    $posts_count = $query->found_posts; 
    $max_pages = ceil($posts_count / 5);

    ob_start();
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/one-news');
        endwhile;
    endif;

    $html = ob_get_clean();
    wp_reset_postdata();

    wp_send_json(array('html' => $html, 'max_pages' => $max_pages, 'paged' => $paged));
    wp_die();
}

// multicenter ajax
add_action('wp_ajax_load_classes', 'load_classes');
add_action('wp_ajax_nopriv_load_classes', 'load_classes');

function load_classes() {
    if (!isset($_POST["nonce"]) || !wp_verify_nonce($_POST["nonce"], "multicenter_nonce")) {
        exit;
    }

    $active_cat = !empty($_POST['active_cat']) ? $_POST['active_cat'] : 'for_all';
    $paged = !empty($_POST['paged']) ? $_POST['paged'] : 1;

    if ($_POST['prev_active_cat'] && $_POST['prev_active_cat'] !== $active_cat) {
        $paged = 1;
    }

    $args = array(
        'post_type'      => 'activities',
        'posts_per_page' => 5,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
        'tax_query'      => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy'=> 'activities-categories',
                        'field' => 'slug',
                        'terms' => 'constant_activities',
                    ),
                    array(
                        'taxonomy'=> 'activities-target',
                        'field' => 'slug',
                        'terms' => $active_cat,
                    )
                )
    );

    $query = new WP_Query($args);
    $posts_count = $query->found_posts; 

    $max_pages = ceil($posts_count / 5);
    ob_start();
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/one-class');
        endwhile;
    endif;

    $html = ob_get_clean();
    wp_reset_postdata();

    wp_send_json(array('html' => $html, 'max_pages' => $max_pages, 'paged' => $paged));
    wp_die();
}


add_action( 'activities-target_add_form_fields', 'activities_target_add_term_fields', 10, 2 );

function activities_target_add_term_fields( $term ) {
	// get meta data value
	$text_field = get_term_meta( $term->term_id, 'order_number', true );

	?>
<div class="form-field">
  <label for="order_number">Приорітетність</label>
  <input type="number" name="order_number" id="order_number" />
  <p>Додайте порядковий номер, який відповідає тому, в якому порядку будуть знаходитись категорії на сторінці
    "Мультикультурний центр"</p>
</div>
<?php
}

add_action( 'created_activities-target', 'activities_target_save_term_fields' );
add_action( 'edited_activities-target', 'activities_target_save_term_fields' );
function activities_target_save_term_fields( $term_id ) {
	
	update_term_meta(
		$term_id,
		'order_number',
		sanitize_text_field( $_POST[ 'order_number' ] )
	);
}





// change the breadcrumbs title for home page
add_filter('bcn_breadcrumb_title', 'my_breadcrumb_title_swapper', 3, 10);
function my_breadcrumb_title_swapper($title, $type, $id)
{
    if(in_array('home', $type))
    { if(function_exists('pll__')) {
      $title = pll__('Головна');
    }
    }
    return $title;
}

//change the breadcrumbs url for home page
add_filter('bcn_breadcrumb_url', 'bcn_breadcrumb_url_swapper', 3, 10);
function bcn_breadcrumb_url_swapper($url, $type, $id)
{
    if (in_array('home', $type)) {
        if (function_exists('pll_current_language')) {
            $my_lang = pll_current_language();
            if ($my_lang == 'en') { 
                $url = '/home-en/';
            }
            if ($my_lang == 'pl') { 
                $url = '/home-pl/';
            }
        }
    }
    return $url;
}

//support repeater fields
add_action('wp_ajax_support', 'support');
add_action('wp_ajax_nopriv_support', 'support');

function support() {
    if (!isset($_POST["nonce"]) || !wp_verify_nonce($_POST["nonce"], "support_nonce")) {
        exit;
    }

    if (isset($_POST['current_index'])) {
        $current_index = $_POST['current_index'];

        $fields = get_field('money_support_type', "options");
        $current_field = $fields[$current_index-1];

        ob_start();

        if ($current_field) :
            $rows = $current_field['fields'];
            if ($rows) { 
                foreach ($rows as $row) { 
                    get_template_part('template-parts/support-details', null,  array('row' => $row));
                }
            } 
        endif;

        if ($current_field['paypal']) { 
            get_template_part('template-parts/support-details-btns');
        }

        $html = ob_get_clean();
        wp_reset_postdata();

        wp_send_json(array('html' => $html));
        wp_die();
    }
}

// additional form validation
add_filter('wpcf7_validate_text*', 'custom_text_validation_filters', 20, 2);

function custom_text_validation_filters($result, $tag)
{
    $fields = array(
        'invite_name',
        'text-name'
    );

    foreach ($fields as $field) {
        if ($field === $tag->name) {
            $value = isset($_POST[$field]) ? trim($_POST[$field]) : '';

            if (!$value) {
                $result->invalidate($tag, wpcf7_get_message('validation_error'));
            }
        }
    }

    return $result;
}

add_filter('wpcf7_validate_textarea*', 'custom_textarea_confirmation_validation_filter', 20, 2);

function custom_textarea_confirmation_validation_filter($result, $tag)
{
    $fields = array(
        'invite_message',
        'message'
    );

    foreach ($fields as $field) {
        if ($field === $tag->name) {
            $value = isset($_POST[$field]) ? trim($_POST[$field]) : '';

            if (!$value) {
                $result->invalidate($tag, wpcf7_get_message('validation_error'));
            }
        }
    }

    return $result;
}