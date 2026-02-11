<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Récupère le nom du fichier actuel pour gérer la classe 'active'
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIQUE LEARN - Excellence Académique</title>
        <link rel="icon" href="../assets/img/favicon.ico">
    <link rel="icon" type="image/png" href="../assets/img/UNIQUE.png">
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="nav-container">
           <div class="logo">
        <img src="../assets/img/logo.png" alt="UNIQUE LEARN" class="logo-img">
    </div>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <div class="nav-right" id="navMenu">
                <button class="menu-close" id="menuClose" aria-label="Close menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>

                <ul class="nav-menu">
                    <li>
                        <a href="index.php" class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Accueil</a>
                    </li>
                    <li>
                        <a href="formations.php" class="nav-link <?php echo ($current_page == 'formations.php') ? 'active' : ''; ?>">Formations</a>
                    </li>
                </ul>

                <div class="nav-buttons">
                    <?php if (isset($_SESSION['admin_connected']) || isset($_SESSION['user_id'])): ?>
                        <button class="btn-connect" onclick="window.location.href='../admin/logout.php'">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    <?php else: ?>
                        <a href="login.php" class="nav-link-mobile">Se connecter</a>
                        <a href="inscription.php" class="nav-link-mobile">S'inscrire</a>
                        <button class="btn-register" onclick="window.location.href='inscription.php'">
                            S'inscrire
                        </button>
                        <button class="btn-connect" onclick="window.location.href='login.php'">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Se connecter
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <style>


.logo-img {
    height: 60px; /* Taille augmentée pour desktop */
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


        /* (Le reste de votre CSS reste identique) */
        .menu-toggle { display: none; background: none; border: none; cursor: pointer; color: var(--primary-blue); padding: 0.5rem; z-index: 1001; }
        .menu-close { display: none; background: none; border: none; cursor: pointer; color: var(--white); padding: 1rem; position: absolute; top: 1rem; right: 1rem; z-index: 1003; }
        .nav-link-mobile { display: none; color: var(--white); font-size: 1.2rem; font-weight: 600; text-decoration: none; transition: color 0.3s ease; }
        .nav-link-mobile:hover { color: var(--accent-orange); }

        @media (max-width: 968px) {
            .menu-toggle { display: flex; align-items: center; justify-content: center; order: 2; }
            .nav-right { position: fixed; top: 0; left: -100%; width: 100%; height: 100vh; background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)); display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding-top: 5rem; gap: 2rem; transition: left 0.3s ease; z-index: 1000; }
            .nav-right.active { left: 0; }
            .menu-close { display: flex; align-items: center; justify-content: center; }
            .nav-menu { flex-direction: column; gap: 2rem; align-items: center; width: 100%; padding: 2rem; }
            .nav-link { font-size: 1.2rem; color: var(--white); font-weight: 600; }
            .nav-link::after { display: none; }
            .nav-link:hover { color: var(--accent-orange); }
            .nav-buttons { flex-direction: column; width: 100%; padding: 2rem; gap: 2rem; align-items: center; }
            .nav-link-mobile { display: block; font-size: 1.2rem; padding: 1rem 0; }
            .btn-register, .btn-connect { display: none; }
            .logo { order: 1; }
            .nav-container { position: relative; }
        }

        @media (max-width: 480px) {
            .nav-right { padding-top: 4rem; }
            .nav-menu { padding: 1rem; gap: 1.5rem; }
            .nav-link { font-size: 1.1rem; }
            .nav-buttons { padding: 1rem; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const menuClose = document.getElementById('menuClose');
            const navMenu = document.getElementById('navMenu');

            if (menuToggle) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    navMenu.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (menuClose) {
                menuClose.addEventListener('click', function(e) {
                    e.stopPropagation();
                    navMenu.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }
        });
    </script>