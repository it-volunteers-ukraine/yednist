<?php

// add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 5,
        ),
    ) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
function my_theme_wrapper_start() {
  echo '<main>';
}
function my_theme_wrapper_end() {
  echo '
  <section class="about__documents section">
    <div class="container">
      <h2 class="section-title">';
      the_field('shop_documents_title', 'options');
      echo '</h2>
      <div class="inner-container">
        <div class="about__documents-body">
          <div class="about__documents-part">
            <div class="about__documents-content">';
            $rows = get_field('shop_documents', 'options');                            
            if (!empty($rows)) : 
                foreach ($rows as $row):
                    $name = $row['doc__link__name'];
                    $file = $row['doc__file'];
                    $image = $row['doc__img'];
                    if(!empty($file)):
              echo '<a target="_blank" href="';
              echo $file['url'];
              echo '" >
                <div class="about__documents-name">
                  <div class="about__documents-img">';
                  echo wp_get_attachment_image( $image, 'full' );
                  echo '</div>
                  <div class="about__documents-text">
                    <p>';
                    echo wp_html_excerpt( $name, 25, '...' );
                    echo '</p>
                  </div>
                </div>
              </a>';
              endif;
              endforeach;
              endif;
            echo '</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </main>';
}

// add custom page title
add_action('woocommerce_show_page_title', 'custom_title_woocommerce', 10);

function custom_title_woocommerce() {
    echo '
    <div class="container">
      <div class="inner-container">';
        echo '
        <h1 class="page-title">';
        the_field('shop_title', 'option');
        echo '</h1>
      </div>
    </div>';
}

// add container
add_action('woocommerce_before_shop_loop', 'catalog_wrapper_start', 10);
add_action('woocommerce_after_shop_loop', 'catalog_wrapper_end', 10);

function catalog_wrapper_start() {
    echo '
    <section class="section shop-section">
      <div class="container">
        <div class="inner-container">';
}

function catalog_wrapper_end() {
    echo '
        </div>
      </div>
    </section>';
}

// remove add to cart message on the top of the page
add_filter( 'wc_add_to_cart_message_html', 'tb_remove_added_to_cart_message' );
function tb_remove_added_to_cart_message( $message ){
 return '';
}
                 
//remove sort
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//remove items count
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);

// display product tags
add_action( 'woocommerce_after_shop_loop_item_title', 'display_product_tags', 15 );

function display_product_tags() {
    global $product;

    $tags = wp_get_post_terms( $product->get_id(), 'product_tag' );

    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
        $tag_slug = $tags[0]->slug;

        $tag_names = wp_list_pluck( $tags, 'name' );
        $tag_list = implode( ', ', $tag_names );
        echo '<span class="product-tag ';
        if($tag_slug == 'in_progress-uk' || $tag_slug == 'in_progress-en' || $tag_slug == 'in_progress-pl') echo "in-progress";
        echo '">' . esc_html( $tag_list ) . '</span>';
    }
}

// custom button text
add_filter('woocommerce_product_single_add_to_cart_text', 'filter_woocommerce_product_single_add_to_cart_text', 10, 2);
add_filter('woocommerce_product_add_to_cart_text', 'filter_woocommerce_product_single_add_to_cart_text', 10, 2);

function filter_woocommerce_product_single_add_to_cart_text($text, $instance) {
    global $product;

    if (!$product) {
        if ($instance && is_a($instance, 'WC_Product')) {
            $product = $instance;
        } else {
            return $text;
        }
    }

    $tags = wp_get_post_terms($product->get_id(), 'product_tag');

    if (!empty($tags) && !is_wp_error($tags)) {
        $tag_slug = $tags[0]->slug;
    } else {
        $tag_slug = '';
    }

    if ($tag_slug == 'in_progress-uk' || $tag_slug == 'in_progress-en' || $tag_slug == 'in_progress-pl') {
        $text = get_field('order_button', 'options');
    } else {
        $text = get_field('buy_button', 'options');
    }

    return $text;
}

function add_contact_us_button() {
  $current_language = pll_current_language();

  if ( $current_language == 'uk' ) {
      // UKR ver
      $contact_page_url = get_permalink( get_page_by_path( 'contacts-uk' ) );
      $button_text = 'Зв\'язатися з нами';
  } elseif ( $current_language == 'en' ) {
      // English ver
      $contact_page_url = get_permalink( get_page_by_path( 'contacts-pl' ) );
      $button_text = 'Contact Us';
  } elseif ( $current_language == 'pl' ) {
      // Polish ver
      $contact_page_url = get_permalink( get_page_by_path( 'contacts-pl' ) );
      $button_text = 'Skontaktuj się z nami';
  }

  echo '<a href="' . esc_url( $contact_page_url ) . '" class="contact-us-button">' . esc_html( $button_text ) . '</a>';
}

// Contact us button
add_action( 'woocommerce_after_add_to_cart_button', 'add_contact_us_button', 20 );

function custom_contact_us_button_styles() {
  echo '
  <style>
      .contact-us-button {
          margin-left: 10px;
          background-color: #0071a1;
          color: #fff;
          border: none;
          padding: 10px 20px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 14px;
          cursor: pointer;
      }

      .contact-us-button:hover {
          background-color: #005885;
      }
  </style>';
}
add_action( 'wp_head', 'custom_contact_us_button_styles' );

// Price AFTER short description
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );