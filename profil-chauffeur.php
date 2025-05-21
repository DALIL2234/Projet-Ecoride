<?php
session_start();
if (!isset($_SESSION["utilisateur_id"])) {
    header("Location: backend/login.php");
    exit();
}
$prenom = $_SESSION["prenom"] ?? "Chauffeur";
$email = $_SESSION["email"] ?? "non défini";
$note10 = $_SESSION["note10"] ?? 9.2;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Chauffeur - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
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
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      font-family: 'NTR', sans-serif;
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
      max-width: 600px;
      margin: 2rem auto;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 2rem;
      text-align: center;
      flex: 1;
    }

    img.avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 1rem;
    }

    .titre-section {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      font-weight: 900;
      text-align: center;
      margin-bottom: 1rem;
    }

    .info {
      text-align: left;
      margin-top: 2rem;
    }

    .info p {
      margin: 0.5rem 0;
    }

    .avis {
      margin-top: 2rem;
      text-align: left;
    }

    .avis .avis-item {
      background: #f9f9f9;
      border-radius: 10px;
      padding: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .stars {
      color: #FFD700;
      font-size: 1.2rem;
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
  <script>
    function toggleMenu() {
      document.getElementById("main-nav").classList.toggle("nav-active");
    }

    function toggleDropdown(event) {
      event.stopPropagation();
      const dropdown = event.target.closest('.dropdown');
      dropdown.classList.toggle("show");
    }

    document.addEventListener("click", function (e) {
      document.querySelectorAll(".dropdown").forEach(d => {
        if (!d.contains(e.target)) d.classList.remove("show");
      });
    });
  </script>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
  <div class="burger" onclick="toggleMenu()">☰</div>
  <ul class="nav-links" id="main-nav">
    <li><a href="dashboard.php">Accueil</a></li>
    <li><a href="covoiturages-users.php">Covoiturages</a></li>
    <li><a href="avis-users.html">Avis</a></li>
    <li class="dropdown">
      <button class="dropdown-toggle" onclick="toggleDropdown(event)">Mon espace ▾</button>
      <ul class="submenu">
        <li><a href="mon-espace.php">Mon espace</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
      </ul>
    </li>
  </ul>
</header>

<div class="retour">
  <a href="chauffeur-espace.php">← Retour</a>
</div>

<div class="container">
  <img src="img/avatar-profil.png" alt="avatar-profil.png" class="avatar">
  <h1 class="titre-section"><?= htmlspecialchars($prenom) ?> - Chauffeur</h1>

  <div class="info">
    <p><strong>Email :</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Trajets effectués :</strong> 18</p>
    <p><strong>Note :</strong> <span class="stars">★★★★☆</span> (<?= $note10 ?>/10)</p>
  </div>

  <div class="avis">
    <h3>🗣️ Avis</h3>
    <div class="avis-item">⭐⭐⭐⭐⭐ — "Très ponctuel et super sympa !"</div>
    <div class="avis-item">⭐⭐⭐⭐☆ — "Trajet agréable, bonne conduite."</div>
    <div class="avis-item">⭐⭐⭐⭐⭐ — "Je recommande à 100 %."</div>
  </div>
</div>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

</body>
</html>
