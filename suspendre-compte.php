<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecoride - Suspendre un compte</title>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=NTR&family=Nunito&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #80e5ff;
      font-family: 'Nunito', sans-serif;
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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
      font-weight: bold;
      font-size: 2.2rem;
      margin-bottom: 1.5rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 2rem;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th, td {
      padding: 0.8rem;
    }

    th {
      background-color: #b3f0ff;
    }

    button {
      background-color: #007acc;
      color: white;
      border: none;
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }

    button:hover {
      background-color: #006bb3;
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
  <h2>Suspendre un compte</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Jean Dupont</td>
        <td>jean@example.com</td>
        <td>Utilisateur</td>
        <td><button>Suspendre</button></td>
      </tr>
      <tr>
        <td>2</td>
        <td>Marie Durand</td>
        <td>marie@example.com</td>
        <td>Employé</td>
        <td><button>Suspendre</button></td>
      </tr>
      <tr>
        <td>3</td>
        <td>Luc Martin</td>
        <td>luc@example.com</td>
        <td>Utilisateur</td>
        <td><button>Suspendre</button></td>
      </tr>
      <tr>
        <td>4</td>
        <td>Anne Petit</td>
        <td>anne@example.com</td>
        <td>Employé</td>
        <td><button>Suspendre</button></td>
      </tr>
    </tbody>
  </table>
</div>

<footer>
  <p>© 2025 Ecoride</p>
</footer>

</body>
</html>
