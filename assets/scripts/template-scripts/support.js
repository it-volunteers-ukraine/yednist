const moneysupport_acc=document.getElementsByClassName("moneysupport_accordion");if(moneysupport_acc)for(let e=0;e<moneysupport_acc.length;e++)moneysupport_acc[e].addEventListener("click",(function(){this.classList.toggle("active"),this.classList.contains("active")?this.setAttribute("aria-expanded","true"):this.setAttribute("aria-expanded","false");const e=this.nextElementSibling;e.style.maxHeight?(e.style.paddingBottom="0",e.style.maxHeight=null):(e.style.paddingBottom="24px",e.style.maxHeight=e.scrollHeight+"px")}));jQuery(document).ready((function(e){function t(){e(".moneysupport__block_desktop").addClass("loading-overlay")}var o=1;function s(o){var s={action:"support",current_index:o,nonce:support.nonce};e.ajax({url:support.url,type:"post",data:s,beforeSend:t,success:function(t){e(".moneysupport__block_desktop").removeClass("loading-overlay"),e(".moneysupport__block_desktop").html(t.html),1===o?e(".moneysupport__block_desktop").addClass("first_tab"):e(".moneysupport__block_desktop").removeClass("first_tab")}})}e(".support__tab-js[data-current_index='"+o+"']").addClass("active"),e(".support__tab-js").click((function(){e(".support__tab-js").removeClass("active"),e(this).addClass("active"),s(o=e(this).data("current_index"))})),s(o)}));const moneysupportSection=document.querySelector(".moneysupport__section");function onCopyBtnClick(e){const t=e.target;if("icon_copy"===e.target.className){var o=document.createRange();o.selectNode(t.parentNode),window.getSelection().removeAllRanges(),window.getSelection().addRange(o),document.execCommand("copy"),window.getSelection().removeAllRanges(),t.children[1].classList.add("checked"),setTimeout((()=>{t.children[1].classList.remove("checked")}),"2000")}}moneysupportSection.addEventListener("click",onCopyBtnClick);