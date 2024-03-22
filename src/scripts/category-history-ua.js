new Swiper('.history-ua-swiper', {
    autoHeight: false,    
    watchOverflow: true, 
    pagination: {
        el: '.swiper-custom-pagination',
        clickable: true,    
    }, 
    navigation: {
        nextEl: '.custom-button-next',
        prevEl: '.custom-button-prev',
    }, 
    breakpoints: {
        320: {
            slidesPerView: 1, 
            spaceBetween: 5,                         
        },        
        992: {          
          slidesPerView: 2,
          spaceBetween: 20, 
        },
    }
});
