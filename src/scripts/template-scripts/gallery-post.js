/*lightbox gallery===================================*/
document.querySelectorAll('.galery-post__img img').forEach(img => {
    img.onclick = () => {
        document.querySelector('.galery-pop-up').style.display = 'block';
        document.querySelector('.galery-pop-up img').src = img.getAttribute('src');
    }
});

document.querySelector('.galery-pop-up span').onclick = () => {
    document.querySelector('.galery-pop-up').style.display = 'none';
}
