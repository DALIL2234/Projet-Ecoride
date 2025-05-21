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
  <title>Gérer mes véhicules - EcoRide</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&display=swap" rel="stylesheet">
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
      background-color: #80e5ff;
      font-family: 'NTR', sans-serif;
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
.dropdown-toggle {
  text-decoration: none;
  background: none;
  border: none;
  font-family: 'Nunito', sans-serif;
  color: black;
  font-size: 1rem;
  cursor: pointer;
  padding: 0;
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
* {
  box-sizing: border-box;
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
      margin: 1rem auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1 {
      font-family: 'Anton', sans-serif;
      font-size: 2.4rem;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    h2 {
      font-size: 1.4rem;
      text-align: center;
      margin-bottom: 1rem;
    }

    .vehicule {
      background: #f9f9f9;
      border: 2px solid #ccc;
      border-radius: 10px;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .vehicule.hidden {
      display: none;
    }

    .badge {
      background: #45b58d;
      color: white;
      padding: 0.2rem 0.6rem;
      border-radius: 6px;
      font-size: 0.8rem;
      margin-left: 0.5rem;
    }

    .select-button,
    .reset-button,
    form.add-vehicule button {
      background: #007acc;
      color: white;
      padding: 0.6rem 1rem;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 1rem;
      width: 100%;
    }

    form.add-vehicule {
      background: #f4f4f4;
      border-radius: 10px;
      padding: 1.5rem;
      margin-top: 2rem;
    }

    form.add-vehicule input,
    form.add-vehicule select {
      display: block;
      width: 100%;
      padding: 0.6rem;
      margin-top: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .reset-button {
      display: none;
      margin: 1rem auto;
      width: auto;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      font-family: 'Nunito', sans-serif;
      font-weight: bold;
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
        <li><a href="covoiturages-users.php">Covoiturages</a></li>
        <li><a href="avis-users.html">Avis</a></li>
        <li class="dropdown">
 <a href="#" class="dropdown-toggle">Mon espace ▾</a>
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

    function cocherVehicule(id) {
      document.querySelectorAll('.vehicule').forEach(v => v.classList.add('hidden'));
      const selected = document.getElementById('vehicule' + id);
      selected.classList.remove('hidden');
      selected.querySelector('input[type="radio"]').checked = true;
      document.getElementById('resetButton').style.display = 'block';
    }

    function resetView() {
      document.querySelectorAll('.vehicule').forEach(v => v.classList.remove('hidden'));
      document.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
      document.getElementById('resetButton').style.display = 'none';
    }
  </script>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
  <nav></nav>
</header>

<div class="retour">
  <a href="chauffeur-espace.php">← Retour</a>
</div>

<div class="container">
  <h1>Gérer mes véhicules</h1>
  <h2>Mes voitures</h2>

  <div class="vehicule" id="vehicule1">
    <h3>Tesla Model 3 <span class="badge">Électrique</span></h3>
    <p><strong>Couleur :</strong> Noir</p>
    <p><strong>Plaque :</strong> AA-123-TZ</p>
    <p><strong>Places disponibles :</strong> 4</p>
    <input type="radio" name="vehicule" value="1">
    <button type="button" class="select-button" onclick="cocherVehicule(1)">Utiliser ce véhicule</button>
  </div>

  <div class="vehicule" id="vehicule2">
    <h3>Peugeot 208</h3>
    <p><strong>Couleur :</strong> Blanche</p>
    <p><strong>Plaque :</strong> BB-456-WX</p>
    <p><strong>Places disponibles :</strong> 3</p>
    <input type="radio" name="vehicule" value="2">
    <button type="button" class="select-button" onclick="cocherVehicule(2)">Utiliser ce véhicule</button>
  </div>

  <button type="button" id="resetButton" class="reset-button" onclick="resetView()">Choisir un autre véhicule</button>

  <form class="add-vehicule" method="post" action="ajouter-vehicule-action.php">
    <h2>Ajouter un nouveau véhicule</h2>
    <input type="text" name="marque" placeholder="Marque" required>
    <input type="text" name="modele" placeholder="Modèle" required>
    <input type="text" name="plaque" placeholder="Plaque d'immatriculation" required>
    <input type="number" name="places" placeholder="Nombre de places" min="1" max="4" required>
    <select name="electrique" required>
      <option value="">Véhicule électrique ?</option>
      <option value="oui">Oui</option>
      <option value="non">Non</option>
    </select>
    <button type="submit">Ajouter le véhicule</button>
  </form>
</div>

<footer>
  <a href="contact-users.html">Contact</a>
  <a href="mentions-legales-users.html">Mentions légales</a>
</footer>

</body>
</html>
