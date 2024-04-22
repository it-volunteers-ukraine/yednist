//Documents-section=================
document.querySelector('.about-button-show').onclick = () => {
    document.querySelector('.about__documents-part').style.display = 'none';
    document.querySelector('.about__documents-all').style.display = 'block';       
}

document.querySelector('.about-button-hide').onclick = () => {
    document.querySelector('.about__documents-part').style.display = 'block';
    document.querySelector('.about__documents-all').style.display = 'none';       
}
