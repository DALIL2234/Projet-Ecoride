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
  <title>EcoRide - Accueil</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #80e5ff;
    }


header {
  font-family: 'NTR', sans-serif;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  
}
.dropdown {
  position: relative;
   display: inline-block; /* Pour que le submenu se place par rapport au lien */
}

.dropdown .submenu {
  display: none;
  position: absolute;
  top: 2.4rem; /* espace entre le lien et le menu */
  left: 0; /* aligné à gauche du lien */
  background: #fff;
  padding: 0.5rem 0;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  list-style: none;
  z-index: 1000;
  min-width: 160px;
}


.dropdown:hover .submenu {
  display: block;
}

 .submenu a {
  background: none;
  color: #000;
  padding: 0.5rem 1rem;
  display: block;
  border: none;
  font-size: 0.95rem;
  text-decoration: none;
  font-family: 'Nunito', sans-serif;
  border-radius: 0;
  box-shadow: none;
  transition: text-decoration 0.3s ease;
}

.submenu a:hover {
  text-decoration: underline;
  background-color: transparent;
}



.logo {
  font-size: 2rem;
  font-weight: bold;
  text-decoration: none;
  color: black;
}

.burger {
  display: none;
  font-size: 2rem;
  cursor: pointer;
}
.nav-links {
  display: flex;
  gap: 1.6rem;
  list-style: none;
  
}

.nav-links > li > a {
  text-decoration: none;
  color: black;
  font-family: inherit;
  font-size: 1.2rem;
  transition: text-decoration 0.3s ease;
}

.nav-links > li > a:hover {
  text-decoration: underline;
}



.badge-below-logo {
  position: absolute;
  left: 2rem;
  top: 6.7rem;
  width: 4rem;
  height: 3rem;
}



.main-title {
  font-family: 'Anton', sans-serif;
  font-size: 2.2rem;
  font-weight: normal;
  line-height: 1.4;       /* ✅ Réduction de l'espacement vertical */
  text-align: center;
  margin: 2rem auto 2rem; /* ✅ Moins d’espace au-dessus et en-dessous */
  color: #000;
}



.highlight-green {
  color: green;
}

.images-row {
  display: flex;
  justify-content: center;
  gap: 2rem;
  flex-wrap: wrap;
  margin-bottom: 2rem;
}

.images-row img {
  width: 300px;
  border-radius: 10px;
}

.three-column-wrapper {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 3rem;
  padding: 2rem;
  background-color: #d4f4ff;
}

.rides-container, .reviews-container {
  width: 250px;
}

/* Style des titres secondaires */
.rides-container h3,
.reviews-container h3,
.search-box h2 {
  font-family: 'Anton', sans-serif;
  font-size: 2rem;
  font-weight: 900;
  text-align: center;
  margin-bottom: 1rem;
  color: #000;
}


.rides-list, .reviews-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.ride-card, .review-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.2s ease;
  text-decoration: none;
  color: inherit;
}

.ride-card:hover, .review-card:hover {
  transform: scale(1.03);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.ride-card img, .review-card img {
  width: 100%;
  height: 130px;
  object-fit: cover;
  border-radius: 10px 10px 0 0;
}
.review-card img {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 50%;
  margin: 0.5rem auto 0;
  display: block;}
  
.ride-card-title, .review-content {
  padding: 0.8rem;
  font-size: 0.95rem;
  text-align: center;
}
.review-content {
  font-size: 0.85rem;
  padding: 0.5rem;
  text-align: center;
}
.search-box {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 0px 10px rgba(0,0,0,0.1);
  max-width: 400px;
  width: 100%;
}

.search-box h2 {
  margin-bottom: 1rem;
  font-weight: bold;
} 

.search-box form {
  display: flex;
  flex-direction: column;

}

.search-box input,
.search-box button {
  padding: 0.8rem;
  margin-top: 1rem;
  border-radius: 5px;
  font-size: 1rem;
  border: 1px solid #ccc;
}

.search-box button {
  background-color: #007acc;
  color: white;
  font-weight: bold;
  border: none;
  cursor: pointer;
}

.column {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 1rem;
  padding: 2rem 0;
}

.column img {
  width: 300px;
  border-radius: 10px;
}

footer {
  background-color: #b3f0ff;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
}

footer a {
  text-decoration: none;
  color: black;
  font-weight: bold;
}
.badge-mobile {
  display: none;
  margin: 1.5rem auto 3rem;
  width: 130px;
  margin-bottom: 3rem;
}
.badge-below-logo {
  position: absolute;
  left: 2rem;
  top: 6.7rem;
  z-index: 1;


}
.badge-below-logo svg {
  width: 130px;
  height: auto;
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
  }
.badge-below-logo {
    display: none;
  }
  .badge-mobile {
    display: block;
  }
  .nav-links.nav-active {
    display: flex;
  }

  .burger {
    display: block;
  }

  

  .three-column-wrapper {
    flex-direction: column;
    align-items: center;
  }
 
  .rides-container,
  .reviews-container {
    width: 100%;
    max-width: 400px;
  }
  .search-box {
    max-width: 100%;
  }
}
@media screen and (max-width: 1008px) {
  .badge-below-logo {
    display: none !important; /* ✅ masque le badge desktop */
  }

  .badge-mobile {
    display: block !important; /* ✅ affiche le badge mobile */
    margin: 2rem auto;
    width: 130px;
    text-align: center;
  }

  .badge-mobile svg {
    width: 130px;
    height: auto;
    display: block;
    margin: 0 auto;
  }
}



  </style>
  <script defer>
    document.addEventListener("DOMContentLoaded", function () {
      const burger = document.querySelector(".burger");
      const nav = document.querySelector(".nav-links");
      if (burger && nav) {
        burger.addEventListener("click", () => {
          nav.classList.toggle("nav-active");
        });
      }
    });
  </script>
</head>
<body>

  <header>
    <a href="dashboard.php" class="logo">ECORIDE</a>
    <div class="burger">&#9776;</div>
    <ul class="nav-links">
      <li><a href="dashboard.php" class="active">Accueil</a></li>
      <li><a href="covoiturages-users.php">Covoiturages</a></li>
      <li><a href="avis-users.html">Avis</a></li>
     <li class="dropdown">
  <a href="mon-espace.php" class="dropdown-toggle">Mon espace ▾</a>
  <ul class="submenu">
    <li><a href="logout.php">Déconnexion</a></li>
  </ul>
</li>
    </ul>
  </header>


<!-- Badge version desktop -->

<div class="badge-below-logo">


  <svg viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
    <polygon points="0,40 160,0 100,160" fill="#f6b73c" />
    <text x="80" y="55" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="16" font-weight="bold">
      <?= $credits ?> CRÉDITS
    </text>
    <text x="83" y="72" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="14" font-weight="bold">
      DISPONIBLES
    </text>
    <text x="85" y="89" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="13" font-weight="bold">
      SUR VOTRE
    </text>
    <text x="85" y="106" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="13" font-weight="bold">
      COMPTE
    </text>
    <text x="90" y="129" text-anchor="middle" font-size="20">💳</text>
  </svg>
  </div>

  <div class="intro-container">
  <h2 class="main-title">
    Voyagez dans votre ville Pour
      <span class="highlight-green">4 CRÉDITS = 20€</span><br>
    Voyagez dans toute la France pour  
      <span class="highlight-green"> 20 CRÉDITS = 100€</span><br> 
      <span class="highlight-green">MOINS de CO₂ 🌿🌍</span><br>
      <span class="highlight-green">Recharger vos credits --  Le MERCI de la planète 🌳</span>
  </h2>
  </div>
  <div class="badge-mobile">
    <svg viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
    <polygon points="0,40 160,0 100,160" fill="#f6b73c" />
    <text x="80" y="55" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="16" font-weight="bold">
      <?= $credits ?> CRÉDITS
    </text>
    <text x="83" y="72" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="14" font-weight="bold">
      DISPONIBLES
    </text>
    <text x="85" y="89" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="13" font-weight="bold">
      SUR VOTRE
    </text>
    <text x="85" y="106" text-anchor="middle" fill="#000" font-family="Anton, sans-serif" font-size="13" font-weight="bold">
      COMPTE
    </text>
    <text x="90" y="129" text-anchor="middle" font-size="20">💳</text>
  </svg>
  </div>
  <div class="images-row">
    <img src="img/1.jpg" alt="Image 1">
    <img src="img/2.jpg" alt="Image 2">
  </div>

  <div class="three-column-wrapper">
    <div class="rides-container">
      <h3>Covoiturages</h3>
      <div class="rides-list">
        <a href="trajets-disponibles-utilisateurs.php" class="ride-card">
          <img src="img/img-reims.jpg" alt="Paris Reims">
          <div class="ride-card-title">Paris ➝ Reims</div>
        </a>
        <a href="trajets-disponibles-utilisateurs.php" class="ride-card">
          <img src="img/imp-paris.jpg" alt="Reims Paris">
          <div class="ride-card-title">Reims ➝ Paris</div>
        </a>
        <a href="trajets-disponibles-utilisateurs.php" class="ride-card">
          <img src="img/img-Lyon.jpg" alt="Paris Lyon">
          <div class="ride-card-title">Paris ➝ Lyon</div>
        </a>
      </div>
    </div>


<div class="search-box">
  <h2>Rechercher un trajet</h2>
  <form>
    <input type="text" placeholder="Ville de départ">
    <input type="text" placeholder="Ville d'arrivée">
    <input type="date" name="date" min="2025-01-01" max="2025-12-31" required>
    <input type="number" placeholder="Passagers"min="1"max="4">
    <button type="submit">Rechercher</button>
  </form>
</div>

<div class="reviews-container">
  <h3>Avis</h3>
  <div class="reviews-list">
    <div class="review-card">
      <img src="img/avatar1.png" alt="Catherine">
      <div class="review-content">
        <strong>Catherine</strong><br>
        Octobre 2024<br>
        <p>Facile d’utilisation, fluide et rapide !</p>
      </div>
    </div>
    <div class="review-card">
      <img src="img/avatar2.png" alt="Charlène">
      <div class="review-content">
        <strong>Charlène</strong><br>
        Mars 2025<br>
        <p>Claire, intuitive et made in France !</p>
      </div>
    </div>
    <div class="review-card">
      <img src="img/avatar3.png" alt="Laurent">
      <div class="review-content">
        <strong>Laurent</strong><br>
        Mai 2025<br>
        <p>Moins cher, très efficace et rapide.</p>
      </div>
    </div>
  </div>
</div>


  </div>

  <div class="column">
    <img src="img/3.jpg" alt="Image 3">
    <img src="img/4.jpg" alt="Image 4">
  </div>

  <footer>
    <div><a href="contact-users.html">Contact</a></div>
    <div><a href="mentions-legales-users.html">Mentions légales</a></div>
  </footer>

</body>
</html>