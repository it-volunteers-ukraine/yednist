document.addEventListener("DOMContentLoaded",(function(){new Swiper(".projects__section__swiper",{slidesPerView:1,spaceBetween:20,autoHeight:!0,lazy:{loadOnTransitionStart:!0,loadPrevNext:!0},pagination:{el:".swiper-pagination",type:"fraction"},navigation:{nextEl:".custom-button-next",prevEl:".custom-button-prev"},breakpoints:{576:{pagination:{clickable:!0,type:"bullets",renderBullet:function(e,t){return'<span class="'+t+'">'+(e+1)+"</span>"}},navigation:{nextEl:".custom-button-next",prevEl:".custom-button-prev"}},992:{slidesPerView:1,spaceBetween:40,pagination:{clickable:!0,type:"bullets",renderBullet:function(e,t){return'<span class="'+t+'">'+(e+1)+"</span>"}}},1441:{slidesPerView:1,spaceBetween:60,pagination:{clickable:!0,type:"bullets",renderBullet:function(e,t){return'<span class="'+t+'">'+(e+1)+"</span>"}}}}});const e=document.querySelectorAll(".projects__section .swiper-pagination-bullet"),t=document.querySelector(".projects__section .custom-button-prev"),n=document.querySelector(".projects__section .custom-button-next");function o(){window.scrollTo({top:0,behavior:"smooth"})}0!==e.length&&(e.forEach((e=>{e.addEventListener("click",o)})),t.addEventListener("click",o),n.addEventListener("click",o))}));