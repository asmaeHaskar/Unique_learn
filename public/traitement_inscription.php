<?php
// traitement_inscription.php
require_once '../includes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom           = htmlspecialchars(trim($_POST['nom'] ?? ''));
    $prenom        = htmlspecialchars(trim($_POST['prenom'] ?? ''));
    $email         = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $tel           = htmlspecialchars(trim($_POST['tel'] ?? ''));
    $id_formation  = filter_input(INPUT_POST, 'id_formation', FILTER_VALIDATE_INT);
    $commentaire   = htmlspecialchars(trim($_POST['commentaire'] ?? ''));

    if ($nom && $prenom && $email && $id_formation) {
        try {
            $stmt = $pdo->prepare("INSERT INTO inscriptions (nom, prenom, email, tel, id_formation, commentaire, date_inscription)
                                   VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$nom, $prenom, $email, $tel, $id_formation, $commentaire]);
            $status = "success";
            $message = "Votre demande d'inscription a été envoyée avec succès ! Nous vous recontacterons prochainement.";
        } catch (PDOException $e) {
            $status = "error";
            $message = "Oups ! Une erreur technique s'est produite.";
        }
    } else {
        $status = "error";
        $message = "Veuillez remplir tous les champs obligatoires.";
    }
} else {
    header('Location: index.php');
    exit();
}

include '../includes/header.php';
?>

<main class="confirmation-container">
    <div class="form-card">
        <div style="width: 80px; height: 80px; background: <?php echo $status == 'success' ? '#ecfdf5' : '#fef2f2'; ?>; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
            <i class="fas <?php echo $status == 'success' ? 'fa-check' : 'fa-times'; ?>"
               style="font-size: 2.5rem; color: <?php echo $status == 'success' ? '#10b981' : '#ef4444'; ?>;"></i>
        </div>

        <h2 style="color: #1e3a8a; font-size: 1.8rem; margin-bottom: 1rem; font-weight: 700;">
            <?php echo $status == 'success' ? 'Demande Reçue !' : 'Erreur'; ?>
        </h2>
        <p style="color: #64748b; line-height: 1.6; margin-bottom: 2rem;">
            <?php echo $message; ?>
        </p>

        <a href="index.php" class="btn btn-primary" style="display: inline-block; padding: 0.8rem 2rem; border-radius: 10px; text-decoration: none;">
            Retour à l'accueil
        </a>
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
