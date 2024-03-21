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
  $(".support__tab-js").click(function () {
    var index = $(this).data("index");
    console.log(index);
  });
});
