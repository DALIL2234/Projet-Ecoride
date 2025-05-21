<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}
$credits = $_SESSION["credits"] ?? 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recharger mes crédits - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #80e5ff;
      color: #000;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
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
      text-decoration: none;
      color: black;
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
      transition: text-decoration 0.2s ease;
    }

    .nav-links a:hover,
    .dropdown-toggle:hover {
      text-decoration: underline;
      background-color: transparent;
    }

    .dropdown {
      position: relative;
    }

    .submenu {
      display: none;
      position: absolute;
      top: 2.2rem;
      right: 0;
      background: white;
      list-style: none;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      z-index: 1000;
      min-width: 160px;
    }

    .dropdown.show .submenu {
      display: block;
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
      max-width: 500px;
      margin: 3rem auto;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 2rem;
      text-align: center;
      flex: 1;
    }

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      font-weight: 900;
      margin-bottom: 1rem;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      text-align: left;
    }

    label {
      font-weight: bold;
    }

    input, select {
      padding: 0.6rem;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 1rem;
    }

    .row {
      display: flex;
      gap: 1rem;
    }

    .row input {
      flex: 1;
    }

    button {
      background-color: #007acc;
      color: white;
      border: none;
      padding: 0.8rem;
      font-size: 1rem;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s;
      font-weight: bold;
    }

    button:hover {
      background-color: #006bb3;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-family: 'Nunito', sans-serif;
      margin-top: auto;
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
        right: 0;
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

      .row {
        flex-direction: column;
      }

      footer {
        flex-direction: row;
        justify-content: space-between;
      }
    }
  </style>

  <script defer>
    document.addEventListener("DOMContentLoaded", function () {
      const burger = document.querySelector(".burger");
      const nav = document.querySelector(".nav-links");
      const dropdownToggle = document.querySelector(".dropdown-toggle");
      const dropdown = document.querySelector(".dropdown");

      if (burger && nav) {
        burger.addEventListener("click", () => {
          nav.classList.toggle("nav-active");
        });
      }

      if (dropdownToggle && dropdown) {
        dropdownToggle.addEventListener("click", (e) => {
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
    <div class="burger">&#9776;</div>
  </nav>
</header>

<div class="retour">
  <a href="passager-espace.php">← Retour</a>
</div>

<div class="container">
  <h1>Recharger mes crédits</h1>
  <p>💳 Crédits actuels : <strong><?= $credits ?></strong></p>

  <form action="backend/traitement-rechargement.php" method="POST">
    <label for="montant">Montant à recharger :</label>
    <select name="montant" id="montant" required>
      <option value="">-- Choisir un montant --</option>
      <option value="10">10 crédits (50€)</option>
      <option value="20">20 crédits (100€)</option>
      <option value="30">30 crédits (150€)</option>
    </select>

    <label for="numero">Numéro de carte :</label>
    <input type="text" id="numero" name="numero" maxlength="19" placeholder="1234 5678 9012 3456" required>

    <div class="row">
      <div>
        <label for="expiration">Date d'expiration :</label>
        <input type="text" id="expiration" name="expiration" placeholder="MM/AA" maxlength="5" required>
      </div>

      <div>
        <label for="cvc">CVC :</label>
        <input type="text" id="cvc" name="cvc" maxlength="4" placeholder="123" required>
      </div>
    </div>

    <button type="submit">Valider le paiement</button>
  </form>
</div>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

</body>
</html>
