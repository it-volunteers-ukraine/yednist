console.log("footer part");
const elList = document.querySelectorAll(".acc-show"),
  handleAccToggle = (e) => {
    if (window.innerWidth > 767.97) return;
    const t = e.target.nextElementSibling;
    e.target.classList.contains("expanded")
      ? (e.target.classList.remove("expanded"),
        e.target.setAttribute("aria-expanded", "false"),
        (t.style.maxHeight = null))
      : (e.target.classList.add("expanded"),
        e.target.setAttribute("aria-expanded", "true"),
        (t.style.maxHeight = t.scrollHeight + 16 + "px"));
  };
elList.forEach((e) => {
  window.innerWidth < 768 && e.setAttribute("role", "button"),
    e.addEventListener("click", handleAccToggle);
}),
  console.log("header"),
  console.log("main");
