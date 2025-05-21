<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EcoRide - Inscription</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #80e5ff;
    }

    header {
      font-family: 'NTR', sans-serif;
      position: relative;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
    }

    .logo {
      text-decoration: none;
      color: black;
      font-size: 2rem;
      font-weight: bold;
    }

    .burger {
      font-size: 2rem;
      cursor: pointer;
      display: none;
    }

    .nav-links {
      display: flex;
      list-style: none;
      gap: 1rem;
    }

    .nav-links a {
      text-decoration: none;
      color: black;
      font-size: 1.2rem;
      padding-left: 8px;
    }

    .nav-links a.active {
      color: #007acc;
    }

    main.content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }


    .form-box {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }


    .form-box h2 {
      font-weight: bold;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
    }


    .form-box form {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }


    .form-box input,
    .form-box button {
      width: 100%;
      height: 45px;
      font-size: 1rem;
      padding: 0.75rem;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .form-box button {
      background-color: #007acc;
      color: white;
      font-weight: bold;
      cursor: pointer;
      border: none;
    }

    footer {
      background-color: #b3f0ff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
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

      .nav-links.nav-active {
        display: flex;
      }

      .burger {
        display: block;
      }

      main.content {
        padding: 1rem;
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
    <nav class="navbar">
      <a href="index.html" class="logo">ECORIDE</a>
      <div class="burger">&#9776;</div>
      <ul class="nav-links">
        <li><a href="index.html" class="active">Accueil</a></li>
        <li><a href="covoiturages.html">Covoiturages</a></li>
        <li><a href="avis.html">Avis</a></li>
        <li><a href="login.html">Connexion</a></li>
      </ul>
    </nav>
  </header>


  <main class="content">
      <div class="form-box">
      <h2>Inscription</h2>
      <?php if (isset($_GET['success'])): ?>
      <div style="color: green; font-weight: bold; margin-bottom: 1rem;">
    ✅ Inscription réussie !
      </div>
      <?php endif; ?>


        <form action="users_register.php" method="POST">
  <input type="text" name="nom" placeholder="Nom" required>
  <input type="text" name="prenom" placeholder="Prénom" required>
  <input type="date" name="date_naissance" min="1950-01-01" max="2020-12-31" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
  <button type="submit">S'inscrire</button>
</form>

      
    </div>
  </main>

  <footer>
    <div><a href="contact.html" style="text-decoration:none; color:black; font-weight:bold;">Contact</a></div>
    <div><a href="mentions-legales.html" style="text-decoration:none; color:black;">Mentions legales</a></div>
  </footer>
</body>
</html>
