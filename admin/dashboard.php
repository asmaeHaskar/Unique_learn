<?php
// admin/dashboard.php
session_start();
require_once '../includes/connexion.php';

// Vérification de sécurité : si l'admin n'est pas connecté, retour au login
if (!isset($_SESSION['admin_connected'])) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UNIQUE LEARN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

    <!-- Admin Header -->
    <header class="admin-header">
        <div class="admin-nav">
             <div class="logo">
                <img src="../assets/img/logo.png" alt="UNIQUE LEARN" class="logo-img">
            </div>
            
            <div class="admin-nav-right">
                <div class="admin-user">
                    <span>Admin Panel</span>
                </div>
                <a href="logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="admin-main">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Tableau de Bord</h1>
            <p class="dashboard-subtitle">Gérez facilement vos formations et inscriptions</p>
        </div>

        <div class="dashboard-container">

            <a href="admin_formations.php" class="card card-orange">
                <div class="card-top">
                    <i class="fas fa-graduation-cap card-top-icon"></i>
                    <div class="card-top-content">
                        <h2>Formations</h2>
                        <p class="card-top-description">Créez et modifiez vos programmes de formation</p>
                    </div>
                </div>
                <div class="card-bottom">
                    <span class="card-bottom-text">Gérer les formations</span>
                    <i class="fas fa-arrow-right card-bottom-arrow"></i>
                </div>
            </a>

            <a href="admin_inscriptions.php" class="card card-blue">
                <div class="card-top">
                    <i class="fas fa-users card-top-icon"></i>
                    <div class="card-top-content">
                        <h2>Inscriptions</h2>
                        <p class="card-top-description">Consultez et gérez les candidatures</p>
                    </div>
                </div>
                <div class="card-bottom">
                    <span class="card-bottom-text">Voir les inscriptions</span>
                    <i class="fas fa-arrow-right card-bottom-arrow"></i>
                </div>
            </a>

        </div>
    </main>

</body>
</html>






    <style>
            .logo-img {
            height: 50px; /* Taille augmentée pour desktop */
            width: auto;
            object-fit: contain;
            cursor: pointer;
        }

        /* Pour rendre le logo cliquable (optionnel) */
        .logo {
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .logo-img {
                height: 70px; /* Taille pour tablettes */
            }
        }

        @media (max-width: 480px) {
            .logo-img {
                height: 60px; /* Taille pour mobiles */
            }
        }
    </style>