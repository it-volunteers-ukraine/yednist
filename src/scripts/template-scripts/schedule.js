document.addEventListener("DOMContentLoaded", function () {
  // accordion
  const acc = document.getElementsByClassName("schedule-accordion");

  for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
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

  //slider

  const allActivityCardsArray = document.querySelectorAll(".one-activity-js");
  const allActivityCards = allActivityCardsArray.length;
  let currentPage = 1;

  function cardsPerPage() {
    let cardPerPage = 3;
    if (window.innerWidth < 1220) {
      cardPerPage = 2;
    }
    if (window.innerWidth < 768) {
      cardPerPage = 1;
    }
    return cardPerPage;
  }

  const totalPages = Math.ceil(allActivityCards / cardsPerPage());

  function isPagination() {
    const paginationBox = document.querySelector(
      ".activities-pagination__block"
    );

    if (totalPages === 1) {
      paginationBox.classList.add("hidden");
    }
  }

  // Оновлення кнопок пагінації
  function updatePaginationButtons() {
    const prevButton = document.querySelector(".activities-prev");
    const nextButton = document.querySelector(".activities-next");

    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === totalPages;
  }

  // Підсвічення активного bullet
  function currentBullet() {
    const bulletArray = document.querySelector(".bullets").children;

    const activeIndex = currentPage - 1;
    const activeBullet = bulletArray[activeIndex];
    if (activeBullet) {
      for (let i = 0; i < bulletArray.length; i++) {
        bulletArray[i].classList.remove("active");
      }

      activeBullet.classList.add("active");
    }
  }

  function countBullets() {
    const bulletsBox = document.querySelector(".bullets");
    bulletsBox.innerHTML = "";
    if (totalPages > 1) {
      for (let i = 1; i <= totalPages; i++) {
        const bullet = document.createElement("div");
        bullet.classList.add("one-bullet");
        bulletsBox.appendChild(bullet);
      }
      currentBullet();
    }
  }

  updateSlider();
  isPagination();
  updatePaginationButtons();
  countBullets();
  currentBullet();

  // slider update
  function updateSlider() {
    allActivityCardsArray.forEach((slide, index) => {
      if (
        index >= (currentPage - 1) * cardsPerPage() &&
        index < currentPage * cardsPerPage()
      ) {
        slide.style.display = "block";
      } else {
        slide.style.display = "none";
      }
    });
  }

  const nextButton = document.querySelector(".activities-next");
  const prevButton = document.querySelector(".activities-prev");

  // "Next"
  nextButton.addEventListener("click", function () {
    currentPage++;
    if (currentPage > totalPages) {
      currentPage = totalPages;
    }
    updateSlider();
    currentBullet();
    updatePaginationButtons();
  });

  // "Prev"
  prevButton.addEventListener("click", function () {
    currentPage--;
    if (currentPage < 1) {
      currentPage = 1;
    }
    updateSlider();
    currentBullet();
    updatePaginationButtons();
  });

  // Обробник кліку на bullet
  document
    .querySelector(".bullets")
    .addEventListener("click", function (event) {
      if (event.target.classList.contains("one-bullet")) {
        document.querySelector(".one-bullet.active").classList.remove("active");
        const index = Array.from(this.children).indexOf(event.target);
        currentPage = index + 1;
        updateSlider();
        updatePaginationButtons();
        currentBullet();
      }
    });

  const activitiesWrapper = document.querySelector(".activities__wrapper");
  // Swipe
  activitiesWrapper.addEventListener("touchstart", handleTouchStart, false);
  activitiesWrapper.addEventListener("touchmove", handleTouchMove, false);

  let xDown = null;

  function handleTouchStart(event) {
    const firstTouch = event.touches[0];
    xDown = firstTouch.clientX;
  }

  function handleTouchMove(event) {
    if (!xDown) {
      return;
    }

    let xUp = event.touches[0].clientX;
    let xDiff = xDown - xUp;

    // Swipe left
    if (xDiff > 0) {
      if (currentPage < totalPages) {
        currentPage++;
        updateSlider();
        currentBullet();
        updatePaginationButtons();
      }
    }
    // Swipe right
    else {
      if (currentPage > 1) {
        currentPage--;
        updateSlider();
        currentBullet();
        updatePaginationButtons();
      }
    }
    xDown = null;
  }

  // flip

  function handleTouch(event) {
    var card = event.currentTarget;
    var flipCardInner = card.querySelector(".activity__flip-card-inner");
    flipCardInner.classList.toggle("flipped");
  }
});
