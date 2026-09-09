const searchInput = document.getElementById("mySearch");
const searchButton = document.getElementById("searchButton");

const routeLinks = document.querySelectorAll(".route-link");

const moreRoutesButton = document.getElementById("moreRoutes");
const extraRoutes = document.querySelectorAll(".extra-route");

// SEARCH
function searchRoutes() {
  const searchTerm = searchInput.value.toLowerCase().trim();

  routeLinks.forEach(function (route) {
    const routeName = route
      .querySelector(".route-name")
      .textContent.toLowerCase();

    const matchesSearch = routeName.includes(searchTerm);

    if (matchesSearch) {
      route.style.display = "";
    } else {
      route.style.display = "none";
    }
  });
}

searchInput.addEventListener("input", searchRoutes);

searchButton.addEventListener("click", searchRoutes);

// MORE ROUTES
moreRoutesButton.addEventListener("click", function () {
  extraRoutes.forEach(function (route) {
    route.classList.add("show");
  });

  moreRoutesButton.style.display = "none";

  searchRoutes();
});

// DISABLE ROUTES
routeLinks.forEach(function (route) {
  const status = route.dataset.status;

  if (status === "disabled" || status === "warning") {
    route.addEventListener("click", function (event) {
      event.preventDefault();
    });
  }
});

// COUNTDOWN TIMER
// const countdowns = document.querySelectorAll(".countdown");

// countdowns.forEach(function (countdown) {
//   const route = countdown.closest(".route-link");

//   let remainingSeconds = parseInt(route.dataset.timeout);

//   function updateCountdown() {
//     if (remainingSeconds <= 0) {
//       countdown.textContent = "Beschikbaar";

//       route.dataset.status = "available";

//       route.classList.remove("disabled-route");

//       const statusDot = route.querySelector(".route-status");

//       statusDot.classList.remove("status-warning");
//       statusDot.classList.add("status-ok");

//       statusDot.setAttribute("aria-label", "Route beschikbaar");

//       route.onclick = null;

//       countdown.parentElement.textContent = "Route is weer beschikbaar.";

//       return;
//     }

//     const minutes = Math.floor(remainingSeconds / 60);
//     const seconds = remainingSeconds % 60;

//     countdown.textContent = `${minutes}:${seconds.toString().padStart(2, "0")}`;

//     remainingSeconds--;
//   }

//   updateCountdown();

//   setInterval(updateCountdown, 1000);
// });
