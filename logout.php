<?php
session_start();

// Supprime la session
$_SESSION = [];
session_unset();
session_destroy();

// Supprime le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Désactive le cache navigateur + empêche le retour arrière
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="0;url=index.html">
  <title>Déconnexion</title>
  <script>
    // Redirection immédiate en JavaScript (renforce le rafraîchissement)
    window.location.replace("index.html");
  </script>
</head>
<body>
  <p>Déconnexion en cours...</p>
</body>
</html>
