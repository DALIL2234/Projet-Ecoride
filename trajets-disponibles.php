<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>EcoRide - Trajets disponibles</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #80e5ff;
      font-family: 'Nunito', sans-serif;
      color: #000;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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
      color: black;
      text-decoration: none;
    }

    nav.menu {
      display: flex;
      gap: 1.5rem;
    }

    nav.menu a {
      font-family: 'Nunito', sans-serif;
      font-size: 1rem;
      color: black;
      text-decoration: none;
    }

    nav.menu a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 2rem;
      flex: 1;
    }

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      text-align: center;
      font-weight: 900;
      margin-bottom: 2rem;
    }

    .filters {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .filters input[type="number"] {
      width: 100px;
      padding: 0.5rem;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .filters label {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.95rem;
    }

    .trajets {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .card {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .card img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
    }

    .card-content {
      flex: 1;
    }

    .card-content h3 {
      font-size: 1.2rem;
      margin: 0 0 0.3rem 0;
    }

    .card-content p {
      margin: 0.2rem 0;
      font-size: 0.95rem;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      text-align: center;
      font-weight: bold;
    }

    @media (max-width: 600px) {
      .card {
        flex-direction: column;
        text-align: center;
      }

      .card img {
        margin-bottom: 1rem;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="index.html" class="logo">ECORIDE</a>
  <nav class="menu">
    <a href="index.html">Accueil</a>
    <a href="covoiturages.html">Covoiturages</a>
    <a href="avis.html">Avis</a>
    <a href="login.html">Connexion</a>
  </nav>
</header>

<div class="container">
  <h1>Trajets disponibles</h1>

  <div class="filters">
    <label><input type="checkbox" id="filterEco"> Véhicule électrique</label>
    <label>Prix (CRÉDITS) : <input type="number" id="filterPrix" placeholder="Ex: 30" min="1"></label>
    <label>Durée max (h) : <input type="number" id="filterDuree" placeholder="Ex: 4" min="1" max="7"></label>
  </div>

  <div class="trajets" id="trajets-list">
    <!-- Exemple de trajets (statiques pour l’instant) -->
    <div class="card" data-eco="1" data-prix="25" data-duree="3">
      <img src="img/avatar8.png" alt="Chauffeur 1">
      <div class="card-content">
        <h3>Jean Dupont</h3>
        <p>Note : 9.5 / 10</p>
        <p>Voiture électrique ✅</p>
        <p>Prix : 25 € – Durée : 3 h</p>
      </div>
    </div>

    <div class="card" data-eco="0" data-prix="18" data-duree="2">
      <img src="img/avatar9.png" alt="Chauffeur 2">
      <div class="card-content">
        <h3>Claire Martin</h3>
        <p>Note : 8.7 / 10</p>
        <p>Voiture thermique ❌</p>
        <p>Prix : 30 credits  – Durée : 3:30 h</p>
      </div>
    </div>

    <div class="card" data-eco="1" data-prix="30" data-duree="4">
      <img src="img/avatar7.png" alt="Chauffeur 3">
      <div class="card-content">
        <h3>Luc Morel</h3>
        <p>Note : 9.2 / 10</p>
        <p>Voiture électrique ✅</p>
        <p>Prix : 25 credits – Durée : 3:30 h</p>
      </div>
    </div>

    <div class="card" data-eco="0" data-prix="22" data-duree="3">
      <img src="img/avatar10.png" alt="Chauffeur 4">
      <div class="card-content">
        <h3>Sophie Leroy</h3>
        <p>Note : 8.3 / 10</p>
        <p>Voiture thermique ❌</p>
        <p>Prix : 20 credits – Durée : 4 h</p>
      </div>
    </div>

    <div class="card" data-eco="1" data-prix="28" data-duree="3">
      <img src="img/avatar6.png" alt="Chauffeur 5">
      <div class="card-content">
        <h3>Marc Petit</h3>
        <p>Note : 9.8 / 10</p>
        <p>Voiture électrique ✅</p>
        <p>Prix : 20 credits – Durée : 4 h</p>
      </div>
    </div>
  </div>
</div>

 <footer>
    <div><a href="contact-users.html">Contact</a></div>
    <div><a href="mentions-legales-users.html">Mentions légales</a></div>
  </footer>


<script>
  const cards = document.querySelectorAll(".card");
  const filterEco = document.getElementById("filterEco");
  const filterPrix = document.getElementById("filterPrix");
  const filterDuree = document.getElementById("filterDuree");

  function applyFilters() {
    const eco = filterEco.checked;
    const prix = parseFloat(filterPrix.value);
    const duree = parseFloat(filterDuree.value);

    cards.forEach(card => {
      const isEco = card.dataset.eco === "1";
      const cardPrix = parseFloat(card.dataset.prix);
      const cardDuree = parseFloat(card.dataset.duree);

      const matchesEco = !eco || isEco;
      const matchesPrix = isNaN(prix) || cardPrix <= prix;
      const matchesDuree = isNaN(duree) || cardDuree <= duree;

      if (matchesEco && matchesPrix && matchesDuree) {
        card.style.display = "flex";
      } else {
        card.style.display = "none";
      }
    });
  }

  filterEco.addEventListener("change", applyFilters);
  filterPrix.addEventListener("input", applyFilters);
  filterDuree.addEventListener("input", applyFilters);
</script>

</body>
</html>
