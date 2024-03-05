window.addEventListener('DOMContentLoaded', () => {

    const resizableSwiper = (breakpoint, swiperClass, swiperSettings, callback) => {

        let swiper;

        breakpoint = window.matchMedia(breakpoint);

        const enableSwiper = function (className, settings) {

            swiper = new Swiper(className, settings);

            if (callback) {
                callback(swiper);
            }
        }

        const checker = function () {
            if (breakpoint.matches) {
                return enableSwiper(swiperClass, swiperSettings);
            } else {
                if (swiper !== undefined) swiper.destroy(true, true);
                return;
            }
        }

        breakpoint.addEventListener('change', checker);
        checker();
    }


    const commonSwiperSettings = {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    };


    resizableSwiper(
        '(max-width:575px)',
        '.team_slider',
        {
            ...commonSwiperSettings,
            slidesPerView: 1
        }
    )


    resizableSwiper(
        '(max-width:991px)',
        '.team_slider',
        {
            ...commonSwiperSettings,
            slidesPerView: 2,
        }
    )

})










