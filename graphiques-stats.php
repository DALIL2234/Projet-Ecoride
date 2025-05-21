<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoride - Graphiques Stats</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=NTR&family=Nunito&display=swap" rel="stylesheet">
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
      font-weight: 900;
      margin-bottom: 1.5rem;
    }

    .chart-container {
      margin-bottom: 2rem;
    }

    canvas {
      max-width: 100%;
      height: auto;
    }

    footer {
      margin-top: auto;
    }
  </style>
</head>
<body>

<header>
  <a href="login.html" class="logo">ECORIDE</a>
</header>

<div class="retour">
  <a href="admin.php">← Retour</a>
</div>

<div class="container">
  <h2>Statistiques des covoiturages</h2>

  <div class="chart-container">
    <canvas id="trajetsJour"></canvas>
  </div>

  <div class="chart-container">
    <canvas id="creditsGagnes"></canvas>
  </div>
</div>

<footer>
  <p>© 2025 Ecoride</p>
</footer>

<script>
  const ctxTrajets = document.getElementById('trajetsJour').getContext('2d');
  const trajetsJour = new Chart(ctxTrajets, {
    type: 'bar',
    data: {
      labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
      datasets: [{
        label: 'Nombre de trajets',
        data: [12, 19, 8, 15, 21, 10, 17],
        backgroundColor: '#007acc',
        borderRadius: 8
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const ctxCredits = document.getElementById('creditsGagnes').getContext('2d');
  const creditsGagnes = new Chart(ctxCredits, {
    type: 'line',
    data: {
      labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
      datasets: [{
        label: 'Crédits gagnés',
        data: [150, 200, 180, 220, 260, 300],
        backgroundColor: 'rgba(0,122,204,0.2)',
        borderColor: '#007acc',
        borderWidth: 2,
        tension: 0.3,
        fill: true
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>
