<?php
// inscription.php
require_once '../includes/connexion.php';
include '../includes/header.php';

$selected_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Fetch formations for the dropdown
$stmt = $pdo->query("SELECT id, titre FROM formations ORDER BY titre ASC");
$formations = $stmt->fetchAll();
?>

<head>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<main class="inscription-page">
    <div class="container">
        <div class="inscription-header">
            <h1 class="inscription-title">
                Rejoignez <span class="highlight-orange">l'Excellence</span>
            </h1>
            <div class="section-underline"></div>
            <p class="inscription-subtitle">
                Faites le premier pas vers une carrière d'exception. Notre processus de sélection privilégie la motivation et le potentiel.
            </p>
        </div>

        <div class="inscription-form-card">
            <form action="traitement_inscription.php" method="POST" id="inscriptionForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <input type="text" name="nom" id="nom" required placeholder="votre nom">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <input type="text" name="prenom" id="prenom" required placeholder="votre prénom">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input type="email" name="email" id="email" required placeholder="votre@email.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tel">Téléphone</label>
                        <div class="input-wrapper">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <input type="tel" name="tel" id="tel" placeholder="+212 6 XX XX XX XX">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="id_formation">Programme Ciblé <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                        <select name="id_formation" id="id_formation" required>
                            <option value="">-- Choisissez votre formation --</option>
                            <?php foreach ($formations as $f): ?>
                                <option value="<?php echo $f['id']; ?>" <?php echo ($selected_id == $f['id'] ? 'selected' : ''); ?>>
                                    <?php echo htmlspecialchars($f['titre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="commentaire">Parlez-nous de vos motivations</label>
                    <textarea name="commentaire" id="commentaire" placeholder="Pourquoi souhaitez-vous intégrer ce programme ?"></textarea>
                </div>

                <div class="form-submit">
                    <button type="submit" class="btn-submit">
                        Soumettre ma Candidature
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                    <p class="form-privacy">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Vos données sont protégées selon notre politique de confidentialité.
                    </p>
                </div>
            </form>
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
