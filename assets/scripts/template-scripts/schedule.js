document.addEventListener("DOMContentLoaded",(function(){const e=document.getElementsByClassName("schedule-accordion");for(let t=0;t<e.length;t++)e[t].addEventListener("click",(function(){this.classList.toggle("active"),this.classList.contains("active")?this.setAttribute("aria-expanded","true"):this.setAttribute("aria-expanded","false");const e=this.nextElementSibling;e.style.maxHeight?e.style.maxHeight=null:e.style.maxHeight=e.scrollHeight+"px"}));const t=document.querySelectorAll(".one-activity-js"),n=t.length,i=document.querySelector(".activities__wrapper");let c=1;function s(){let e=3;return window.innerWidth<1220&&(e=2),window.innerWidth<768&&(e=1),e}let o=Math.ceil(n/s());function l(){const e=document.querySelector(".activities-prev"),t=document.querySelector(".activities-next");e.disabled=1===c,t.disabled=c===o}function a(){const e=document.querySelector(".bullets").children,t=e[c-1];if(t){for(let t=0;t<e.length;t++)e[t].classList.remove("active");t.classList.add("active")}}function d(){window.innerWidth>1220&&n<3&&(i.style.justifyContent="center",i.style.gap="80px"),r(),o=Math.ceil(n/s()),c=1,function(){const e=document.querySelector(".activities-pagination__block");1===o?e.classList.add("hidden"):e.classList.remove("hidden")}(),l(),function(){const e=document.querySelector(".bullets");if(e.innerHTML="",o>1){for(let t=1;t<=o;t++){const t=document.createElement("div");t.classList.add("one-bullet"),e.appendChild(t)}a()}}(),a()}function r(){t.forEach(((e,t)=>{t>=(c-1)*s()&&t<c*s()?(e.style.display="block",i.classList.remove("is-hidden")):e.style.display="none"}))}n>0&&(d(),window.addEventListener("resize",throttle(d,200)));const u=document.querySelector(".activities-next"),h=document.querySelector(".activities-prev");u.addEventListener("click",(function(){c++,c>o&&(c=o),r(),a(),l()})),h.addEventListener("click",(function(){c--,c<1&&(c=1),r(),a(),l()})),document.querySelector(".bullets").addEventListener("click",(function(e){if(e.target.classList.contains("one-bullet")){document.querySelector(".one-bullet.active").classList.remove("active");const t=Array.from(this.children).indexOf(e.target);c=t+1,r(),l(),a()}}));const m=document.querySelector(".lastnews_select");if(m){new Choices(m,{searchEnabled:!1,allowHTML:!1,shouldSort:!1,position:"bottom",itemSelectText:""})}}));