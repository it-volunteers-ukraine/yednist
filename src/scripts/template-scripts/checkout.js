jQuery(function ($) {
  function movePlaceOrderButton() {
    var placeOrderContainer = $(".form-row.place-order");
    var reviewOrderContainer = $(".woocommerce-checkout-review-order");

    if (placeOrderContainer.length && reviewOrderContainer.length) {
      placeOrderContainer.appendTo(reviewOrderContainer).show();
    }
  }
  movePlaceOrderButton();
});

document.addEventListener("DOMContentLoaded", function () {
  const shippingWrap = document.querySelector(".woo-custom-shipping-container");
  if (shippingWrap && shippingWrap.childNodes[2]) {
    shippingWrap.childNodes[2].textContent = "";
  }
});
