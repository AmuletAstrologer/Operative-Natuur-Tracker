<?php

/*
session_start();
// Might need later when login page is available

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


// Connect to database
require_once 'includes/database.php';
/** @var mysqli $connection */

/*
$query = "INSERT INTO routes (name, time, level)
VALUES
('Nirvana Route', '00:35:00', 'makkelijk'),
('Valken Route', '00:55:00', 'middelmatig'),
('Eiken Route', '02:15:00', 'moeilijk')";

$result = mysqli_query($connection, $query);


$query = "SELECT
            name,
            time,
            level
          FROM routes";

$result = mysqli_query($connection, $query);

$routes = mysqli_fetch_all($result, MYSQLI_ASSOC);
*/
?>

<!doctype html>
<html lang="nl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.css" />

  <title>Operatieve Natuur Tracker</title>
</head>

<body>

  <div class="app-frame">
    <header class="hero">
      <!-- Help button -->
      <div class="help-button" id="myBtn" aria-label="Help" role="button" tabindex="0">
        ?
      </div>
      <!-- ================= MODAL ================= -->

      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Over de Operatieve Natuur Tracker</h2>
          <p>
            Welkom bij de Operatieve Natuur Tracker.
            Deze applicatie helpt je bij het vinden en volgen
            van beschikbare natuur-routes.
          </p>

          <h3>Route status</h3>
          <div class="status-info">

            <p>
              <span class="status-dot status-ok"></span>
              <strong>Groen:</strong>
              Deze route is beschikbaar.
            </p>
            <p>
              <span class="status-dot status-warning"></span>
              <strong>Oranje:</strong>
              Deze route is momenteel niet beschikbaar.
            </p>
            <p>
              <span class="status-dot status-disabled"></span>
              <strong>Grijs:</strong>
              Deze route is uitgeschakeld.
            </p>

          </div>

          <h3>Routes zoeken</h3>

          <p>
            Gebruik de zoekbalk om snel een route op naam te vinden.
          </p>

          <p>
            Nieuwe routes kunnen door de drone aan de applicatie
            worden doorgegeven.
          </p>

        </div>

      </div>


      <!-- ================= SEARCH ================= -->

      <div class="search-box" role="search">
        <input type="search" id="mySearch" name="q" placeholder="Zoek een route..." aria-label="Zoek naar een route" />
        <button type="button" id="searchButton" aria-label="Zoeken">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </header>


    <!-- ================= DASHBOARD ================= -->

    <main class="dashboard">

      <!-- ================= ROUTES ================= -->

      <section class="routes" id="routes" aria-label="Beschikbare routes" data-status="available">
        <!-- ROUTE 1 -->
        <a href="./Navigation.html" class="route-link">
          <article class="route-item" style="background-image: url('./images/R1.jpeg')">
            <div class="route-row">
              <span class="route-number">
                #1
              </span>

              <span class="route-name">
                Nirvana Route
              </span>
              <!-- Groen = beschikbaar -->
              <span class="route-status status-ok" aria-label="Route beschikbaar"></span>
            </div>

            <p>
              Ongeveer:
              <strong>35 Minuten</strong>

              Niveau:
              <em class="easy">Makkelijk</em>
            </p>

          </article>

        </a>


        <!-- ROUTE 2 -->

        <a href="./Navigation.html" class="route-link" data-status="warning">
          <article class="route-item" style="background-image: url('./images/R2.png')">
            <div class="route-row">
              <span class="route-number">
                #2
              </span>

              <span class="route-name">
                Valken Route
              </span>

              <!-- Oranje = momenteel niet beschikbaar -->
              <span class="route-status status-warning" aria-label="Route momenteel niet beschikbaar"></span>

            </div>

            <p>
              Ongeveer:
              <strong>55 Minuten</strong>

              Niveau:
              <em class="medium">Middelmatig</em>
            </p>

            <span class="route-timeout">
              Tijdelijk gesloten: <strong class="countdown"></strong>
            </span>

          </article>

        </a>


        <!-- ROUTE 3 -->

        <a href="./Navigation.html" class="route-link" data-status="disabled">
          <article class="route-item" style="background-image: url('./images/R3.png')">
            <div class="route-row">
              <span class="route-number">
                #3
              </span>

              <span class="route-name">
                Eiken Route
              </span>

              <!-- Grijs = uitgeschakeld -->
              <span class="route-status status-disabled" aria-label="Route uitgeschakeld"></span>
            </div>

            <p>
              Ongeveer:
              <strong>145 Minuten</strong>

              Niveau:
              <em class="hard">Moeilijk</em>
            </p>

          </article>

        </a>


        <!-- ================= EXTRA ROUTES ================= -->

        <!--
          Deze routes zijn in eerste instantie verborgen.
          "Bekijk meer routes" maakt ze zichtbaar.
        -->


        <!-- ROUTE 4 -->

        <a href="./Navigation.html" class="route-link extra-route" data-status="available">
          <article class="route-item" style="background-image: url('./images/R4.jpg')">
            <div class="route-row">

              <span class="route-number">
                #4
              </span>

              <span class="route-name">
                Bosrand Route
              </span>

              <span class="route-status status-ok" aria-label="Route beschikbaar"></span>

            </div>

            <p>
              Ongeveer:
              <strong>70 Minuten</strong>

              Niveau:
              <em class="easy">Makkelijk</em>
            </p>

          </article>

        </a>


        <!-- ROUTE 5 -->

        <a href="./Navigation.html" class="route-link extra-route">
          <article class="route-item" style="background-image: url('./images/R5.webp')">
            <div class="route-row">

              <span class="route-number">
                #5
              </span>

              <span class="route-name">
                Heide Route
              </span>

              <span class="route-status status-warning" aria-label="Route momenteel niet beschikbaar"></span>
            </div>

            <p>
              Ongeveer:
              <strong>90 Minuten</strong>

              Niveau:
              <em class="medium">Middelmatig</em>
            </p>

            <span class="route-timeout">
              Tijdelijk gesloten: <strong class="countdown"></strong>
            </span>

          </article>

        </a>


        <!-- ROUTE 6 -->

        <a href="./Navigation.html" class="route-link extra-route" data-status="disabled">
          <article class="route-item" style="background-image: url('./images/R6.png')">
            <div class="route-row">

              <span class="route-number">
                #6
              </span>

              <span class="route-name">
                Moeras Route
              </span>

              <span class="route-status status-disabled" aria-label="Route uitgeschakeld"></span>

            </div>

            <p>
              Ongeveer:
              <strong>120 Minuten</strong>

              Niveau:
              <em class="hard">Moeilijk</em>
            </p>

          </article>

        </a>

      </section>


      <!-- ================= MORE ROUTES ================= -->

      <button type="button" class="more-routes" id="moreRoutes">
        Bekijk meer routes...
      </button>


      <!-- ================= QUICK ACTIONS ================= -->

      <div class="quick-actions" aria-label="Snelle acties">

        <button type="button" class="action-btn" aria-label="Ga terug">
          <i class="fa fa-undo"></i>
        </button>


        <button type="button" class="action-btn" aria-label="Route markeren">
          <i class="fa fa-map-signs"></i>
        </button>


        <button type="button" class="action-btn" aria-label="Weer">
          <i class="fa fa-cloud"></i>
        </button>


        <button type="button" class="action-btn sos" aria-label="SOS oproep">
          <img src="./images/SOS.png" alt="SOS" style="height: 60px; width: 80px" />
        </button>

      </div>


      <!-- ================= MAIN ACTIONS ================= -->

      <a href="./report.php" class="primary-btn warning-btn">

        <span>
          Melding Maken
        </span>

        <span class="button-icon">
          <i class="fa fa-comment"></i>
        </span>

      </a>


      <button type="button" class="primary-btn success-btn">

        <span>
          Connectie met Drone
        </span>

        <span class="button-icon">
          <i class="fa fa-link"></i>
        </span>

      </button>

    </main>

  </div>


  <!-- JavaScript -->

  <script src="./javascript/modal.js"></script>
  <script src="./javascript/index.js"></script>

</body>

</html>