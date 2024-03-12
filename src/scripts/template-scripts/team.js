const teamSwiper = new Swiper(".swiper", {
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    spaceBetween: 30,
    loop: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
            enabled: true
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 28,
            enabled: true,
        },
        1199: {
            slidesPerView: 2,
            spaceBetween: 28,
            enabled: true,
            grid: {
                rows: 3,
            },
        },
        1200: {
            enabled: false,
            grid: {
                rows: 3,
            },
            slidesPerView: 3,
        }
    },
})









