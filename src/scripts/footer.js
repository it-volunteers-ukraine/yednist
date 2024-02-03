console.log("footer part");

const elList = document.querySelectorAll(".acc-show");

const handleAccToggle = (e) => {
  if (window.innerWidth > 767.97) {
    return;
  }
  const accContainer = e.target.nextElementSibling;
  if (accContainer.classList.contains("expanded")) {
    accContainer.classList.remove("expanded");
  } else {
    accContainer.classList.add("expanded");
  }
};

elList.forEach((el) => el.addEventListener("click", handleAccToggle));
