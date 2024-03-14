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

// let itemsCount = getitemsCount();
// let startIndex = 0;

// function getitemsCount() {
//   if (window.innerWidth > 1349.98) {
//     return 3;
//   } else if (window.innerWidth > 767.98) {
//     return 2;
//   } else {
//     return 1;
//   }
// }

// function loadProjects() {
//   // робимо AJAX запит
//   jQuery.post(
//     myAjax.ajaxUrl,
//     {
//       // AJAX, який ми налагодили в PHP
//       action: "acf_repeater_show_more",
//       nonce: myAjax.nonce,
//       start: startIndex,
//       end: itemsCount,
//     },
//     function (json) {
//       // додаємо контент в контейнер
//       // цей ідентифікатор має відповідати контейнеру
//       // до якого ви хочете додати контент
//       jQuery(".fioh-team__project__list").append(json["content"]);
//       // оновимо зміщення
//       startIndex = json["end"];

//       // перевіримо, чи є ще що завантажити
//       // if (!json["more"]) {
//       //   // якщо ні, сховаємо кнопку завантаження
//       //   jQuery(".acf-loadmore").css("display", "none");
//       // } else {
//       //   jQuery(".acf-loadmore").css("display", "block");
//       // }
//     },
//     "json"
//   );
// }

// loadProjects();
