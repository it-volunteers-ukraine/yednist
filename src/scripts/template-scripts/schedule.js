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
  const activitiesWrapper = document.querySelector(".activities__wrapper");
  let currentPage = 1;

  function changeJustifyContent() {
    if (window.innerWidth > 1220 && allActivityCards < 3) {
      activitiesWrapper.style.justifyContent = "center";
      activitiesWrapper.style.gap = "80px";
    }
  }

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

  let totalPages = Math.ceil(allActivityCards / cardsPerPage());

  function isPagination() {
    const paginationBox = document.querySelector(
      ".activities-pagination__block"
    );

    if (totalPages === 1) {
      paginationBox.classList.add("hidden");
    } else paginationBox.classList.remove("hidden");
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
  function funcForRisizeChanges() {
    changeJustifyContent();
    updateSlider();
    totalPages = Math.ceil(allActivityCards / cardsPerPage());
    currentPage = 1;
    isPagination();
    updatePaginationButtons();
    countBullets();
    currentBullet();
  }
  funcForRisizeChanges();

  window.addEventListener("resize", funcForRisizeChanges);

  // slider update
  function updateSlider() {
    allActivityCardsArray.forEach((slide, index) => {
      if (
        index >= (currentPage - 1) * cardsPerPage() &&
        index < currentPage * cardsPerPage()
      ) {
        slide.style.display = "block";
        showSlider();
      } else {
        slide.style.display = "none";
      }
    });
  }

  function showSlider() {
    activitiesWrapper.classList.remove("is-hidden");
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

  // sort select
  const lastnewsSelect = document.querySelector(".lastnews_select");

  if (lastnewsSelect) {
    const lastNewsSelect = new Choices(lastnewsSelect, {
      searchEnabled: false,
      allowHTML: false,
      shouldSort: false,
      position: "bottom",
      itemSelectText: "",
    });
  }
});
