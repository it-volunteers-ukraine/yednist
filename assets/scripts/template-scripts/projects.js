document.addEventListener("DOMContentLoaded",(function(){new Swiper(".projects__swiper",{slidesPerView:5,spaceBetween:20,direction:"vertical",lazy:{loadOnTransitionStart:!0,loadPrevNext:!0},pagination:{el:".swiper-pagination",type:"fraction"},navigation:{nextEl:".custom-button-next",prevEl:".custom-button-prev"},breakpoints:{576:{pagination:{clickable:!0,type:"bullets",renderBullet:function(e,t){return'<span class="'+t+'">'+(e+1)+"</span>"}},navigation:{nextEl:".custom-button-next",prevEl:".custom-button-prev"}},992:{slidesPerView:5,spaceBetween:40,pagination:{clickable:!0,type:"bullets",renderBullet:function(e,t){return'<span class="'+t+'">'+(e+1)+"</span>"}}},1440:{slidesPerView:5,spaceBetween:60,pagination:{clickable:!0,type:"bullets",renderBullet:function(e,t){return'<span class="'+t+'">'+(e+1)+"</span>"}}}}}).slides.forEach(((e,t)=>{t%3==0?e.classList.add("yellow"):t%3==1?e.classList.add("pink"):e.classList.add("blue")}))}));