document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll(".shop-section .product");if(e){e.forEach((e=>{e.classList.add("swiper-slide")}));new Swiper(".shop-section__slider",{slidesPerView:2,slidesPerGroup:2,spaceBetween:16,pagination:{el:".shop-section__bullets",clickable:!0,slideToClickedSlide:!0},breakpoints:{576:{slidesPerView:2,slidesPerGroup:2,spaceBetween:46},992:{slidesPerView:3,slidesPerGroup:3,spaceBetween:68},1441:{slidesPerView:3,slidesPerGroup:3,spaceBetween:94}}})}(()=>{const e=document.querySelectorAll(".variations select");e.length&&e.forEach((e=>{const s=function(e){const s=document.createElement("div"),t=document.createElement("div");s.classList.add("custom_select_wrap"),t.classList.add("custom_option_wrap"),e.length&&e.forEach(((e,n)=>{const c=document.createElement("span");if(c.innerHTML=e.innerHTML,1==n){const n=document.createElement("span");c.classList.add("active"),n.classList.add("main"),n.innerHTML=e.innerHTML,s.append(n),t.append(c)}else t.append(c)}));return s.append(t),s}(e.querySelectorAll("option"));e.closest(".value").append(s),s.addEventListener("click",(()=>{const e=s.querySelector("span.main"),t=s.querySelectorAll(".custom_option_wrap span");t.length&&t.forEach(((s,n)=>{s.addEventListener("click",(()=>{if(!s.classList.contains("active")){const c=s.closest(".value");let i=c?c.querySelector("select"):null;i&&(i.selectedIndex=n,i.dispatchEvent(new Event("change",{bubbles:!0})),t.forEach((e=>e.classList.remove("active"))),e.innerHTML=s.innerHTML,s.classList.add("active"))}}))})),s.classList.toggle("open")}))}))})()}));