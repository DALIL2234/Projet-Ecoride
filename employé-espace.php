<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoride - Espace Employé</title>
  <link href="https://fonts.googleapis.com/css2?family=NTR&family=Nunito&family=Anton&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #80e5ff;
      font-family: 'Nunito', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: #000;
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
      max-width: 900px;
      width: 90%;
      margin: 2rem auto;
      text-align: center;
    }

    h2 {
      font-family: 'Anton', sans-serif;
      font-size: 2rem;
      font-weight: 900;
      margin-bottom: 1.5rem;
    }

    .card {
      background: #f9f9f9;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
      text-align: left;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-success, .btn-danger {
      padding: 0.5rem 1rem;
      border-radius: 8px;
      border: none;
      color: #fff;
      cursor: pointer;
      margin-right: 0.5rem;
    }

    .btn-success { background-color: #28a745; }
    .btn-danger { background-color: #dc3545; }

    footer { margin-top: auto; }
  </style>
</head>
<body>

<header>
  <a href="dashboard.php" class="logo">ECORIDE</a>
</header>

<div class="container">
  <h2>Avis à valider</h2>

  <div class="card">
    <p><strong>Avis :</strong> Super trajet, merci !</p>
    <button class="btn-success">Valider</button>
    <button class="btn-danger">Refuser</button>
  </div>
  
  <div class="card">
    <p><strong>Avis :</strong> Très agréable et ponctuel.</p>
    <button class="btn-success">Valider</button>
    <button class="btn-danger">Refuser</button>
  </div>

  <h2>Plaintes à examiner</h2>

  <div class="card">
    <p><strong>Passager (Louis) :</strong> Le chauffeur était très en retard et n'a pas prévenu à l'avance.</p>
    <button class="btn-success">Traiter</button>
  </div>

  <div class="card">
    <p><strong>Passager (Emma) :</strong> La voiture était sale et sentait mauvais.</p>
    <button class="btn-success">Traiter</button>
  </div>

  <div class="card">
    <p><strong>Chauffeur (Marc) :</strong> Le passager était agressif et impoli.</p>
    <button class="btn-success">Traiter</button>
  </div>

  <div class="card">
    <p><strong>Chauffeur (Sophie) :</strong> Le passager n'est pas venu au point de rendez-vous convenu.</p>
    <button class="btn-success">Traiter</button>
  </div>

</div>

<footer>
  <p>© 2025 Ecoride</p>
</footer>

</body>
</html>
