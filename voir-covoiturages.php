<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoride - Voir Covoiturages</title>
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
      font-size: 2rem;
      font-weight: 900;
      margin-bottom: 1.5rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 0.8rem;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #007acc;
      color: white;
    }

    td {
      background-color: #f9f9f9;
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
  <h2>Voir Covoiturages</h2>

  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Trajet</th>
        <th>Conducteur</th>
        <th>Prix</th>
      </tr>
    </thead>
    <tbody>
      <!-- Exemple de 20 covoiturages -->
      <tr><td>10/05/2025</td><td>Paris ➝ Lyon</td><td>Julien</td><td>40 crédits (200€)</td></tr>
      <tr><td>11/05/2025</td><td>Lyon ➝ Marseille</td><td>Claire</td><td>30 crédits (150€)</td></tr>
      <tr><td>12/05/2025</td><td>Bordeaux ➝ Toulouse</td><td>Maxime</td><td>25 crédits (125€)</td></tr>
      <tr><td>13/05/2025</td><td>Lille ➝ Paris</td><td>Emma</td><td>35 crédits (175€)</td></tr>
      <tr><td>14/05/2025</td><td>Nantes ➝ Rennes</td><td>Lucie</td><td>20 crédits (100€)</td></tr>
      <tr><td>15/05/2025</td><td>Strasbourg ➝ Nancy</td><td>Hugo</td><td>15 crédits (75€)</td></tr>
      <tr><td>16/05/2025</td><td>Nice ➝ Cannes</td><td>Anna</td><td>10 crédits (50€)</td></tr>
      <tr><td>17/05/2025</td><td>Reims ➝ Paris</td><td>Thomas</td><td>25 crédits (125€)</td></tr>
      <tr><td>18/05/2025</td><td>Toulouse ➝ Montpellier</td><td>Sarah</td><td>20 crédits (100€)</td></tr>
      <tr><td>19/05/2025</td><td>Paris ➝ Bordeaux</td><td>Alex</td><td>50 crédits (250€)</td></tr>
      <tr><td>20/05/2025</td><td>Grenoble ➝ Lyon</td><td>Chloe</td><td>15 crédits (75€)</td></tr>
      <tr><td>21/05/2025</td><td>Marseille ➝ Nice</td><td>Lucas</td><td>25 crédits (125€)</td></tr>
      <tr><td>22/05/2025</td><td>Dijon ➝ Besançon</td><td>Eva</td><td>10 crédits (50€)</td></tr>
      <tr><td>23/05/2025</td><td>Metz ➝ Strasbourg</td><td>Paul</td><td>20 crédits (100€)</td></tr>
      <tr><td>24/05/2025</td><td>Angers ➝ Le Mans</td><td>Camille</td><td>15 crédits (75€)</td></tr>
      <tr><td>25/05/2025</td><td>Amiens ➝ Rouen</td><td>Leo</td><td>18 crédits (90€)</td></tr>
      <tr><td>26/05/2025</td><td>Limoges ➝ Poitiers</td><td>Zoe</td><td>12 crédits (60€)</td></tr>
      <tr><td>27/05/2025</td><td>Caen ➝ Cherbourg</td><td>Noah</td><td>14 crédits (70€)</td></tr>
      <tr><td>28/05/2025</td><td>Perpignan ➝ Narbonne</td><td>Louise</td><td>16 crédits (80€)</td></tr>
      <tr><td>29/05/2025</td><td>Avignon ➝ Marseille</td><td>Gabriel</td><td>20 crédits (100€)</td></tr>
    </tbody>
  </table>
</div>

<footer>
  <p>© 2025 Ecoride</p>
</footer>

</body>
</html>
