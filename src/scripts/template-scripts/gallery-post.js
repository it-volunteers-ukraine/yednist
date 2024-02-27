//Checking a text field for text========================================================
const galeryPostText = document.querySelector('.galery-post__text');
if (galeryPostText.textContent.trim().length != 0) {
    document.querySelector('.galery-post__content').style.display = 'block';
} 


//lightbox gallery=======================================================================
document.querySelectorAll('.galery-post__img img').forEach(img => {
    img.onclick = () => {
        document.querySelector('.galery-pop-up').style.display = 'block';
        document.querySelector('.galery-pop-up img').src = img.getAttribute('src');
        document.body.classList.add('modal-open'); 
    }
});

document.querySelector('.galery-pop-up span').onclick = () => {
    document.querySelector('.galery-pop-up').style.display = 'none';
    document.body.classList.remove('modal-open');   
}


//Galery-pop-up__swiper================================//
const gallerySwiper = new Swiper('.galery-pop-up__swiper', {    
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },    
    slidesPerView: 1,  
    spaceBetween: 12,     
});  
gallerySwiper.update();
