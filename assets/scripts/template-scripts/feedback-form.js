const openFeedbackFormButton=document.getElementById("js-open-feedback-form"),closeFeedbackFormButton=document.getElementById("js-close-feedback-form"),feedbackBackdrop=document.getElementById("js-feedback-form"),feedbackModalEl=document.querySelector(".feedback-modal");if(openFeedbackFormButton){openFeedbackFormButton.addEventListener("click",showMenu);let e=window.innerHeight;const o=getComputedStyle(feedbackModalEl),c=Number.parseInt(o.height);function lookForSizeChanges(o){e=window.innerHeight,screenOrientation(e)}function screenOrientation(e){c>e?feedbackModalEl.classList.add("horizontal"):feedbackModalEl.classList.remove("horizontal")}function showMenu(){const o=window.scrollY;feedbackBackdrop.classList.remove("is-hidden"),screenOrientation(e),closeFeedbackFormButton.addEventListener("click",hideMenu),feedbackBackdrop.addEventListener("click",closeByBgdClick),window.addEventListener("keydown",closeByPressEscape),window.addEventListener("resize",lookForSizeChanges),document.body.style.position="fixed",document.body.style.top=`-${o}px`}function hideMenu(){feedbackBackdrop.classList.add("is-hidden"),closeFeedbackFormButton.removeEventListener("click",hideMenu),feedbackBackdrop.removeEventListener("click",closeByBgdClick),feedbackModalEl.classList.remove("horizontal");const e=document.body.style.top;document.body.style.position="",document.body.style.top="",window.scrollTo(0,-1*parseInt(e||"0"))}function closeByBgdClick(e){e.target===feedbackBackdrop&&hideMenu()}function closeByPressEscape(e){e.preventDefault,"Escape"===e.code&&(hideMenu(),window.removeEventListener("keydown",closeByPressEscape))}}const feedbackForm=document.getElementById("acf-field_65c9c24452e5e-field_65c92299c6ba0"),additionalField=document.querySelector(".acf-field-65c923c92be46"),choicesFeedbackForm=new Choices(feedbackForm,{placeholderValue:"Виберіть програму...",searchEnabled:!1,allowHTML:!1,shouldSort:!1,position:"bottom",itemSelectText:""}),innerChoises=document.querySelector(".acf-field-65c92299c6ba0 .choices__inner"),choicesLength=choicesFeedbackForm.config.choices.length;choicesFeedbackForm.passedElement.element.addEventListener("choice",(function(e){e.detail.choice.active?(console.log(innerChoises),innerChoises.classList.add("valid"),innerChoises.classList.remove("invalid")):(innerChoises.classList.add("invalid"),innerChoises.classList.remove("valid")),e.detail.choice.id===choicesLength&&additionalField.classList.add("shown")}),!1);