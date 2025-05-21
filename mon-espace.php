<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}
$prenom = $_SESSION["prenom"] ?? "Utilisateur";
$email = $_SESSION["email"] ?? "non défini";
$credits = $_SESSION["credits"] ?? 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mon espace - EcoRide</title>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=NTR&family=Nunito&display=swap" rel="stylesheet">
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
      font-family: 'NTR', sans-serif;
      background-color: #80e5ff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
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
      left: 0;
      background: #fff;
      list-style: none;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
      max-width: 800px;
      margin: 2rem auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }

  h1 {
  font-family: 'Anton', sans-serif;
  font-size: 2.4rem;
  font-weight: 700;
  letter-spacing: -0.5px; /* optionnel pour resserrer */
  margin: 0 0 1.5rem 0;
  text-align: center;
}


    .role-buttons {
      display: flex;
      justify-content: center;
      gap: 2rem;
      margin-top: 2rem;
    }

    .role-buttons a {
      padding: 1rem 2rem;
      font-size: 1.2rem;
      font-weight: bold;
      color: white;
      background-color: #007acc;
      text-decoration: none;
      border-radius: 10px;
      transition: background-color 0.3s;
    }

    .role-buttons a:hover {
      background-color: #006bb3;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
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

      .role-buttons {
        flex-direction: column;
        gap: 1rem;
      }

      footer {
        flex-direction: row;
        justify-content: space-between;
        gap: 0;
        text-align: left;
        padding: 1rem;
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
        <button class="dropdown-toggle">Mon espace ▾</button>
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
  <a href="dashboard.php">← Retour</a>
</div>

<div class="container">
  <h1>Mon espace</h1>
  <p><strong>Bienvenue <?= htmlspecialchars($prenom) ?></strong></p>
  <p><?= htmlspecialchars($email) ?></p>
  <p>Crédits disponibles : <?= htmlspecialchars($credits) ?> 💳</p>

  <div class="role-buttons">
    <a href="passager-espace.php">Passager</a>
    <a href="chauffeur-espace.php">Chauffeur</a>
  </div>
</div>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

</body>
</html>
