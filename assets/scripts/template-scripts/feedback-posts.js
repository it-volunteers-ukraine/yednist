jQuery(document).ready((function(e){function n(){e(".loader").show()}function t(){e(".loader").hide()}function c(){var n=e(".feedback-prev"),t=e(".feedback-next");n.prop("disabled",1===d),t.prop("disabled",d===f)}function o(o){var i={action:"load_feedbacks",nonce:myAjax.nonce,width:a,page:o};e.ajax({url:myAjax.ajaxUrl,type:"post",data:i,beforeSend:n,success:function(n){t(),f=n.totalPages,r.html(f),e(".feedback-section__wrapper").html(n.html),c()},error:function(e,n,c){t(),console.error("Request failed: "+c)}})}var a=window.innerWidth||document.documentElement.clientWidth,i=e(".current-page"),r=e(".total-pages"),d=1,f=1;function l(){i.html(d)}e(".feedback-next").click((function(){++d>f&&(d=f),o(d),l(),c()})),e(".feedback-prev").click((function(){--d<1&&(d=1),o(d),l(),c()})),e(".feedback-section__wrapper").swipe({swipeLeft:function(e){d<f&&(o(++d),l())},swipeRight:function(e){d>1&&(o(--d),l())},threshold:75}),o(d),l()}));