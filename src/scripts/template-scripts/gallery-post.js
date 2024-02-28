//Checking a text field for text========================================================
const galeryPostText = document.querySelector('.galery-post__text');
if (galeryPostText.textContent.trim().length != 0) {
    document.querySelector('.galery-post__content').style.display = 'block';
} 
