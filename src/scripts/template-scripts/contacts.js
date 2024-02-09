const popupSuccess = document.getElementById("popup-success");
const popupMessage = document.querySelector(".popup")
const closeButton = document.querySelector('.popup__close');
const errorPhone = document.querySelector('.error-phone');
const submitButton = document.getElementById("submit-btn");
const formContacts = document.querySelector(".form__contacts");
const telInputEl = document.getElementById("phone");
// const nameInputEl = document.getElementById("name");

//validate mask-phone==================================
formContacts.addEventListener( 'wpcf7submit', function( event ) {
    const value = telInputEl.value;    
    const pattern = /^[\+]?\d{2}[\s|-]?\(?\d{2}?\)?[\s]?\d{3}[\s|-]?\d{2}[\s|-]?\d{2}$/;
    check = pattern.test(value);
    
    if (!check) {
        errorPhone.innerHTML = "The phone number must contain 12 digits";
        errorPhone.classList.add('wpcf7-not-valid-tip'); 
        telInputEl.classList.add('error'); 
    }  

    telInputEl.onfocus = () => {
        const isErrorField = telInputEl.classList.contains("error");
        if (isErrorField) {
            errorPhone.innerHTML = "";
            errorPhone.classList.remove('error-phone');        
        } 
    }  
      
}, false );

//wpcf7mailsent + pop-up==========================================
formContacts.addEventListener( 'wpcf7mailsent', function( event ) {
    popupMessage.classList.add('opened');
    document.body.classList.add('modal-open'); 

    closeButton.onclick = () => {  
        popupMessage.classList.remove('opened');
        popupMessage.classList.add('closen'); 
        document.body.classList.remove('modal-open');   
    }  
}, false );
