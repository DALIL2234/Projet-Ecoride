<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gérer les Employés - EcoRide Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Nunito&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }

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
      padding: 1rem;
      text-align: center;
    }

    .logo {
      font-size: 2rem;
      font-weight: bold;
      text-decoration: none;
      color: black;
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
      max-width: 900px;
      margin: 2rem auto;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1, h2 {
      font-family: 'Anton', sans-serif;
      font-weight: 900;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    h1 { font-size: 2.4rem; }
    h2 { font-size: 2rem; }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    th, td {
      padding: 0.8rem;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #007acc;
      color: white;
    }

    td { background-color: #f9f9f9; }

    footer {
      margin-top: auto;
      background-color: #b3f0ff;
      padding: 1rem;
      text-align: center;
      font-weight: bold;
    }

    footer a {
      text-decoration: none;
      color: black;
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
  <h1>Gestion des Employés</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 1; $i <= 20; $i++): ?>
        <tr>
          <td><?= $i ?></td>
          <td>Employé <?= $i ?></td>
          <td>employe<?= $i ?>@ecoride.com</td>
          <td><?= ($i % 2 == 0) ? "Modérateur" : "Support" ?></td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</div>

<footer>
  <a href="admin.php">← Retour Admin</a>
</footer>

</body>
</html>