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
  <title>Historique de mes covoiturages - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Nunito&family=NTR&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

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
    }

    .logo {
      font-size: 2rem;
      font-weight: bold;
      text-decoration: none;
      color: black;
    }
    .menu {
  display: flex;
  gap: 2rem;
  align-items: center;
  font-family: 'Nunito', sans-serif;
}

.menu a {
  text-decoration: none;
  color: black;
  font-size: 1rem;
}

.dropdown {
  position: relative;
}

.dropbtn {
  cursor: pointer;
}

.dropdown-content {
  display: none;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: white;
  border-radius: 6px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  z-index: 100;
  min-width: 140px;
  font-size: 0.95rem;
}

.dropdown-content a {
  display: block;
  padding: 0.8rem 1rem;
  color: black;
  text-decoration: none;
}

.dropdown-content a:hover {
  background-color: #f0f0f0;
}

.dropdown:hover .dropdown-content {
  display: block;
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
    }

    nav a {
      text-decoration: none;
      color: black;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .submenu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background: #fff;
      padding: 0.5rem 0;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      z-index: 100;
    }

    nav ul li:hover .submenu {
      display: block;
    }

    .burger {
      display: none;
      font-size: 1.5rem;
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
      .burger {
        display: block;
      }

      nav ul {
        display: none;
        flex-direction: column;
        background: #fff;
        position: absolute;
        top: 60px;
        right: 20px;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      }

      nav ul.active {
        display: flex;
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
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
      }
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
  </script>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
  <nav class="menu">
    <a href="dashboard.php">Accueil</a>
    <a href="covoiturages-users.php">Covoiturages</a>
    <a href="avis-users.html">Avis</a>
    <div class="dropdown">
      <a href="mon-espace.php" class="dropbtn">Mon espace ▾</a>
      <div class="dropdown-content">
        <a href="logout.php">Déconnexion</a>
      </div>
    </div>
  </nav>
</header>

<div class="retour">
  <a href="chauffeur-espace.php">← Retour</a>
</div>

<div class="container">
  <h1>Historique de mes covoiturages</h1>

  <div class="trajet">
    <div class="header">🚗 Paris ➝ Lyon</div>
    <div class="infos">
      <p><strong>Date :</strong> 12 mai 2025</p>
      <p><strong>Chauffeur :</strong> Julien</p>
      <p><strong>Durée :</strong> 4h30</p>
    </div>
  </div>

  <div class="trajet">
    <div class="header">🚗 Lyon ➝ Marseille</div>
    <div class="infos">
      <p><strong>Date :</strong> 5 mai 2025</p>
      <p><strong>Chauffeur :</strong> Clara</p>
      <p><strong>Durée :</strong> 3h15</p>
    </div>
  </div>

  <div class="trajet">
    <div class="header">🚗 Reims ➝ Paris</div>
    <div class="infos">
      <p><strong>Date :</strong> 28 avril 2025</p>
      <p><strong>Chauffeur :</strong> Théo</p>
      <p><strong>Durée :</strong> 2h00</p>
    </div>
  </div>
</div>


  <footer>
    <div><a href="contact-users.html">Contact</a></div>
    <div><a href="mentions-legales-users.html">Mentions légales</a></div>
  </footer>

</body>
</html>
