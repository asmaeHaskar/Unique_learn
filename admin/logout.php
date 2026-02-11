
<?php
// logout.php (Placé à la racine /vf/)
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil ou de connexion
header("Location: ../public/index.php");
exit();
?>