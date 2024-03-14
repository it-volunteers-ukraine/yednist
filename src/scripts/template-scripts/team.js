

const buttons = document.querySelectorAll('.show-info');

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





