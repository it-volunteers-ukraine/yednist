<?php

// add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
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

// register ajax header cart
function update_cart_count() {
  if (!isset($_POST["nonce"]) || !wp_verify_nonce($_POST["nonce"], "nonce")) {
        exit;
    }
    $count = WC()->cart->get_cart_contents_count();
    wp_send_json( array( 'count' => $count ) );
}
add_action( 'wp_ajax_update_cart_count', 'update_cart_count' );
add_action( 'wp_ajax_nopriv_update_cart_count', 'update_cart_count' );

//brouser shop title
function custom_shop_page_seo_title($title) {
    if (is_shop()) {
        if (function_exists('pll_current_language')) {
            $current_language = pll_current_language();
            if ($current_language == 'en') {
                $title = 'Shop - Jedność';
            } elseif ($current_language == 'pl') {
                $title = 'Sklep - Jedność';
            } else {
                $title = 'Магазин - Jedność';
            }
        }
    }
    return $title;
}
add_filter('wpseo_title', 'custom_shop_page_seo_title', 20);


//==============images size =====================//
// Adjust image size for single product pages
add_filter('woocommerce_get_image_size_single', function($size) {
    return array(
        'width'  => 500,
        'height' => 500, 
        'crop'   => 0 
    );
});

// Adjust image size for shop (product archive) pages
add_filter('woocommerce_get_image_size_shop_catalog', function($size) {
    return array(
        'width'  => 300,
        'height' => 300,
        'crop'   => 0
    );
});

// Adjust image size for related products and thumbnails
add_filter('woocommerce_get_image_size_thumbnail', function($size) {
    return array(
        'width'  => 300,
        'height' => 300,
        'crop'   => 0
    );
});

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
// button text if product is already added to cart
add_filter( 'woocommerce_product_add_to_cart_text', 'product_btn_text', 20, 2 );
function product_btn_text( $text, $product ) {
	if( WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id($product->get_id()))) {
		$text = get_field('already_in_cart_button', 'options');
	}
	return $text;
}
// button text after adding to cart
function change_button_text_on_add_to_cart() {
    ?>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  jQuery(document).on('click', '.add_to_cart_button', function() {
    var button = jQuery(this);

    jQuery(document).on('added_to_cart', function() {
      var newText = "<?php echo esc_js(get_field('already_in_cart_button', 'options')); ?>";
      button.text(newText);
    });
  });
});
</script>
<?php
}
add_action('wp_footer', 'change_button_text_on_add_to_cart');

// go to cart link
function custom_change_added_to_cart_text() {
    ?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
  document.addEventListener("click", function(event) {
    if (event.target.classList.contains("add_to_cart_button")) {
      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
          mutation.addedNodes.forEach(function(node) {
            if (node.nodeType === 1 && node.classList.contains("added_to_cart")) {
              node.textContent = "<?php the_field('go_to_cart_link_title', 'options') ?>";
            }
          });
        });
      });

      const catalogContainer = document.querySelector(".products");
      if (catalogContainer) {
        observer.observe(catalogContainer, {
          childList: true,
          subtree: true
        });
      }
    }
  });
});
</script>
<?php
}
add_action('wp_footer', 'custom_change_added_to_cart_text');

// redirect to different lang cart from catalog page
function custom_add_to_cart_redirect($url) {
    $cart_url = get_field('cart_link', 'options');
    return $cart_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');

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
add_action('woocommerce_before_single_product', 'my_theme_product_wrapper_start', 5);
add_action('woocommerce_after_single_product', 'my_theme_product_wrapper_end', 5);

function my_theme_product_wrapper_start() {
    echo '<section class="section single-product__section"><div class="container"><div class="inner-container">';
}

function my_theme_product_wrapper_end() {
    echo '</div></div></section>';
}

add_filter('bcn_breadcrumb_title', 'woo_breadcrumb_archive_title_changer', 10, 3); 
function woo_breadcrumb_archive_title_changer($title, $type, $id) 
{ 
    if (in_array('archive', $type)) { 
        $title =  get_field('shop_title_breadcrumbs', 'options');
}
return $title;
}

// contact us button
function add_contact_us_button() {
echo '<a href="' . get_field('contact_us_button_link', 'options') . '" class="button contact-us-button">' .
  get_field('contact_us_button', 'options') . '</a>';
}
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
'title' => ($title),
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
    echo '<h2 class="section-title">'.get_field('similar_products_title', 'options').'</h2>';
    echo '<div class="inner-container">
      <div class="shop-section__slider">';

        echo '<ul class="products swiper-wrapper">';
          foreach ($upsell_ids as $upsell_id) {
          $post_object = get_post($upsell_id);
          setup_postdata($GLOBALS['post'] =& $post_object);
          wc_get_template_part('content', 'product');
          }
          echo '</ul>
      </div>';
      echo '<ul class="shop-section__bullets"></ul>';
      echo '
    </div>';
    echo '</div>';
  echo '</section>';

wp_reset_postdata();
}
}

//==============Checkout page==============//
// add necessary containers
function add_content_before_checkout_form() {
echo '<main>';
  echo '<section class="breadcrumbs__section -checkout">
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
        echo '
      </div>
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
  echo '</div>
<div>';
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
'label' => get_field('nip_input', 'options'),
'class' => array('form-row-wide'),
);
$fields['billing']['billing_address_3'] = array(
'label' => get_field('apartments_input', 'options'),
'class' => array('form-row-wide'),

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

function change_woocommerce_texts($translated_text, $text, $domain) {
    if ($domain === 'woocommerce') {
        switch (strtolower($text)) {
            case 'product':
            case 'products':
                $translated_text = '';
                break;
            case 'subtotal':
                $translated_text = get_field('cart_order_total', 'options');
                break;
            case 'proceed to checkout':
                $translated_text = get_field('cart_checkout_btn', 'options');
                break;
            case 'ship to a different address?':
                $translated_text = get_field('address_for_shipping', 'options');
                break;
        }
    }
    return $translated_text;
}
add_filter('gettext', 'change_woocommerce_texts', 20, 3);
// update labels translations after ajax
function custom_update_labels_after_ajax() {
    if (is_checkout()) {
        ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
  function updateShippingAndPaymentLabels() {
    $('label[for^="shipping_method_0_local_pickup"]').each(function() {
      $(this).text('<?php echo esc_js(get_field("self_shipping", "options")); ?>');
    });
    $('label[for^="payment_method_cod"]').each(function() {
      $(this).text('<?php echo esc_js(get_field("payment_per_picking_up", "options")); ?>');
    });
    $('.order-total th').text('<?php echo esc_js(get_field("order_total", "options")); ?>');
  }
  updateShippingAndPaymentLabels();
  $(document.body).on('updated_checkout', function() {
    updateShippingAndPaymentLabels();
  });
});
</script>
<?php
    }
}
add_action('wp_footer', 'custom_update_labels_after_ajax');

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

// checkout validation
function custom_checkout_validation_scripts() {
    if (is_checkout()) {
        ?>
<script type="text/javascript">
jQuery(function($) {
  // Phone number validation on input
  $('#billing_phone').mask("+48999999999");
  $('#billing_phone').on('keyup', function() {
    var $this = $(this);
    var value = $this.val();
    var errorMessage = '<?php the_field('phone_validation_checkout', 'options') ?>';
    value = value.replace(/[^+\d]/g, '');

    if (!/^\+\d{11,}$/.test(value)) {
      $this.addClass('woocommerce-invalid');
      if ($this.next('.custom-error').length === 0) {
        $this.after('<div class="custom-error woocommerce-error">' + errorMessage + '</div>');
      }
    } else {
      $this.removeClass('woocommerce-invalid');
      $this.next('.custom-error').remove();
    }
  });
  // Email validation on input
  $('#billing_email').on('input', function() {
    var value = $(this).val();
    var errorMessage = '<?php the_field('email_validation_checkout', 'options') ?>';

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
      $(this).addClass('woocommerce-invalid');
      if ($(this).next('.custom-error').length === 0) {
        $(this).after('<div class="custom-error woocommerce-error">' + errorMessage + '</div>');
      }
    } else {
      $(this).removeClass('woocommerce-invalid');
      $(this).next('.custom-error').remove();
    }
  });

  // Custom validation logic for checkout errors
  $(document.body).on('checkout_error', function() {
    $('.woocommerce-invalid').next('.woocommerce-error').remove();

    $('.woocommerce-error li').each(function() {
      var errorMessage = $(this).text();
      var fieldID = $(this).attr('data-id');
      var fieldWrapperID;

      if (fieldID) {
        fieldWrapperID = '#' + fieldID + '_field';
      } else if (errorMessage.includes('email')) {
        fieldWrapperID = '#billing_email_field';
      } else {
        return;
      }

      var field = $(fieldWrapperID);

      if (field.length && !field.find('.woocommerce-error:contains("' + errorMessage + '")').length) {
        field.addClass('woocommerce-invalid').append('<div class="woocommerce-error">' + errorMessage +
          '</div>');
      }
    });
  });
});
</script>
<?php
    }
}
add_action('wp_footer', 'custom_checkout_validation_scripts');

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
// get current language on checkout page
function set_checkout_language_in_session($checkout) {
    $current_language = pll_current_language();
    WC()->session->set('custom_checkout_language', $current_language);
}
add_action('woocommerce_before_checkout_form', 'set_checkout_language_in_session', 10);
// redirect to a new thank-you-page
function redirect_to_thank_you($thank_you_url, $order) {
  if ($order->has_status('failed')) {
    return $thank_you_url;
  }
  $current_language = WC()->session->get('custom_checkout_language');

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

add_action('template_redirect', 'redirect_empty_cart_to_cart_page');

// redirect from checkout if the cart is empty
function redirect_empty_cart_to_cart_page() {
    if (is_checkout()) {
        if (WC()->cart->is_empty()) {
            wp_safe_redirect(get_field('cart_link', 'options'));
            exit;
        }
    }
}
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

// add variation id to products
add_filter('woocommerce_cart_item_name', function($product_name, $cart_item, $cart_item_key) {
    if (isset($cart_item['variation_id']) && $cart_item['variation_id']) {
        $variation_id = esc_attr($cart_item['variation_id']);
        $product_name = sprintf('<span data-variation_id="%s">%s</span>', $variation_id, $product_name);
    }
    return $product_name;
}, 10, 3);

// change button text for variable products
add_filter( 'woocommerce_product_add_to_cart_text', 'variable_button_text', 25 );
function variable_button_text( $text ) {
	global $product;
	if ( $product->is_type( 'variable' ) ) {
		$text = $product->is_purchasable() ? get_field('choose_btn_text', 'options') : 'Choose';
	}
	return $text;
}
// add plus and minus buttons
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
// update items quantity in the cart
function update_cart_item_quantity() {
    if ( !isset($_POST['product_id']) || !isset($_POST['quantity']) ) {
        wp_send_json_error('Not enough data');
    }
    $product_id = intval($_POST['product_id']);
    $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
    $quantity = intval($_POST['quantity']);
    if ( $quantity < 0 ) {
        $quantity = 0;
    }
    $cart_item_key = null;
    foreach (WC()->cart->get_cart() as $key => $cart_item) {
        if ($cart_item['product_id'] === $product_id && ($variation_id === 0 || $cart_item['variation_id'] === $variation_id)) {
          error_log(print_r($cart_item, true));
            $cart_item_key = $key;
            break;
        }
    }
    if ($cart_item_key === null) {
        wp_send_json_error('No such item in the cart');
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
// redirect to a checkout page according to a site language
function change_checkout_url_based_on_language($url) {
    $url = get_field('cart_checkout_btn_link', 'options');
    return $url;
}
add_filter('woocommerce_get_checkout_url', 'change_checkout_url_based_on_language');
// redirect to a shop page according to a site language
function custom_redirect_wc_backward_button() {
    if (is_cart() && WC()->cart->is_empty()) {
        $current_language = pll_current_language();
        
        if ($current_language == 'en') {
            $redirect_url = site_url('/en/shop/');
        } elseif ($current_language == 'pl') {
            $redirect_url = site_url('/pl/shop/');
        } else {
            $redirect_url = site_url('/shop/');
        }

        add_filter('woocommerce_return_to_shop_redirect', function() use ($redirect_url) {
            return $redirect_url;
        });
    }
}
add_action('template_redirect', 'custom_redirect_wc_backward_button');