console.log("footer part");

const elList = document.querySelectorAll(".acc-show");
const btnToTop = document.querySelector(".btn-to-top");

btnToTop.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

const handleAccToggle = (e) => {
  if (window.innerWidth > 767.97) {
    return;
  }

  const accContainer = e.target.nextElementSibling;
  if (e.target.classList.contains("expanded")) {
    e.target.classList.remove("expanded");
    e.target.setAttribute("aria-expanded", "false");
    accContainer.style.maxHeight = null;
  } else {
    e.target.classList.add("expanded");
    e.target.setAttribute("aria-expanded", "true");
    accContainer.style.maxHeight = accContainer.scrollHeight + 16 + "px";
  }
};

elList.forEach((el) => {
  if (window.innerWidth < 768) {
    el.setAttribute("role", "button");
  }
  el.addEventListener("click", handleAccToggle);
});
