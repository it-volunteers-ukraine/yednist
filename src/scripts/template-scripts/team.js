const buttons = document.querySelectorAll('.show-info');


let teamSwiper = null;

let aboutTeamSwiper = null;

let initMobileOrTablet = false;

let initMobile = false;


function swiperMode() {


    const mobile = window.matchMedia('(min-width: 0) and (max-width: 575px)');
    const tablet = window.matchMedia('(min-width: 576px) and (max-width: 991px)');
    const desktop = window.matchMedia('(min-width: 1025px)');


    if (mobile.matches || tablet.matches) {

        if (!initMobileOrTablet) {

            initMobileOrTablet = true;

            teamSwiper = new Swiper('.team_slider', {
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                speed: 800,
                effect: 'opacity',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-custom-pagination',
                },
                slideToClickedSlide: false,
                slidesPerView: 1,
                autoWidth: false,
                initialSlide: 0,
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 28,
                    },
                },
            });


        }


        if (mobile.matches) {

            if (!initMobile) {

                initMobile = true;

                aboutTeamSwiper = new Swiper('.about-team_slider', {
                    loop: false,
                    pagination: {
                        el: '.swiper-custom-pagination',
                    },
                    speed: 800,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    grid: {
                        rows: 2,
                    },
                });
            }
        }
    } else if (desktop.matches) {
        teamSwiper.destroy();
        aboutTeamSwiper.destroy();
        initMobileOrTablet = false;
        initMobile = false;
    }
    if (tablet.matches) {
        aboutTeamSwiper.destroy();
        initMobile = false;
    }
}


window.addEventListener('load', function () {
    swiperMode();
});
window.addEventListener('resize', function () {
    swiperMode();
});


function showInfo(event) {

    const targetButton = event.currentTarget;

    const infoByButton = targetButton.nextElementSibling;


    targetButton.classList.toggle('active');


    infoByButton.style.display = (targetButton.classList.contains('active')) ? 'block' : 'none';


    if (!targetButton.classList.contains('active')) {
        targetButton.classList.add('inactive');
    } else {
        targetButton.classList.remove('inactive');
    }

}


buttons.forEach(function (button) {
    button.addEventListener("click", function (event) {
        showInfo(event);
    })
})











