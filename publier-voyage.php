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
  <title>Publier un trajet - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

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
      background-color: #80e5ff;
      font-family: 'NTR', sans-serif;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
    }

    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: black;
      text-decoration: none;
    }

    nav {
      display: flex;
      align-items: center;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 2rem;
      margin: 0;
      padding: 0;
      font-size: 1rem;
      font-family: 'Nunito', sans-serif;
    }

    .nav-links li {
      position: relative;
    }

    .nav-links a,
    .dropdown-toggle {
      text-decoration: none;
      color: black;
      background: none;
      border: none;
      font-family: inherit;
      font-size: 1rem;
      cursor: pointer;
      padding: 0;
    }

    .nav-links a:hover,
    .dropdown-toggle:hover {
      text-decoration: underline;
    }

    .dropdown {
      position: relative;
    }

    .submenu {
      display: none;
      position: absolute;
      top: 2.2rem;
      right: 0;
      background: #fff;
      list-style: none;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      z-index: 1000;
      min-width: 160px;
    }

    .dropdown.show .submenu {
      display: block;
    }

    @media (min-width: 769px) {
      .dropdown:hover .submenu {
        display: block;
      }
    }

    .submenu a {
      display: block;
      padding: 0.5rem 1rem;
      color: black;
      text-decoration: none;
      font-size: 0.95rem;
    }

    .submenu a:hover {
      background-color: #f0f0f0;
      text-decoration: underline;
    }

    .burger {
      display: none;
      font-size: 2rem;
      cursor: pointer;
      margin-left: 1rem;
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

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      font-weight: 900;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .container {
      max-width: 800px;
      margin: 1rem auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      flex: 1;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    input, select, button {
      padding: 0.8rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    button {
      background-color: #007acc;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background-color: #006bb3;
    }

    .group {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .group label {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      font-family: 'Nunito', sans-serif;
      font-weight: bold;
    }

    footer a {
      text-decoration: none;
      color: black;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
        flex-direction: column;
        background: #b3f0ff;
        position: absolute;
        top: 60px;
        right: 10px;
        padding: 1rem;
        border-radius: 10px;
        z-index: 10;
        gap: 0.6rem;
        min-width: 180px;
      }

      .nav-links.nav-active {
        display: flex;
      }

      .submenu {
        position: relative;
        top: 0;
        left: 0;
        border-radius: 0;
        box-shadow: none;
        background-color: transparent;
        padding: 0;
      }

      .submenu a {
        padding-left: 0.5rem;
      }

      .burger {
        display: block;
      }

      footer {
        flex-direction: row;
        justify-content: space-between;
        text-align: left;
        gap: 0;
      }
    }
  </style>

  <script defer>
    document.addEventListener("DOMContentLoaded", function () {
      const burger = document.querySelector('.burger');
      const nav = document.querySelector('.nav-links');
      const dropdownToggle = document.querySelector(".dropdown-toggle");
      const dropdown = document.querySelector(".dropdown");

      if (burger && nav) {
        burger.addEventListener("click", () => {
          nav.classList.toggle("nav-active");
        });
      }

      if (dropdownToggle && dropdown) {
        dropdownToggle.addEventListener("click", (e) => {
          e.preventDefault();
          e.stopPropagation();
          dropdown.classList.toggle("show");
        });
      }

      document.addEventListener("click", function (e) {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove("show");
        }
      });
    });
  </script>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
  <nav>
    <ul class="nav-links">
      <li><a href="dashboard.php">Accueil</a></li>
      <li><a href="covoiturages-users.php">Covoiturages</a></li>
      <li><a href="avis-users.html">Avis</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle">Mon espace ▾</a>
        <ul class="submenu">
          <li><a href="mon-espace.php">Mon espace</a></li>
          <li><a href="logout.php">Déconnexion</a></li>
        </ul>
      </li>
    </ul>
    <div class="burger">☰</div>
  </nav>
</header>

<div class="retour">
  <a href="chauffeur-espace.php">← Retour</a>
</div>

<div class="container">
  <h1>Publier un trajet</h1>
  <form method="post" action="proposer-trajet.php">
    <input type="text" name="depart" placeholder="Ville de départ" required>
    <input type="text" name="arrivee" placeholder="Ville d'arrivée" required>
    <input type="date" name="date" required>
    <input type="time" name="heure" required>
    <input type="number" name="places" placeholder="Nombre de places" min="1" max="7" required>

    <select name="vehicule_id" required>
      <option value="">Sélectionner un véhicule</option>
      <option value="1">Tesla Model 3</option>
      <option value="2">Peugeot 208</option>
    </select>

    <div class="group">
      <label><input type="radio" name="fumeur" value="fumeur"> Fumeur</label>
      <label><input type="radio" name="fumeur" value="non-fumeur" checked> Non fumeur</label>
    </div>

    <div class="group">
      <label><input type="radio" name="animaux" value="avec"> Animaux acceptés</label>
      <label><input type="radio" name="animaux" value="sans" checked> Pas d'animaux</label>
    </div>

    <select name="ecologique" required>
      <option value="">Voyage écologique ?</option>
      <option value="oui">Oui</option>
      <option value="non">Non</option>
    </select>

    <input type="number" name="prix" placeholder="Prix du voyage (€)" min="0" required>

    <select name="duree" required>
      <option value="">Durée estimée</option>
      <option value="moins de 4h">Moins de 4h</option>
      <option value="plus de 4h">Plus de 4h</option>
    </select>

    <button type="submit">Publier le trajet</button>
  </form>
</div>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

</body>
</html>
