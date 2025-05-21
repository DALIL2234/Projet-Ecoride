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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Historique de mes covoiturages - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Nunito&family=NTR&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

    body {
      font-family: 'Nunito', sans-serif;
      background-color: #80e5ff;
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: #000;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background-color: #80e5ff;
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
      font-family: 'Nunito', sans-serif;
      font-size: 1rem;
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
      background-color: #fff;
      width: 90%;
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      font-weight: 900;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .trajet {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 0.8rem;
      margin-bottom: 1.5rem;
      border-left: 6px solid #007acc;
    }

    .trajet h3 {
      font-size: 1.3rem;
      font-weight: 700;
      margin: 0;
      color: #007acc;
    }

    .trajet .infos {
      display: flex;
      flex-direction: column;
      gap: 0.4rem;
    }

    .trajet .infos p {
      margin: 0;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .trajet .infos p::before {
      content: "📅";
    }

    .trajet .infos p:nth-child(2)::before {
      content: "🚘";
    }

    .trajet .infos p:nth-child(3)::before {
      content: "⏱️";
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

      .container {
        padding: 1rem;
      }

      .trajet {
        padding: 1rem;
        font-size: 0.95rem;
      }

      h1 {
        font-size: 1.8rem;
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
      const burger = document.createElement('div');
      burger.className = 'burger';
      burger.textContent = '☰';
      document.querySelector('header').appendChild(burger);

      const nav = document.createElement('ul');
      nav.className = 'nav-links';
      nav.innerHTML = `
        <li><a href="dashboard.php">Accueil</a></li>
        <li><a href="covoiturages.html">Covoiturages</a></li>
        <li><a href="avis-users.html">Avis</a></li>
        <li class="dropdown">
          <button class="dropdown-toggle">Mon espace ▾</button>
          <ul class="submenu">
            <li><a href="mon-espace.php">Mon espace</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
          </ul>
        </li>
      `;
      document.querySelector('nav').appendChild(nav);

      burger.addEventListener("click", () => {
        nav.classList.toggle("nav-active");
      });

      const dropdownToggle = document.querySelector(".dropdown-toggle");
      const dropdown = document.querySelector(".dropdown");

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
  <nav></nav>
</header>

<div class="retour">
  <a href="passager-espace.php">← Retour</a>
</div>

<div class="container">
  <h1>Historique de mes covoiturages</h1>

  <div class="trajet">
    <h3>🚗 Paris ➝ Lyon</h3>
    <div class="infos">
      <p><strong>Date :</strong> 12 mai 2025</p>
      <p><strong>Chauffeur :</strong> Julien</p>
      <p><strong>Durée :</strong> 4h30</p>
    </div>
  </div>

  <div class="trajet">
    <h3>🚗 Lyon ➝ Marseille</h3>
    <div class="infos">
      <p><strong>Date :</strong> 5 mai 2025</p>
      <p><strong>Chauffeur :</strong> Clara</p>
      <p><strong>Durée :</strong> 3h15</p>
    </div>
  </div>

  <div class="trajet">
    <h3>🚗 Reims ➝ Paris</h3>
    <div class="infos">
      <p><strong>Date :</strong> 28 avril 2025</p>
      <p><strong>Chauffeur :</strong> Théo</p>
      <p><strong>Durée :</strong> 2h00</p>
    </div>
  </div>
</div>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

</body>
</html>
