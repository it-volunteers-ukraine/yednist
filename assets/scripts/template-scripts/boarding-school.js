document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelector(".main__section__content__image"),t=document.getElementById("mainVideoModal");e.addEventListener("click",(function(){t.style.display="flex"})),window.onclick=function(e){e.target==t&&(t.style.display="none")};const i=window.matchMedia("(max-width: 575.98px)");function n(){if(i.matches){new Swiper(".appeal__swiper",{slidesPerView:3,slidesPerGroup:3,spaceBetween:12,grabCursor:!0,direction:"horizontal",pagination:{el:".swiper-pagination",type:"bullets",clickable:!0}}),new Swiper(".goals__section__swiper",{slidesPerView:1,centeredSlides:!0,spaceBetween:20,grabCursor:!0,direction:"horizontal",pagination:{el:".swiper-pagination",type:"bullets",clickable:!0}})}}n(),i.addEventListener("change",n);const o=document.querySelectorAll(".years__section__timeline__point__circle"),r=document.querySelectorAll(".years__section__timeline__point__text-wrapper"),a=new IntersectionObserver(((e,t)=>{e.forEach(((e,i)=>{e.isIntersecting&&(setTimeout((()=>{e.target.querySelector(".years__section__timeline__point__circle").style.animation="fill 1s forwards",e.target.querySelector(".years__section__timeline__point__text-wrapper").style.animation="opacity 1s forwards"}),1e3*i),t.unobserve(e.target))}))}),{threshold:.5});o.forEach((e=>{a.observe(e)})),r.forEach((e=>{a.observe(e.parentElement)}))}));