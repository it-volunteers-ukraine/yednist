const moneysupport_acc=document.getElementsByClassName("moneysupport_accordion");if(moneysupport_acc)for(let t=0;t<moneysupport_acc.length;t++)moneysupport_acc[t].addEventListener("click",(function(){this.classList.toggle("active"),this.classList.contains("active")?this.setAttribute("aria-expanded","true"):this.setAttribute("aria-expanded","false");const t=this.nextElementSibling;t.style.maxHeight?t.style.maxHeight=null:t.style.maxHeight=t.scrollHeight+"px"}));jQuery(document).ready((function(t){t(".support__tab-js").click((function(){var e=t(this).data("index");console.log(e)}))}));