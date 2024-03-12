jQuery(document).ready(function (e) {
  function t() {
    e(".loader").show(),
      e(".classes__container.mobile").addClass("loading-overlay"),
      e(".classes__container").addClass("loading-overlay");
  }
  function n() {
    e(".loader").hide(),
      e(".classes__container.mobile").removeClass("loading-overlay"),
      e(".classes__container").removeClass("loading-overlay");
  }
  function a() {
    return multicenter_ajax.nonce;
  }
  n();
  var s = "for_all",
    i = s,
    o = e("#loadmore-classes a"),
    c = 1,
    l = o.data("max_pages"),
    r = e(".tab");
  function d(s, i) {
    e.ajax({
      type: "POST",
      url: multicenter_ajax.ajaxUrl,
      data: {
        nonce: a(),
        action: "load_classes",
        paged: 1,
        active_cat: s,
        prev_active_cat: i,
      },
      beforeSend: t,
      success: function (t) {
        n(),
          o.parent().prevAll().remove(),
          o.parent().before(t.html),
          (c = 2),
          (l = t.max_pages),
          c > l ? o.hide() : o.show();
        const a = e(".tab-accordion.active").next();
        a.css("maxHeight", a.prop("scrollHeight") + "px");
      },
      error: function (e, t, n) {
        console.error(e.responseText);
      },
    });
  }
  r.on("click", function (t) {
    var n = e(t.target);
    r.removeClass("tab-active"),
      n.addClass("tab-active"),
      n.data("active") !== i && (d((s = n.data("active")), i), (i = s));
  }),
    d(s, i),
    o.click(function (r) {
      r.preventDefault(),
        (function (s) {
          e.ajax({
            type: "POST",
            url: multicenter_ajax.ajaxUrl,
            data: {
              nonce: a(),
              action: "load_classes",
              paged: c,
              active_cat: s,
              prev_active_cat: i,
            },
            beforeSend: t,
            success: function (t) {
              n(),
                o.parent().before(t.html),
                c++,
                (l = t.max_pages),
                c > l && o.hide();
              const a = e(".tab-accordion.active").next();
              a.css("maxHeight", a.prop("scrollHeight") + "px");
            },
            error: function (e, t, n) {
              console.error(e.responseText);
            },
          });
        })(s);
    });
  const m = multicenter_ajax.theme_directory_uri,
    u = multicenter_ajax.hide_btn,
    v = multicenter_ajax.read_btn;
  document.addEventListener("click", (e) => {
    const t = e.target;
    if ("classes__detais-open" === t.className) {
      const e = t.nextElementSibling,
        n = t.previousElementSibling,
        a = t.parentNode,
        s = a.parentNode.parentNode,
        i = a.children[a.children.length - 1];
      e.classList.contains("hidden")
        ? ((t.innerHTML = `${u}\n        <span class="activity__modal--detais--icon active">\n         <svg>\n          <use href="${m}/assets/images/sprite.svg#icon-small_arrow">\n          </use></svg></span>`),
          e.classList.remove("hidden"),
          i.classList.remove("hidden"),
          n.classList.add("hidden"),
          (s.style.maxHeight = s.scrollHeight + "px"))
        : ((t.innerHTML = `${v}\n        <span class="activity__modal--detais--icon">\n        <svg>\n          <use href="${m}/assets/images/sprite.svg#icon-small_arrow"></use>\n        </svg>\n      </span>`),
          e.classList.add("hidden"),
          i.classList.add("hidden"),
          n.classList.remove("hidden"),
          (s.style.maxHeight = s.scrollHeight + "px"));
    }
  });
  const h = document.getElementsByClassName("tab-accordion");
  for (let b = 0; b < h.length; b++)
    h[b].addEventListener("click", function () {
      const e = document.querySelector(".tab-accordion.active");
      if (e && e !== this) {
        e.classList.remove("active"), e.setAttribute("aria-expanded", "false");
        (e.nextElementSibling.style.maxHeight = null),
          this.parentNode.scrollIntoView({
            behavior: "smooth",
            block: "nearest",
          });
      }
      this.classList.toggle("active"),
        this.scrollIntoView({ behavior: "smooth", block: "nearest" }),
        this.classList.contains("active")
          ? this.setAttribute("aria-expanded", "true")
          : this.setAttribute("aria-expanded", "false");
      const t = this.nextElementSibling;
      t.style.maxHeight
        ? (t.style.maxHeight = null)
        : (t.style.maxHeight = t.scrollHeight + "px");
    });
  const p = document.querySelector(".wpcf7"),
    _ = document.getElementById("invite__backdrop--notification"),
    g = document.getElementById("invite__notification--btn"),
    x = document.getElementById("submit-notification");
  if (p) {
    let y;
    function f() {
      _.classList.add("is-hidden"),
        _.removeEventListener("mousedown", f),
        g.removeEventListener("click", f);
      const e = parseInt(document.documentElement.style.top || "0");
      document.documentElement.classList.remove("modal__opened"),
        window.scrollTo(0, -e),
        (document.documentElement.style.scrollBehavior = "smooth"),
        clearTimeout(y);
    }
    p.addEventListener(
      "wpcf7mailsent",
      function () {
        const e = window.scrollY;
        (document.documentElement.style.scrollBehavior = "auto"),
          _.classList.remove("is-hidden"),
          document.documentElement.classList.add("modal__opened"),
          (document.documentElement.style.top = `-${e}px`),
          (y = setTimeout(() => {
            f();
          }, 5e3)),
          g.addEventListener("click", f),
          _.addEventListener("mousedown", f);
      },
      !1
    ),
      p.addEventListener(
        "wpcf7invalid",
        function () {
          x.classList.add("active"),
            setTimeout(() => {
              x.classList.remove("active");
            }, 5e3);
        },
        !1
      );
  }
});
