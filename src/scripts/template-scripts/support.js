// accordion
const moneysupport_acc = document.getElementsByClassName(
  "moneysupport_accordion"
);

if (moneysupport_acc) {
  for (let i = 0; i < moneysupport_acc.length; i++) {
    moneysupport_acc[i].addEventListener("click", function () {
      this.classList.toggle("active");

      if (this.classList.contains("active")) {
        this.setAttribute("aria-expanded", "true");
      } else this.setAttribute("aria-expanded", "false");

      const panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
}

jQuery(document).ready(function ($) {
  function showLoading() {
    $(".moneysupport__block_desktop").addClass("loading-overlay");
  }

  function hideLoading() {
    $(".moneysupport__block_desktop").removeClass("loading-overlay");
  }

  var current_index = 1;
  $(".support__tab-js[data-current_index='" + current_index + "']").addClass(
    "active"
  );

  $(".support__tab-js").click(function () {
    $(".support__tab-js").removeClass("active");
    $(this).addClass("active");
    current_index = $(this).data("current_index");
    loadDataSupport(current_index);
  });

  function loadDataSupport(current_index) {
    var data = {
      action: "support",
      current_index: current_index,
      nonce: support.nonce,
    };
    $.ajax({
      url: support.url,
      type: "post",
      data: data,
      beforeSend: showLoading,
      success: function (response) {
        hideLoading();
        $(".moneysupport__block_desktop").html(response.html);

        if (current_index === 1) {
          $(".moneysupport__block_desktop").addClass("first_tab");
        } else $(".moneysupport__block_desktop").removeClass("first_tab");
      },
    });
  }

  loadDataSupport(current_index);
});

// copy data
const moneysupportSection = document.querySelector(".moneysupport__section");

moneysupportSection.addEventListener("click", onCopyBtnClick);

function onCopyBtnClick(e) {
  const currentBtn = e.target;

  if (e.target.className === "icon_copy") {
    var range = document.createRange();
    range.selectNode(currentBtn.parentNode);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();

    currentBtn.children[1].classList.add("checked");
    setTimeout(() => {
      currentBtn.children[1].classList.remove("checked");
    }, "2000");
  }
}
