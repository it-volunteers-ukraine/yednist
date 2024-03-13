let swiper = Swiper;
let init = false;


function swiperMode() {


    const mobile = window.matchMedia('(min-width: 0) and (max-width: 575px)');
    const tablet = window.matchMedia('(min-width: 576px) and (max-width: 991px)');
    const desktop = window.matchMedia('(min-width: 1025px)');


    if (mobile.matches || tablet.matches) {

        if (!init) {

            init = true;

            swiper = new Swiper('.team_slider', {
                loop: true,
                autoplay: {
                    delay: 2000,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                slidesPerView: 1,
                observer: true,
                observeParents: true,
                autoWidth: false,
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 28,
                    },
                },
            });

        }
    } else if (desktop.matches) {

        swiper.destroy();
        init = false;
    }
}


window.addEventListener('load', function () {
    swiperMode();
});


window.addEventListener('resize', function () {
    swiperMode();
});











