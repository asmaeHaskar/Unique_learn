<?php
// login.php
require_once '../includes/connexion.php';
session_start();

$error = "";
$success = "";

// Check if user just signed up
if (isset($_GET['signup_success'])) {
    $success = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = htmlspecialchars(trim($_POST['login']));
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {
        try {
            // Check admin table first
            $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
            $stmt->execute([$login]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_connected'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_login'] = $user['login'];
                header('Location: ../admin/dashboard.php');
                exit();
            }

            // Check regular users table only if admin check fails
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
            $stmt->execute([$login]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['user_email'] = $user['email'];
                header('Location: index.php?login=success');
                exit();
            }

            $error = "Identifiants incorrects.";
        } catch (PDOException $e) {
            $error = "Erreur de connexion à la base de données.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

include '../includes/header.php';
?>

<main class="login-page">
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <h2>Bienvenue au page <span style="color: var(--accent-orange);">Admin</span></h2>
                    <p>Connectez-vous à votre compte</p>
                </div>

                <?php if($error): ?>
                    <div class="alert alert-error">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if($success): ?>
                    <div class="alert alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="login">Email ou Login</label>
                        <div class="input-wrapper">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <input type="text" name="login" id="login" required placeholder="Entrez votre Login">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <div class="input-wrapper">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" name="password" id="password" required placeholder="Entrez votre mot de passe">
                        </div>
                    </div>

                    <div class="login-submit">
                        <button type="submit" class="btn-login">
                            Se connecter
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="logo-fst">UNIQUE</span>
                    <span class="logo-settat">LEARN</span>
                </div>
                <p class="footer-description">
                    Une plateforme d'excellence dédiée à la formation, la recherche et
                    l'innovation scientifique. Rejoignez-nous pour bâtir l'avenir.
                </p>
            </div>

            <div class="footer-links">
                <h4>Liens Rapides</h4>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="formations.php">Formations</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4>Contact</h4>
                <p>Km 3,5 Route de Casablanca</p>
                <p>BP 577, Settat, Maroc</p>
                <p>Tel: 05 23 40 07 36</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> UNIQUE LEARN. Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>
</html>
