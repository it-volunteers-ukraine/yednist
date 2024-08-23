// ajax header cart
jQuery(document).ready(function ($) {
  function showCountLoading() {
    $(".header__menu__item__cart-count").css("opacity", "0.5");
  }
  function hideCountLoading() {
    $(".header__menu__item__cart-count").css("opacity", "1");
  }
  function updateCartCount() {
    $.ajax({
      url: cart_count_params.url,
      type: "POST",
      data: {
        action: "update_cart_count",
        nonce: cart_count_params.nonce,
      },
      beforeSend: showCountLoading,
      success: function (response) {
        hideCountLoading();
        if (response.count !== undefined) {
          $(".header__menu__item__cart-count").text(response.count);
          if (response.count > 0) {
            $(".header__menu__item__cart-count").addClass("visible");
          } else {
            $(".header__menu__item__cart-count").removeClass("visible");
          }
        }
      },
    });
  }

  $(document.body).on(
    "added_to_cart removed_from_cart updated_wc_div updated_cart_totals wc_cart_updated",
    function () {
      updateCartCount();
    }
  );
});
