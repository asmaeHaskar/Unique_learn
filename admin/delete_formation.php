<?php
// admin/delete_formation.php
session_start();
if (!isset($_SESSION['admin_connected'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../includes/connexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM formations WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: admin_formations.php');
exit();
?>
