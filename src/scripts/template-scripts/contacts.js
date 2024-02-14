const popupSuccess = document.getElementById("popup-success");
const popupMessage = document.querySelector(".popup")
const closeButtonForm = document.querySelector('.popup__close');
const errorPhone = document.querySelector('.error-phone');
const submitButton = document.getElementById("submit-btn");
const formContacts = document.querySelector(".form__contacts");
const telInputEl = document.getElementById("phone");


//validate mask-phone==================================
formContacts.addEventListener( 'wpcf7submit', function( event ) {
    const value = telInputEl.value;    
    const pattern = /^[\+]?\d{2}[\s|-]?\(?\d{2}?\)?[\s]?\d{3}[\s|-]?\d{2}[\s|-]?\d{2}$/;
    check = pattern.test(value);
    
    if (!check) {   
        errorPhone.classList.add('opened', 'wpcf7-not-valid-tip'); 
        telInputEl.classList.add('error', 'wpcf7-not-valid'); 
    }  

    telInputEl.onfocus = () => {
        const isErrorField = telInputEl.classList.contains("error");
        if (isErrorField) {            
            errorPhone.classList.remove('opened', 'error-phone');
            errorPhone.classList.add('closen');
            telInputEl.classList.remove('error', 'wpcf7-not-valid');     
        } 
    }  
      
}, false );

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
  });
