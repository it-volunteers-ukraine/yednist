document.addEventListener("DOMContentLoaded", function () {
  // linked products
  const allProductsArray = document.querySelectorAll(".shop-section .product");
  if (allProductsArray) {
    allProductsArray.forEach((product) => {
      product.classList.add("swiper-slide");
    });
    const recomendedProductsSwiper = new Swiper(".shop-section__slider", {
      slidesPerView: 2,
      slidesPerGroup: 2,
      spaceBetween: 16,
      pagination: {
        el: ".shop-section__bullets",
        clickable: true,
        slideToClickedSlide: true,
      },
      breakpoints: {
        576: {
          slidesPerView: 2,
          slidesPerGroup: 2,
          spaceBetween: 46,
        },
        992: {
          slidesPerView: 3,
          slidesPerGroup: 3,
          spaceBetween: 68,
        },
        1441: {
          slidesPerView: 3,
          slidesPerGroup: 3,
          spaceBetween: 94,
        },
      },
    });
  }

  // select
  (() => {
    const selects = document.querySelectorAll(".variations select");

    if (selects.length) {
      selects.forEach((e) => {
        const selectItems = e.querySelectorAll("option");
        const elems = createCustomSelect(selectItems);
        e.closest(".value").append(elems);

        elems.addEventListener("click", () => {
          const active = elems.querySelector("span.main");
          const optionsWrapSpan = elems.querySelectorAll(
            ".custom_option_wrap span"
          );
          if (optionsWrapSpan.length) {
            optionsWrapSpan.forEach((element, key) => {
              element.addEventListener("click", () => {
                if (!element.classList.contains("active")) {
                  const closestWrap = element.closest(".value");
                  let closestSelect = closestWrap
                    ? closestWrap.querySelector("select")
                    : null;

                  if (closestSelect) {
                    closestSelect.selectedIndex = key;
                    closestSelect.dispatchEvent(
                      new Event("change", { bubbles: true })
                    );
                    optionsWrapSpan.forEach((option) =>
                      option.classList.remove("active")
                    );
                    active.innerHTML = element.innerHTML;
                    element.classList.add("active");
                  }
                }
              });
            });
          }
          elems.classList.toggle("open");
        });
      });
    }
  })();

  function createCustomSelect(num) {
    const selectWrap = document.createElement("div");
    const optionWrap = document.createElement("div");
    selectWrap.classList.add("custom_select_wrap");
    optionWrap.classList.add("custom_option_wrap");
    if (num.length) {
      num.forEach((el, key) => {
        const option = document.createElement("span");
        option.innerHTML = el.innerHTML;
        if (key == 1) {
          const optionStart = document.createElement("span");
          option.classList.add("active");
          optionStart.classList.add("main");
          optionStart.innerHTML = el.innerHTML;
          selectWrap.append(optionStart);
          optionWrap.append(option);
        } else {
          optionWrap.append(option);
        }
      });
    }
    selectWrap.append(optionWrap);
    return selectWrap;
  }
});
