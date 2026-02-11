<?php
// signup.php
require_once '../includes/connexion.php';
session_start();

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (!empty($nom) && !empty($email) && !empty($password)) {
        // Vérifier si l'email existe déjà
        $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            $error = "Cet email est déjà utilisé.";
        } else {
            // Hachage du mot de passe pour la sécurité
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");

            if ($stmt->execute([$nom, $email, $hashed_password])) {
                header('Location: login.php?signup_success=1');
                exit();
            }
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
include '../includes/header.php';
?>

<main class="signup-page">
    <div class="signup-card">
        <div class="signup-header">
            <h2>Créer un <span class="highlight-orange">Compte</span></h2>
            <p>Rejoignez notre communauté d'apprenants</p>
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

        <form action="signup.php" method="POST" class="signup-form">
            <div class="form-group">
                <label for="nom">Nom complet</label>
                <div class="input-wrapper">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input type="text" name="nom" id="nom" required placeholder="Jean Dupont">
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input type="email" name="email" id="email" required placeholder="votre@email.com">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-wrapper">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" name="password" id="password" required placeholder="••••••••">
                </div>
            </div>

            <div class="signup-submit">
                <button type="submit" class="btn-signup">
                    S'inscrire
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>
        </form>

        <div class="signup-footer">
            <p>Déjà membre ?</p>
            <a href="login.php">Se connecter</a>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
