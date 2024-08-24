document.addEventListener("DOMContentLoaded", function () {
  function updateCartQuantity(qtyInput) {
    const productId = qtyInput
      .closest("tr")
      .querySelector("[data-product_id]")
      .getAttribute("data-product_id");

    const formData = new FormData();
    formData.append("action", "update_cart_item_quantity");
    formData.append("product_id", productId);
    formData.append("quantity", qtyInput.value);

    document.body.classList.add("woocommerce-processing");
    document.querySelector("tbody").classList.add("processing");
    document.querySelector("tbody").style.opacity = "0.5";
    const blockOverlay = document.createElement("div");
    blockOverlay.classList.add("blockUI", "blockOverlay");
    document.querySelector("tbody").appendChild(blockOverlay);

    fetch(wc_cart_params.ajax_url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        document.querySelector(".woocommerce-cart-form").innerHTML =
          data.fragments[".woocommerce-cart-form"];
        document.querySelector(".cart-collaterals").innerHTML =
          data.fragments[".cart-totals"];
        document
          .querySelector("body")
          .dispatchEvent(new Event("wc_cart_updated"));
      })
      .finally(() => {
        document.body.classList.remove("woocommerce-processing");
        document.querySelector("tbody").style.opacity = "1";
        document.querySelector("tbody").classList.remove("processing");
        var overlay = document.querySelector(".blockUI.blockOverlay");
        if (overlay) {
          overlay.remove();
        }
      })
      .catch((error) => console.error("Ошибка:", error));
  }

  document.addEventListener("click", function (event) {
    if (
      event.target.classList.contains("plus") ||
      event.target.classList.contains("minus")
    ) {
      const button = event.target;
      const qtyInput = button
        .closest(".quantity-wrapper")
        .querySelector(".qty");
      const currentVal = parseFloat(qtyInput.value);
      const max = parseFloat(qtyInput.getAttribute("max"));
      const min = parseFloat(qtyInput.getAttribute("min"));
      const step = parseFloat(qtyInput.getAttribute("step"));

      if (!currentVal || isNaN(currentVal)) currentVal = 0;

      if (button.classList.contains("plus")) {
        if (max && currentVal >= max) {
          qtyInput.value = max;
        } else {
          qtyInput.value = currentVal + step;
        }
      } else if (button.classList.contains("minus")) {
        if (min && currentVal <= min) {
          qtyInput.value = min;
        } else if (currentVal > 0) {
          qtyInput.value = currentVal - step;
        }
      }

      qtyInput.dispatchEvent(new Event("change"));
      updateCartQuantity(qtyInput);
    }
  });

  document.addEventListener("focusin", function (event) {
    if (event.target.classList.contains("qty")) {
      initialQtyValue = event.target.value;
    }
  });

  document.addEventListener(
    "blur",
    function (event) {
      if (event.target.classList.contains("qty")) {
        if (event.target.value !== initialQtyValue) {
          updateCartQuantity(event.target);
        }
      }
    },
    true
  );

  document.addEventListener("keydown", function (event) {
    if (event.target.classList.contains("qty") && event.key === "Enter") {
      event.preventDefault();
      updateCartQuantity(event.target);
    }
  });
});
