<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes trajets - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #80e5ff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #000;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background-color: #80E5FF;
      font-family: 'NTR', sans-serif;
    }

    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: #000;
      text-decoration: none;
    }

    nav {
      position: relative;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 2rem;
      margin: 0;
      padding: 0;
      font-family: 'Nunito', sans-serif;
      font-size: 1rem;
    }

    nav ul li {
      position: relative;
    }

    nav a {
      text-decoration: none;
      color: #000;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .submenu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #fff;
      padding: 0.5rem 0;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      z-index: 100;
    }

    nav ul li:hover .submenu {
      display: block;
    }

    .submenu li {
      padding: 0.5rem 1rem;
      white-space: nowrap;
    }

    .burger {
      display: none;
      font-size: 1.5rem;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      nav ul {
        display: none;
        position: absolute;
        top: 60px;
        right: 20px;
        background-color: #fff;
        flex-direction: column;
        width: 200px;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      }

      nav ul.active {
        display: flex;
      }

      .burger {
        display: block;
      }
    }

    .retour {
      padding: 1rem 2rem;
    }

    .retour a {
      background: #007acc;
      color: white;
      padding: 0.4rem 1rem;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }

    .container {
      max-width: 800px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      flex: 1;
    }

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      font-weight: 900;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .trajet {
      background: #f4f4f4;
      padding: 1.5rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .trajet h2 {
      margin: 0 0 1rem;
      font-size: 1.3rem;
      color: #007acc;
    }

    .trajet p {
      margin: 0.4rem 0;
    }

    .trajet button {
      background-color: #007acc;
      color: white;
      padding: 0.6rem 1.2rem;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1rem;
      transition: background-color 0.3s;
    }

    .trajet button:hover {
      background-color: #006bb3;
    }

    #error-message {
      color: red;
      font-weight: bold;
      display: none;
      margin-top: 0.75rem;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-family: 'Nunito', sans-serif;
    }

    footer a {
      text-decoration: none;
      color: black;
    }
  </style>

  <script defer>
    document.addEventListener("DOMContentLoaded", function () {
      const burger = document.querySelector(".burger");
      const nav = document.querySelector("nav ul");
      if (burger && nav) {
        burger.addEventListener("click", () => {
          nav.classList.toggle("active");
        });
      }
    });

    function showError() {
      document.getElementById("error-message").style.display = "block";
    }
  </script>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
  <nav>
    <ul>
      <li><a href="dashboard.php">Accueil</a></li>
      <li><a href="covoiturages-users.html">Covoiturages</a></li>
      <li><a href="avis-users.html">Avis</a></li>
      <li><a href="#">Mon espace ▾</a>
        <ul class="submenu">
          <li><a href="logout.php">Déconnexion</a></li>
        </ul>
      </li>
    </ul>
    <div class="burger">&#9776;</div>
  </nav>
</header>

<div class="retour">
  <a href="chauffeur-espace.php">← Retour</a>
</div>


<div class="container">
  <h1>Mes trajets</h1>

  <div class="trajet">
    <h2>🚗 Paris ➝ Lyon</h2>
    <p><strong>Date :</strong> 15 novembre 2025 à 14:00</p>
    <p><strong>Véhicule :</strong> Tesla Model 3</p>
    <p><strong>Statut :</strong> Prévu</p>
    <button onclick="showError()">▶️ Démarrer le trajet</button>
    <p id="error-message">❌ Impossible pour le moment</p>
  </div>
</div>

  <footer>
    <div><a href="contact-users.html">Contact</a></div>
    <div><a href="mentions-legales-users.html">Mentions légales</a></div>
  </footer>

</body>
</html>
