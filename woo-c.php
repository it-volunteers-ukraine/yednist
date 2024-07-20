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

add_action('woocommerce_before_single_product', 'my_theme_product_wrapper_start', 5);
add_action('woocommerce_after_single_product', 'my_theme_product_wrapper_end', 5);

function my_theme_product_wrapper_start() {
    echo '<section class="section"><div class="container"><div class="inner-container">';
}

function my_theme_product_wrapper_end() {
    echo '</div></div></section>';
}

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
    echo '<section class="section shop-section"><div class="container"><div class="inner-container">';
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
        if($tag_slug == 'in_progress-uk' || $tag_slug == 'in_progress-en' || $tag_slug == 'in_progress-pl') {
          echo "in-progress";
        }
        if($tag_slug == 'not_available-uk' || $tag_slug == 'not_available-en' || $tag_slug == 'not_available-pl') {
          echo "not-available";
        }
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
    } else if ($tag_slug == 'not_available-uk' || $tag_slug == 'not_available-en' || $tag_slug == 'not_available-pl') {
        $text = get_field('not_available_button', 'options');
    } else {
        $text = get_field('buy_button', 'options');
    }

    return $text;
}

function add_contact_us_button() {
    $current_language = pll_current_language();

    if ($current_language == 'uk') {
        // UKR ver
        $contact_page_url = get_permalink(get_page_by_path('contacts-uk'));
        $button_text = 'Зв\'язатися з нами';
    } elseif ($current_language == 'en') {
        // English ver
        $contact_page_url = get_permalink(get_page_by_path('contacts-en'));
        $button_text = 'Contact Us';
    } elseif ($current_language == 'pl') {
        // Polish ver
        $contact_page_url = get_permalink(get_page_by_path('contacts-pl'));
        $button_text = 'Skontaktuj się z nami';
    }

    echo '<a href="' . esc_url($contact_page_url) . '" class="contact-us-button">' . esc_html($button_text) . '</a>';
}

// contact us button
add_action('woocommerce_after_add_to_cart_button', 'add_contact_us_button', 20);

// price AFTER short description
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 25);

// remove Additional Information
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);
function remove_product_tabs($tabs) {
    unset($tabs['additional_information']);
    return $tabs;
}

add_filter('woocommerce_product_tabs', 'custom_shipping_payment_tab');
function custom_shipping_payment_tab($tabs) {

    $title = get_field('shipping_payment_title');
    $tabs['shipping_payment'] = array(
        'title'    => ($title),
        'priority' => 50,
        'callback' => 'custom_shipping_payment_tab_content'
    );

    return $tabs;
}

function custom_shipping_payment_tab_content() {
    echo '<p>'.get_field('shipping_payment_info').'</p>';
}

// related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// add custom up-sells action
add_action('woocommerce_after_single_product', 'custom_upsell_products_output', 20);

function custom_upsell_products_output() {
  global $product;

  $upsell_ids = $product->get_upsell_ids();

  if ($upsell_ids) {
     
      echo '<section class="section shop-section">';
      echo '<div class="container">';
      echo '<h2 class="section-title">'.__(get_field('similar_products_title')).'</h2>';
      echo '<div class="inner-container">';

      echo '<ul class="products columns-4">';
      foreach ($upsell_ids as $upsell_id) {
          $post_object = get_post($upsell_id);
          setup_postdata($GLOBALS['post'] =& $post_object);
          wc_get_template_part('content', 'product');
      }
      echo '</ul>';
      
      echo '</div>';
      echo '</div>';
      echo '</section>';

      wp_reset_postdata();
  }
}


// disable add to cart button
function custom_manage_stock_status_shop_page() {
    ?>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  var outOfStockProducts = document.querySelectorAll('.product.outofstock a.button');
  console.log(outOfStockProducts);
  outOfStockProducts.forEach(function(button) {
    // button.classList.add('disabled');
  });
});
</script>
<?php
}
add_action('wp_head', 'custom_manage_stock_status_shop_page');