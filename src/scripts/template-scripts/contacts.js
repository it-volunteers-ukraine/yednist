const popupSuccess = document.getElementById("popup-success");
const popupMessage = document.querySelector(".popup")
const closeButtonForm = document.querySelector('.popup__close');
const submitButton = document.getElementById("submit-btn");
const formContacts = document.querySelector(".form__contacts");

//wpcf7mailsent + pop-up==========================================
formContacts.addEventListener( 'wpcf7mailsent', function( event ) {
    popupMessage.classList.add('opened');
    document.body.classList.add('modal-open'); 

    closeButtonForm.onclick = () => {  
        popupMessage.classList.remove('opened');
        popupMessage.classList.add('closen'); 
        document.body.classList.remove('modal-open');   
    }  
}, false );


//wpcf7select + plagin choices.js==========================================
const element = document.querySelector('.contacts__form-theme');
  const choices = new Choices(element, {
    searchEnabled: false,  
    allowHTML: false,  
    shouldSort: false,
    position: 'bottom',
    itemSelectText: '',
  });
