<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['admin_connected'])) {
    header('Location: ../../public/login.php');
    exit();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Learn - Administration</title>
    <link rel="icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css"> <link rel="stylesheet" href="../css/admin-style.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <nav style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0;">
                <div class="logo">
                    <span class="logo-fst"><span style="color: #002142 ;">UNIQUE</span> ADMIN</span>
                </div>
                <ul class="nav-menu">
                    <li><a href="admin_formations.php" class="<?php echo ($current_page == 'admin_formations.php' ? 'active' : ''); ?>">Catalogue</a></li>
                    <li><a href="admin_inscriptions.php" class="<?php echo ($current_page == 'admin_inscriptions.php' ? 'active' : ''); ?>">Inscriptions</a></li>
                </ul>
                <div class="nav-buttons">
                    <span style="margin-right: 15px; font-weight: 600;"><?php echo htmlspecialchars($_SESSION['admin_login'] ?? 'Admin'); ?></span>
                    <a href="logout.php" class="btn-connect" style="background: var(--accent-orange);">Déconnexion</a>
                </div>
            </nav>
        </div>
    </header>