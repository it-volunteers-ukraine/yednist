document.addEventListener("DOMContentLoaded",(function(){function t(t){const e=t.closest("tr").querySelector("[data-product_id]").getAttribute("data-product_id"),a=new FormData;a.append("action","update_cart_item_quantity"),a.append("product_id",e),a.append("quantity",t.value),document.body.classList.add("woocommerce-processing"),document.querySelector("tbody").classList.add("processing"),document.querySelector("tbody").style.opacity="0.5";const o=document.createElement("div");o.classList.add("blockUI","blockOverlay"),document.querySelector("tbody").appendChild(o),fetch(wc_cart_params.ajax_url,{method:"POST",body:a}).then((t=>t.json())).then((t=>{document.querySelector(".woocommerce-cart-form").innerHTML=t.fragments[".woocommerce-cart-form"],document.querySelector(".cart-collaterals").innerHTML=t.fragments[".cart-totals"],document.querySelector("body").dispatchEvent(new Event("wc_cart_updated"))})).finally((()=>{document.body.classList.remove("woocommerce-processing"),document.querySelector("tbody").style.opacity="1",document.querySelector("tbody").classList.remove("processing");var t=document.querySelector(".blockUI.blockOverlay");t&&t.remove()})).catch((t=>console.error("Ошибка:",t)))}document.addEventListener("click",(function(e){if(e.target.classList.contains("plus")||e.target.classList.contains("minus")){const a=e.target,o=a.closest(".quantity-wrapper").querySelector(".qty"),c=parseFloat(o.value),n=parseFloat(o.getAttribute("max")),r=parseFloat(o.getAttribute("min")),s=parseFloat(o.getAttribute("step"));c&&!isNaN(c)||(c=0),a.classList.contains("plus")?o.value=n&&c>=n?n:c+s:a.classList.contains("minus")&&(r&&c<=r?o.value=r:c>0&&(o.value=c-s)),o.dispatchEvent(new Event("change")),t(o)}})),document.addEventListener("focusin",(function(t){t.target.classList.contains("qty")&&(initialQtyValue=t.target.value)})),document.addEventListener("blur",(function(e){e.target.classList.contains("qty")&&e.target.value!==initialQtyValue&&t(e.target)}),!0),document.addEventListener("keydown",(function(e){e.target.classList.contains("qty")&&"Enter"===e.key&&(e.preventDefault(),t(e.target))}))}));