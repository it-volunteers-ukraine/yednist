<?php

// add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}

function yednist_add_woocommerce_support() {
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

add_action( 'after_setup_theme', 'yednist_add_woocommerce_support' );

// shipping method title
function custom_rename_local_pickup_label($rates, $package) {
  foreach ($rates as $rate_id => $rate) {
    if ($rate->get_method_id() === 'local_pickup') {
      $rate->label = get_field('self_shipping', 'options');
    }
  }
  return $rates;
}
add_filter('woocommerce_package_rates', 'custom_rename_local_pickup_label', 10, 2);
// payment method title
function custom_rename_payment_gateways($available_gateways) {
  if (isset($available_gateways['cod'])) {
    $available_gateways['cod']->title = get_field('payment_per_picking_up', 'options');
  }
  return $available_gateways;
}
add_filter('woocommerce_available_payment_gateways', 'custom_rename_payment_gateways');


add_action('woocommerce_before_single_product', 'my_theme_product_wrapper_start', 5);
add_action('woocommerce_after_single_product', 'my_theme_product_wrapper_end', 5);

function my_theme_product_wrapper_start() {
    echo '<section class="section"><div class="container"><div class="inner-container">';
}

function my_theme_product_wrapper_end() {
    echo '</div></div></section>';
}

//============Catalog page==============//
add_action('wp', 'shop_remove_shop_wrappers');

function shop_remove_shop_wrappers() {
    if (is_shop()) {
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    }
}

add_action('woocommerce_before_main_content', 'shop_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'shop_wrapper_end', 10);

function shop_wrapper_start() {
  if (is_shop()) {
  echo '<main>';
  }
}

function shop_wrapper_end() {
  if (is_shop()) {
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
}

// add custom page title
add_action('woocommerce_show_page_title', 'custom_title_shop', 10);

function custom_title_shop() {
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

// redirect to different lang cart from catalog page
function custom_add_to_cart_redirect($url) {
    $current_language = pll_current_language();
    
    if ($current_language == 'en') {
        $cart_url = site_url('/cart-en/');
    } elseif ($current_language == 'pl') {
        $cart_url = site_url('/cart-pl/');
    } else {
        $cart_url = wc_get_cart_url();
    }
    
    return $cart_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');

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

// disable add to cart button
function custom_manage_stock_status_shop_page() {
    ?>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  var outOfStockProducts = document.querySelectorAll('.product.outofstock a.button');
  outOfStockProducts.forEach(function(button) {
    button.classList.add('disabled');
  });
});
</script>
<?php
}
add_action('wp_head', 'custom_manage_stock_status_shop_page');

//===========product page==================/
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

//==============Checkout page==============//

// add necessary containers
function add_content_before_checkout_form() {
    echo '<main>';
    echo '<section class="breadcrumbs__section">
    <div class="container">
    <div class="breadcrumbs__line"></div>
    </div>
    </section>';
    echo '<section class="section checkout-section">
    <div class="container">
    <div class="inner-container">
    <h1 class="page-title checkout-section__title">';
    echo the_title();
    echo '</h1>';
}
add_action('woocommerce_before_checkout_form', 'add_content_before_checkout_form', 5);

function add_content_after_checkout_form() {
echo '</div>
</div>
</section>
</main>';
}
add_action('woocommerce_after_checkout_form', 'add_content_after_checkout_form', 5);

function checkout_before_customer_details() {
echo '<div>';
}
add_action('woocommerce_checkout_before_customer_details', 'checkout_before_customer_details', 5);

function checkout_before_order_review_heading() {
  echo '</div><div>';
}
add_action('woocommerce_checkout_before_order_review_heading', 'checkout_before_order_review_heading', 5);

function review_order_before_order_total() {
echo '</div>';
}
add_action('woocommerce_review_order_before_order_total', 'review_order_before_order_total', 5);


// add new field and change order, labels and placeholders of form fields
function custom_override_checkout_fields_order($fields) {
    // new fields
    $fields['billing']['billing_nip'] = array(
        'label'       => get_field('nip_input', 'options'),
        'class'       => array('form-row-wide'),
    );
    $fields['billing']['billing_address_3'] = array(
        'label'       => get_field('apartments_input', 'options'),
        'class'       => array('form-row-wide'),

    );
    // priority
    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority'] = 20;
    $fields['billing']['billing_phone']['priority'] = 30;
    $fields['billing']['billing_email']['priority'] = 40;
    $fields['billing']['billing_company']['priority'] = 50;
    $fields['billing']['billing_nip']['priority'] = 51;
    //placeholders
    $fields['billing']['billing_first_name']['placeholder'] = get_field('name_placeholder', 'options');
    $fields['billing']['billing_last_name']['placeholder'] = get_field('last_name_placeholder', 'options');
    $fields['billing']['billing_email']['placeholder'] = get_field('email_placeholder', 'options');
    $fields['billing']['billing_phone']['placeholder'] = get_field('phone_placeholder', 'options');
    //labels
    $fields['billing']['billing_first_name']['label'] = get_field('name_input', 'options');
    $fields['billing']['billing_last_name']['label'] = get_field('last_name_input', 'options');
    $fields['billing']['billing_phone']['label'] = get_field('phone_input', 'options');
    $fields['billing']['billing_email']['label'] = get_field('email_input', 'options');
    $fields['billing']['billing_company']['label'] = get_field('company_name_input', 'options');

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields_order');

// change address fields
function custom_override_default_address_fields( $address_fields ) {
    // labels
    $address_fields['city']['label'] = get_field('city_input', 'options');
    $address_fields['address_1']['label'] = get_field('street_input', 'options');
    $address_fields['address_2']['label'] = get_field('house_number_input', 'options');
    $address_fields['postcode']['label'] = get_field('post_index_input', 'options');
    // placeholders
    $address_fields['address_1']['placeholder'] = '';
    $address_fields['address_2']['placeholder'] = '';
    // requirement
    $address_fields['address_2']['required'] = true;
    // priority
    $address_fields['country']['priority'] = 52;
    $address_fields['city']['priority'] = 54;
    $address_fields['address_1']['priority'] = 56;
    $address_fields['address_2']['priority'] = 58;
    $address_fields['address_3']['priority'] = 60;
    $address_fields['postcode']['priority'] = 65;

    return $address_fields;
}
add_filter('woocommerce_default_address_fields', 'custom_override_default_address_fields');

// change paiment choices placement
function custom_reorder_checkout_sections() {
    remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    add_action('woocommerce_after_checkout_billing_form', 'woocommerce_checkout_payment', 20);
}
add_action('wp_loaded', 'custom_reorder_checkout_sections');

function custom_checkout_payment_title() {
  echo '<p>'.the_field('payment_method', 'options').'</p>';
}
add_action('woocommerce_review_order_before_payment', 'custom_checkout_payment_title', 10);

function custom_woocommerce_order_button_text( $button_text ) {
    return get_field('payment_button', 'options');
}
add_filter( 'woocommerce_order_button_text', 'custom_woocommerce_order_button_text' );

add_filter('woocommerce_ship_to_different_address_checked', '__return_false');

// toggle shipping address
function toggle_shipping_fields() {
  if (is_checkout()) {
    ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
  function toggleShippingAddress() {
    var shippingMethod = $('input[name="shipping_method[0]"]:checked').val();
    if (shippingMethod && shippingMethod.indexOf('local_pickup') !== -1) {
      $('.woocommerce-shipping-fields').hide();
    } else {
      $('.woocommerce-shipping-fields').show();
    }
  }
  toggleShippingAddress();

  $('form.checkout').on('change', 'input[name="shipping_method[0]"]', function() {
    toggleShippingAddress();
  });
});
</script>
<?php
    }
  }
add_action('wp_footer', 'toggle_shipping_fields');

// texts change
function change_checkout_texts($translated_text, $text, $domain) {
    switch ($text) {
        case 'Ship to a different address?':
            $translated_text = get_field('address_for_shipping', 'options');
            break;
        case 'Total':
          if(is_checkout()) {
            $translated_text = get_field('order_total', 'options');
          }
            break;
    }
    return $translated_text;
}
add_filter('gettext', 'change_checkout_texts', 20, 3);

function customize_woocommerce_shipping_fields($fields) {
  // placeholders
  $fields['shipping']['shipping_first_name']['placeholder'] = get_field('shipping_name_placeholder', 'options');
  $fields['shipping']['shipping_last_name']['placeholder'] = get_field('shipping_last_name_placeholder', 'options');
  $fields['order']['order_comments']['placeholder'] = get_field('notes_placeholder', 'options');
  //labels
  $fields['shipping']['shipping_first_name']['label'] = get_field('name_input', 'options');
  $fields['shipping']['shipping_last_name']['label'] = get_field('last_name_input', 'options');
  $fields['shipping']['shipping_city']['label'] = get_field('city_input', 'options');
  $fields['shipping']['shipping_address_1']['label'] = get_field('street_input', 'options');
  $fields['shipping']['shipping_address_2']['label'] = get_field('house_number_input', 'options');
  $fields['shipping']['shipping_address_3']['label'] = get_field('apartments_input', 'options');
  $fields['shipping']['shipping_postcode']['label'] = get_field('post_index_input', 'options');
  $fields['order']['order_comments']['label'] = get_field('notes_label', 'options');
  //requirement
  $fields['shipping']['shipping_address_2']['required'] = true;
  // hide field
  unset($fields['shipping']['shipping_company']);
  return $fields;
}
add_filter('woocommerce_checkout_fields', 'customize_woocommerce_shipping_fields');


function add_custom_heading_before_order_review() {
  echo '<div class="checkout_order_title--wrap"><h2 class="page-title checkout_order_title">';
  the_field('cart_block_title', 'options');
  echo '</h2><a href="';
  the_field('cart_link', 'options');
  echo '" class="checkout_order_link">';
  the_field('edit_cart_btn', 'options');
  echo '</a></div>';
}
add_action('woocommerce_checkout_order_review', 'add_custom_heading_before_order_review');


function add_product_image_to_checkout($product_name, $cart_item, $cart_item_key) {
  $product = $cart_item['data'];
  $thumbnail = $product->get_image(array(100, 100));
  $quantity = sprintf('<p class="product-quantity">x %s</p>', $cart_item['quantity']);
  if(is_checkout()) {
    $product_name = '<div class="checkout-product-wrapper">' . $thumbnail . '<div class="checkout-product-name">' . $product_name . $quantity . '</div></div>';
  }
  return $product_name;
}
add_filter('woocommerce_cart_item_name', 'add_product_image_to_checkout', 10, 3);


function store_checkout_language_in_session($order_id) {
  $current_language = pll_current_language();
  error_log('Language from session: ' . $current_language);
  WC()->session->set('checkout_language', $current_language);
}
add_action('woocommerce_checkout_order_processed', 'store_checkout_language_in_session', 10, 1);


function redirect_to_thank_you($thank_you_url, $order) {
  if ($order->has_status('failed')) {
    return $thank_you_url;
  }
  $current_language = WC()->session->get('checkout_language');
  error_log('Language from session: ' . $current_language);
  
  if ($current_language == 'en') {
    $thank_you_page_url = site_url('/thank-you-en/');
  } else if ($current_language == 'pl') {
    $thank_you_page_url = site_url('/thank-you-pl/');
  } else {
    $thank_you_page_url = site_url('/thank-you-uk/');
  }
  
  return $thank_you_page_url;
}
add_action('woocommerce_get_return_url', 'redirect_to_thank_you', 90, 2);

//============== cart page ===========//
function before_cart() {
  echo '<section class="breadcrumbs__section -cart">
  <div class="container">
    <div class="breadcrumbs__line"></div>
  </div>
  </section>
  <section class="section cart-section">
  <div class="container">
  <div class="inner-container">
  <h1 class="page-title cart-section--title">';
  the_title();
  echo '</h1>';
}
add_action('woocommerce_before_cart', 'before_cart', 10);

function after_cart() {
  echo '
  </div>
  </div>
  </section>';
}
add_action('woocommerce_after_cart', 'after_cart', 10);

function change_cart_table_headings($translated_text, $text, $domain) {
    if ($domain === 'woocommerce') {
      if (strtolower($text) === 'product') {
            $translated_text = '';
        } elseif (strtolower($text) === 'products') {
            $translated_text = '';
        }
        if (strtolower($text) === 'subtotal') {
            $translated_text = get_field('cart_order_total', 'options');
        }
        if (strtolower($text) === 'proceed to checkout') {
            $translated_text = get_field('cart_checkout_btn', 'options');
        }
    }
    return $translated_text;
}
add_filter('gettext', 'change_cart_table_headings', 20, 3);


function custom_quantity_buttons($product_quantity, $cart_item_key, $cart_item) {
    $_product = $cart_item['data'];
    $product_quantity = '<div class="quantity-wrapper">';
    $product_quantity .= '<button type="button" class="minus"></button>';
    $product_quantity .= woocommerce_quantity_input(array(
        'input_name'    => "cart[{$cart_item_key}][qty]",
        'input_value'   => $cart_item['quantity'],
        'max_value'     => $_product->get_max_purchase_quantity(),
        'min_value'     => '0',
        'product_name'  => $_product->get_name(),
    ), $_product, false);
    $product_quantity .= '<button type="button" class="plus"></button>'; 
    $product_quantity .= '</div>';

    return $product_quantity;
}
add_filter('woocommerce_cart_item_quantity', 'custom_quantity_buttons', 10, 3);

function update_cart_item_quantity() {
    if ( !isset($_POST['product_id']) || !isset($_POST['quantity']) ) {
        wp_send_json_error('Недостаточно данных');
    }
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    if ( $quantity < 0 ) {
        $quantity = 0;
    }
    $cart_item_key = null;
    foreach (WC()->cart->get_cart() as $key => $cart_item) {
        if ($cart_item['product_id'] === $product_id) {
            $cart_item_key = $key;
            break;
        }
    }
    if ($cart_item_key === null) {
        wp_send_json_error('Товар не найден в корзине');
    }
    WC()->cart->set_quantity($cart_item_key, $quantity);

    ob_start();
    wc_get_template('cart/cart-table.php');
    $mini_cart = ob_get_clean();

    ob_start();
    wc_get_template('cart/cart-totals.php');
    $cart_totals = ob_get_clean();

    wp_send_json(array(
        'fragments' => array(
            '.woocommerce-cart-form' => $mini_cart,
            '.cart-totals' => $cart_totals,
        ),
    ));
}
add_action('wp_ajax_update_cart_item_quantity', 'update_cart_item_quantity');
add_action('wp_ajax_nopriv_update_cart_item_quantity', 'update_cart_item_quantity');

function change_checkout_url_based_on_language($url) {
    $url = get_field('cart_checkout_btn_link', 'options');
    return $url;
}
add_filter('woocommerce_get_checkout_url', 'change_checkout_url_based_on_language');