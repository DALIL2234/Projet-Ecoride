<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>EcoRide - Covoiturages <disponibles-users></disponibles-users></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #80e5ff;
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

    .nav-links > li {
      position: relative;
    }

    .nav-links > li > a,
    .dropdown-toggle {
      text-decoration: none;
      color: black;
      background: none;
      border: none;
      font-family: inherit;
      font-size: 1rem;
      cursor: pointer;
    }

    .nav-links > li > a:hover,
    .dropdown-toggle:hover {
      text-decoration: underline;
    }

    .dropdown {
      position: relative;
    }

    .submenu {
      display: none;
      list-style: none;
      position: absolute;
      top: 2.2rem;
      right: 0;
      background: #fff;
      padding: 0.5rem 0;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      z-index: 1000;
      min-width: 160px;
    }

    .dropdown.show .submenu {
      display: block;
    }

    .submenu a {
      background: none;
      color: #000;
      padding: 0.5rem 1rem;
      display: block;
      font-size: 0.95rem;
      text-decoration: none;
      font-family: 'Nunito', sans-serif;
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

    .content {
      display: flex;
      justify-content: center;
      padding: 2rem;
      flex: 1;
    }

    .search-box {
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
      overflow: hidden;
    }

    .search-box h2 {
      font-size: 1.8rem;
      font-family: 'Anton', sans-serif;
      text-align: center;
      margin-bottom: 1rem;
    }

    .search-box form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .search-box input,
    .search-box button {
      padding: 0.8rem;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    .search-box button {
      background-color: #007acc;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }

    #map {
      height: 300px;
      width: 100%;
      border-radius: 10px;
      margin-top: 1rem;
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

    @media screen and (max-width: 768px) {
      .nav-links {
        display: none;
        flex-direction: column;
        background: #b3f0ff;
        position: absolute;
        top: 60px;
        right: 20px;
        padding: 1rem;
        border-radius: 10px;
        z-index: 10;
        gap: 0.5rem;
      }

      .nav-links.nav-active {
        display: flex;
      }

      .burger {
        display: block;
      }

      footer {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
  <div class="burger" onclick="document.querySelector('.nav-links').classList.toggle('nav-active')">☰</div>
  <ul class="nav-links">
    <li><a href="dashboard.php">Accueil</a></li>
    <li><a href="covoiturages-users.php">Covoiturages</a></li>
    <li><a href="avis-users.html">Avis</a></li>
    <li class="dropdown">
      <button class="dropdown-toggle" onclick="event.stopPropagation(); this.parentElement.classList.toggle('show')">Mon espace ▾</button>
      <ul class="submenu">
        <li><a href="mon-espace.php">Mon espace</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
      </ul>
    </li>
  </ul>
</header>

<main class="content">
  <div class="search-box">
    <h2>Rechercher un trajet</h2>
    <form action="trajets-disponibles.php" method="GET">
      <input type="text" id="depart" name="depart" placeholder="Adresse de départ" required>
      <input type="text" id="arrivee" name="arrivee" placeholder="Adresse d’arrivée" required>
      <input type="date" name="date" min="2025-01-01" max="2025-12-31" required>
      <input type="number" name="passagers" placeholder="Nombre de passagers" min="1" max="4" required>
      <button type="submit">Rechercher</button>
    </form>
    <div id="map"></div>
  </div>
</main>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([46.8, 2.4], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    setTimeout(() => map.invalidateSize(), 300);

    let departSet = false;
    let departMarker = null;
    let arriveeMarker = null;

    map.on('click', async function(e) {
      const lat = e.latlng.lat;
      const lng = e.latlng.lng;

      const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`);
      const data = await res.json();
      const adresse = data.display_name || "Adresse inconnue";

      if (!departSet) {
        if (departMarker) map.removeLayer(departMarker);
        departMarker = L.marker([lat, lng]).addTo(map).bindPopup("Départ").openPopup();
        document.getElementById('depart').value = adresse;
        departSet = true;
      } else {
        if (arriveeMarker) map.removeLayer(arriveeMarker);
        arriveeMarker = L.marker([lat, lng]).addTo(map).bindPopup("Arrivée").openPopup();
        document.getElementById('arrivee').value = adresse;
        departSet = false;
      }
    });
  });
</script>

</body>
</html>
