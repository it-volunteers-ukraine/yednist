new Swiper(".fioh-team__appeal-wrapper-mobile", {
  enabled: true,
  loop: true,
  slidesPerView: 1,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    type: "bullets",
  },
});

new Swiper(".fioh-team__team-repeater", {
  effect: "slide",
  loop: true,
  slidesPerView: 1,
  spaceBetween: 30,
  direction: "vertical",
  navigation: {
    nextEl: ".fioh-team__team-repeater-item-btn-circle",
  },
});

function acf_repeater_show_more({ url, post_id, offset, nonce }) {
  buttonACF.classList.add("loading");
  // робимо AJAX запит
  jQuery.post(
    url,
    {
      // AJAX, який ми налагодили в PHP
      action: "acf_repeater_show_more",
      post_id: post_id,
      offset: offset,
      nonce: nonce,
      width: window.innerWidth,
    },
    function (json) {
      // додаємо контент в контейнер
      // цей ідентифікатор має відповідати контейнеру
      // до якого ви хочете додати контент
      jQuery(".fioh-team__project__list").append(json["content"]);
      // оновимо зміщення
      my_repeater_field_offset = json["offset"];
      // перевіримо, чи є ще що завантажити
      if (!json["more"]) {
        // якщо ні, сховаємо кнопку завантаження
        jQuery(".acf-loadmore").css("display", "none");
      } else {
        buttonACF.classList.remove("loading");
      }
    },
    "json"
  );
}
