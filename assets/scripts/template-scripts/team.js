const buttons=document.querySelectorAll(".show-info");let teamSwiper=null,aboutTeamSwiper=null,initMobile=!1,initTablet=!1;function swiperMode(){const e=window.matchMedia("(min-width: 0) and (max-width: 575px)"),i=window.matchMedia("(min-width: 576px) and (max-width: 991px)"),t=window.matchMedia("(min-width: 1025px)");e.matches?initMobile||(initMobile=!0,initTablet=!1,teamSwiper&&teamSwiper.destroy(),aboutTeamSwiper&&aboutTeamSwiper.destroy(),teamSwiper=new Swiper(".team_slider",{loop:!0,autoplay:{delay:2e3,disableOnInteraction:!1},speed:800,effect:"opacity",fadeEffect:{crossFade:!0},pagination:{el:".swiper-custom-pagination"},slideToClickedSlide:!1,slidesPerView:1}),aboutTeamSwiper=new Swiper(".about-team_slider",{loop:!1,pagination:{el:".swiper-custom-pagination"},speed:800,slidesPerView:1,spaceBetween:10,grid:{rows:2}})):i.matches?initTablet||(initTablet=!0,initMobile=!1,teamSwiper&&teamSwiper.destroy(),aboutTeamSwiper&&aboutTeamSwiper.destroy(),teamSwiper=new Swiper(".team_slider",{loop:!0,autoplay:{delay:2e3,disableOnInteraction:!1},speed:800,effect:"opacity",fadeEffect:{crossFade:!0},pagination:{el:".swiper-custom-pagination"},slideToClickedSlide:!1,slidesPerView:1,breakpoints:{576:{slidesPerView:2,spaceBetween:28}}})):t.matches&&(teamSwiper&&teamSwiper.destroy(),aboutTeamSwiper&&aboutTeamSwiper.destroy(),initTablet=!1,initMobile=!1)}function showInfo(e){const i=e.currentTarget,t=i.nextElementSibling;i.classList.toggle("active"),t.style.display=i.classList.contains("active")?"block":"none"}window.addEventListener("DOMContentLoaded",(function(){swiperMode()})),window.addEventListener("resize",(function(){swiperMode()})),buttons.forEach((function(e){e.addEventListener("click",(function(e){showInfo(e)}))}));