document.addEventListener("DOMContentLoaded",(function(){const e=document.getElementsByClassName("schedule-accordion");for(let t=0;t<e.length;t++)e[t].addEventListener("click",(function(){this.classList.toggle("active"),this.classList.contains("active")?this.setAttribute("aria-expanded","true"):this.setAttribute("aria-expanded","false");const e=this.nextElementSibling;e.style.maxHeight?e.style.maxHeight=null:e.style.maxHeight=e.scrollHeight+"px"}));const t=document.querySelectorAll(".one-activity-js"),n=t.length,i=document.querySelector(".activities__wrapper"),c=document.getElementById("activity_placeholder-js");let s=1;function o(){let e=3;return window.innerWidth<1220&&(e=2),window.innerWidth<768&&(e=1),e}let l=Math.ceil(n/o());function d(){const e=document.querySelector(".activities-prev"),t=document.querySelector(".activities-next");e.disabled=1===s,t.disabled=s===l}function a(){const e=document.querySelector(".bullets").children,t=e[s-1];if(t){for(let t=0;t<e.length;t++)e[t].classList.remove("active");t.classList.add("active")}}function r(){u(),window.innerWidth>1220&&n<3&&(i.style.justifyContent="center",i.style.gap="80px"),l=Math.ceil(n/o()),s=1,function(){const e=document.querySelector(".activities-pagination__block");1===l||c?e.classList.add("hidden"):e.classList.remove("hidden")}(),d(),function(){const e=document.querySelector(".bullets");if(e.innerHTML="",l>1){for(let t=1;t<=l;t++){const t=document.createElement("div");t.classList.add("one-bullet"),e.appendChild(t)}a()}}(),a()}function u(){t.forEach(((e,t)=>{t>=(s-1)*o()&&t<s*o()?(e.style.display="block",i.classList.remove("is-hidden")):e.style.display="none"}))}n>0&&(r(),window.addEventListener("resize",throttle(r,200)));const h=document.querySelector(".activities-next"),m=document.querySelector(".activities-prev");h.addEventListener("click",(function(){s++,s>l&&(s=l),u(),a(),d()})),m.addEventListener("click",(function(){s--,s<1&&(s=1),u(),a(),d()})),document.querySelector(".bullets").addEventListener("click",(function(e){if(e.target.classList.contains("one-bullet")){document.querySelector(".one-bullet.active").classList.remove("active");const t=Array.from(this.children).indexOf(e.target);s=t+1,u(),d(),a()}}));const v=document.querySelector(".lastnews_select");if(v){new Choices(v,{searchEnabled:!1,allowHTML:!1,shouldSort:!1,position:"bottom",itemSelectText:""})}}));