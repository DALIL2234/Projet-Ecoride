<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoride - Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #80e5ff;
      font-family: 'Nunito', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header, footer {
      background-color: #b3f0ff;
      text-align: center;
      padding: 1rem;
    }

    .logo {
      font-family: 'NTR', sans-serif;
      font-weight: bold;
      font-size: 2rem;
      color: black;
      text-decoration: none;
    }
    
    .container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 2rem;
      max-width: 500px;
      width: 90%;
      margin: 3rem auto;
      text-align: center;
    }

    h2 {
      margin-bottom: 1.5rem;
    }

    .btn-custom {
      background-color: #007acc;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      padding: 8px 16px;
      border: none;
      text-decoration: none;
      display: inline-block;
      margin: 0.5rem 0;
      transition: background-color 0.3s ease;
      width: 80%;
      max-width: 250px;
    }

    .btn-custom:hover {
      background-color: #006bb3;
    }

    footer {
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .btn-custom {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="login.html" class="logo">ECORIDE</a>
</header>


<div class="container">
  <h2>Gestion de la Plateforme</h2>
  <a href="voir-covoiturages.php" class="btn-custom">Voir Covoiturages</a><br>
  <a href="gerer-employes.php" class="btn-custom">Gérer Employés</a><br>
  <a href="graphiques-stats.php" class="btn-custom">Graphiques Stats</a><br>
  <a href="suspendre-compte.php" class="btn-custom">Suspendre un compte</a>
</div>

<footer>
  <p>© 2025 Ecoride</p>
</footer>

</body>
</html>
