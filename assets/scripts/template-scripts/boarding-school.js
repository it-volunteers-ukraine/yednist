document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelector(".main__section__content__image"),n=document.getElementById("videoModal");e.addEventListener("click",(function(){n.style.display="flex"})),window.onclick=function(e){e.target==n&&(n.style.display="none")};const i=window.matchMedia("(max-width: 575.98px)");function t(){if(i.matches){new Swiper(".appeal__swiper",{slidesPerView:3,slidesPerGroup:3,spaceBetween:12,grabCursor:!0,direction:"horizontal",pagination:{el:".swiper-pagination",type:"bullets",clickable:!0}}),new Swiper(".goals__section__swiper",{slidesPerView:1,centeredSlides:!0,spaceBetween:20,grabCursor:!0,direction:"horizontal",pagination:{el:".swiper-pagination",type:"bullets",clickable:!0}})}}t(),i.addEventListener("change",t)}));