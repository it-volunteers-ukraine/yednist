const buttons = document.querySelectorAll('.show-info');


let teamSwiper = null;
let aboutTeamSwiper = null;

let initMobile = false;
let initTablet = false;


let teamSlider = document.querySelector('.team_slider');
let slides = teamSlider.querySelectorAll('.swiper-slide');


function swiperMode() {


    const mobile = window.matchMedia('(min-width: 0) and (max-width: 575px)');
    const tablet = window.matchMedia('(min-width: 576px) and (max-width: 991px)');
    const desktop = window.matchMedia('(min-width: 992px) and (max-width:1440px)');
    const full = window.matchMedia('(min-width: 1441px) and (max-width:1920px)');


    if (mobile.matches) {

        if (!initMobile) {

            initMobile = true;
            initTablet = false;

            if (teamSwiper) {
                teamSwiper.destroy();
            }

            if (aboutTeamSwiper) {
                aboutTeamSwiper.destroy();
            }

            teamSwiper = new Swiper('.team_slider', {
                speed: 650,
                effect: 'opacity',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-custom-pagination',
                    clickable: true,
                },
                slideToClickedSlide: false,
                slidesPerView: 1,
            });


            aboutTeamSwiper = new Swiper('.about-team_slider', {
                loop: false,
                pagination: {
                    el: '.swiper-custom-pagination',
                    clickable: true,
                },
                speed: 800,
                slidesPerView: 1,
                spaceBetween: 12,
                grid: {
                    rows: 2,
                },
            });
        }
    } else if (tablet.matches) {
        if (!initTablet) {

            initTablet = true;
            initMobile = false;

            if (teamSwiper) {
                teamSwiper.destroy();
            }

            if (aboutTeamSwiper) {
                aboutTeamSwiper.destroy();
            }

            teamSwiper = new Swiper('.team_slider', {
                speed: 800,
                effect: 'opacity',
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-custom-pagination',
                    clickable: true,
                },
                slideToClickedSlide: false,
                slidesPerView: 1,
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                        spaceBetween: 28,
                    },
                },
            });
        }
    } else if (desktop.matches || full.matches) {
        if (teamSwiper) {
            teamSwiper.destroy();
        }

        if (aboutTeamSwiper) {
            aboutTeamSwiper.destroy();
        }

        initTablet = false;
        initMobile = false;
    }
}


window.addEventListener('DOMContentLoaded', function () {
    swiperMode();
});
window.addEventListener('resize', function () {
    swiperMode();
});


function addColorForCards() {


    slides.forEach(function (slide, index) {
        let lastIndex = slides.length - 1;
        if (index === 0 || index === lastIndex) {
            slide.classList.add('blue');
        } else if ((index + 1) % 2 === 0) {
            slide.classList.add('yellow');
        } else {
            slide.classList.add('pink');
        }
    })

}

addColorForCards()

function showInfo(event) {

    const targetButton = event.currentTarget;

    const flipCard = targetButton.closest('.flip-card');

    const infoByButton = flipCard.querySelector('.flip-card-back');

    const flipInner = flipCard.querySelector('.flip-card-inner')

    const isMobile = window.innerWidth < 991.98;


    if (isMobile) {
        flipInner.classList.add('flipped');
    }


    infoByButton.addEventListener('click', function () {
        if (isMobile) {
            flipInner.classList.remove('flipped');
        }
    })

}


buttons.forEach(function (button) {
    button.addEventListener("click", function (event) {
        showInfo(event);
    })
})












