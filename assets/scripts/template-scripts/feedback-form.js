document.addEventListener("DOMContentLoaded",(function(){const e=document.getElementById("js-open-feedback-form"),t=document.getElementById("js-close-feedback-form"),n=document.getElementById("js-feedback-form"),c=document.querySelector(".feedback-modal");if(e){e.addEventListener("click",(function(){const e=window.scrollY;n.classList.remove("is-hidden"),o(r),t.addEventListener("click",i),n.addEventListener("click",l),window.addEventListener("keydown",s),window.addEventListener("resize",d),document.documentElement.classList.add("modal__opened"),document.documentElement.style.top=`-${e}px`}));let r=window.innerHeight;const u=getComputedStyle(c),f=Number.parseInt(u.height);function d(e){r=window.innerHeight,o(r)}function o(e){f>e?c.classList.add("horizontal"):c.classList.remove("horizontal")}function i(){n.classList.add("is-hidden"),t.removeEventListener("click",i),n.removeEventListener("click",l),c.classList.remove("horizontal");const e=document.documentElement.style.top;document.documentElement.classList.remove("modal__opened"),document.documentElement.style.top="",window.scrollTo(0,-1*parseInt(e||"0"))}function l(e){e.target===n&&i()}function s(e){e.preventDefault,"Escape"===e.code&&(i(),window.removeEventListener("keydown",s))}}const a=document.getElementById("acf-field_65c9c24452e5e-field_65c92299c6ba0"),m=document.querySelector(".acf-field-65c923c92be46");if(a){const v=new Choices(a,{placeholderValue:"Виберіть програму...",searchEnabled:!1,allowHTML:!1,shouldSort:!1,position:"bottom",itemSelectText:""}),E=document.querySelector(".acf-field-65c92299c6ba0 .choices__inner"),L=v.config.choices.length;v.passedElement.element.addEventListener("choice",(function(e){e.detail.choice.active?E.classList.add("valid"):E.classList.remove("valid"),e.detail.choice.id===L&&m.classList.add("shown")}),!1);const h=document.getElementById("acf-field_65c9c24452e5e-field_65c922051068c-field_65c91dcb08837");h.addEventListener("keyup",(function(){h.value=h.value.replace(/\d/g,"")}));document.getElementById("acf-field_65c9c24452e5e-field_65c922051068c-field_65c91df7fe472")}}));