document.addEventListener("DOMContentLoaded",(function(){const e=document.getElementsByClassName("schedule-accordion");for(let t=0;t<e.length;t++)e[t].addEventListener("click",(function(){this.classList.toggle("active"),this.classList.contains("active")?this.setAttribute("aria-expanded","true"):this.setAttribute("aria-expanded","false");const e=this.nextElementSibling;e.style.maxHeight?e.style.maxHeight=null:e.style.maxHeight=e.scrollHeight+"px"}));const t=document.querySelectorAll(".one-activity-js"),n=t.length;let i=1;function c(){let e=3;return window.innerWidth<1220&&(e=2),window.innerWidth<768&&(e=1),e}const s=Math.ceil(n/c());function o(){const e=document.querySelector(".activities-prev"),t=document.querySelector(".activities-next");e.disabled=1===i,t.disabled=i===s}function l(){const e=document.querySelector(".bullets").children,t=e[i-1];for(let t=0;t<e.length;t++)e[t].classList.remove("active");t.classList.add("active")}function a(){t.forEach(((e,t)=>{t>=(i-1)*c()&&t<i*c()?e.style.display="block":e.style.display="none"}))}a(),function(){const e=document.querySelector(".activities-pagination__block");1===s&&e.classList.add("hidden")}(),o(),function(){const e=document.querySelector(".bullets");if(e.innerHTML="",s>1){for(let t=1;t<=s;t++){const t=document.createElement("div");t.classList.add("one-bullet"),e.appendChild(t)}l()}}(),l();const r=document.querySelector(".activities-next"),d=document.querySelector(".activities-prev");r.addEventListener("click",(function(){i++,i>s&&(i=s),a(),l(),o()})),d.addEventListener("click",(function(){i--,i<1&&(i=1),a(),l(),o()})),document.querySelector(".bullets").addEventListener("click",(function(e){if(e.target.classList.contains("one-bullet")){document.querySelector(".one-bullet.active").classList.remove("active");const t=Array.from(this.children).indexOf(e.target);i=t+1,a(),o(),l()}}));const u=document.querySelector(".activities__wrapper");u.addEventListener("touchstart",(function(e){const t=e.touches[0];h=t.clientX}),!1),u.addEventListener("touchmove",(function(e){if(!h)return;let t=e.touches[0].clientX;h-t>0?i<s&&(i++,a(),l(),o()):i>1&&(i--,a(),l(),o());h=null}),!1);let h=null}));