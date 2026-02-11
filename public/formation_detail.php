<?php
// formation_detail.php
require_once '../includes/connexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: formations.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM formations WHERE id = ?");
$stmt->execute([$id]);
$f = $stmt->fetch();

if (!$f) {
    die("Formation non trouvée.");
}

include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<main class="formation-detail-page">
    <div class="detail-card">
        <!-- Full Width Hero Image -->
        <div class="detail-hero">
            <img src="../assets/img/<?php echo $f['image_url']; ?>" alt="<?php echo htmlspecialchars($f['titre']); ?>" class="detail-hero-img">
            <div class="detail-hero-overlay"></div>
            <div class="detail-hero-content">
                <span class="detail-badge"><?php echo htmlspecialchars($f['categorie']); ?></span>
                <h1 class="detail-title"><?php echo htmlspecialchars($f['titre']); ?></h1>

                <div class="detail-meta">
                    <span class="detail-meta-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <?php echo htmlspecialchars($f['duree']); ?>
                    </span>
                    <span class="detail-meta-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <?php echo number_format($f['prix'], 2); ?> MAD
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-body">
            <div class="container">
                <div class="detail-grid">
                    <div class="detail-main">
                        <h2 class="detail-section-title">
                            Présentation du <span class="highlight-orange">Parcours</span>
                        </h2>
                        <p class="detail-description">
                            <?php echo nl2br(htmlspecialchars($f['description'])); ?>
                        </p>

                        <div class="detail-objectives">
                            <h4>Objectifs Pédagogiques</h4>
                            <ul>
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    <span>Maîtrise complète des outils et méthodologies standards du secteur.</span>
                                </li>
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    <span>Réalisation de projets réels pour enrichir votre portfolio professionnel.</span>
                                </li>
                                <li>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    <span>Accompagnement personnalisé et coaching de carrière.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="detail-sidebar">
                        <div class="detail-cta-card">
                            <h3>Prêt à donner un élan à votre carrière ?</h3>
                            <p>Rejoignez une communauté d'apprenants passionnés et bénéficiez d'un encadrement par des experts du domaine.</p>
                            <a href="inscription.php?id=<?php echo $f['id']; ?>" class="btn btn-primary btn-full">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                                Candidater
                            </a>

                            <!-- Résumé Formation Intégré -->
                            <div class="formation-summary-inline">
                                <div class="summary-item-inline">
                                    <span class="summary-icon-inline">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="summary-label-inline">Durée</p>
                                        <p class="summary-value-inline"><?php echo htmlspecialchars($f['duree']); ?></p>
                                    </div>
                                </div>
                                <div class="summary-item-inline">
                                    <span class="summary-icon-inline">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="summary-label-inline">Prix</p>
                                        <p class="summary-value-inline"><?php echo number_format($f['prix'], 2); ?> MAD</p>
                                    </div>
                                </div>
                                <div class="summary-item-inline">
                                    <span class="summary-icon-inline">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="summary-label-inline">Type</p>
                                        <p class="summary-value-inline">Présentiel</p>
                                    </div>
                                </div>
                                <div class="summary-item-inline">
                                    <span class="summary-icon-inline">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="summary-label-inline">Certificat</p>
                                        <p class="summary-value-inline">Professionnel</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="formations.php" class="detail-back-link">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Retourner au Catalogue
                        </a>
                    </div>
                </div>

                <!-- Programme et Contenu -->
                <div class="detail-section" style="margin-top: 4rem;">
                    <h3 class="detail-section-title">
                        Programme et <span class="highlight-orange">Contenu</span>
                    </h3>
                    <div class="detail-modules">
                        <div class="module-item">
                            <div class="module-header">
                                <h4>Module 1 : Fondamentaux</h4>
                                <span class="module-duration">2 semaines</span>
                            </div>
                            <p>Apprentissage des bases essentielles et des concepts clés du domaine.</p>
                        </div>
                        <div class="module-item">
                            <div class="module-header">
                                <h4>Module 2 : Techniques Avancées</h4>
                                <span class="module-duration">3 semaines</span>
                            </div>
                            <p>Maîtrise des outils professionnels et des techniques spécialisées.</p>
                        </div>
                        <div class="module-item">
                            <div class="module-header">
                                <h4>Module 3 : Projets Pratiques</h4>
                                <span class="module-duration">2 semaines</span>
                            </div>
                            <p>Réalisation de projets concrets pour mettre en pratique vos connaissances.</p>
                        </div>
                    </div>
                </div>

                <!-- Prérequis et Public Cible -->
                <div class="detail-section" style="margin-top: 4rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                        <div>
                            <h3 class="detail-section-title">
                                Prérequis
                            </h3>
                            <ul class="detail-list">
                                <li>Bac ou équivalent obligatoire</li>
                                <li>Excellente motivation et capacité d'apprentissage</li>
                                <li>Compétences informatiques de base</li>
                                <li>Maîtrise de la langue française</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="detail-section-title">
                                Public Cible
                            </h3>
                            <ul class="detail-list">
                                <li>Jeunes diplômés en quête de spécialisation</li>
                                <li>Professionnels en reconversion</li>
                                <li>Entrepreneurs ambitieux</li>
                                <li>Salariés en développement de carrière</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Méthodologie Pédagogique -->
                <div class="detail-section" style="margin-top: 4rem;">
                    <h3 class="detail-section-title">
                        Méthodologie <span class="highlight-orange">Pédagogique</span>
                    </h3>
                    <div class="methodology-grid">
                        <div class="methodology-item">
                            <div class="methodology-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                            </div>
                            <h4>Cours Interactifs</h4>
                            <p>Contenu dynamique avec vidéos, cas pratiques et discussions en groupe.</p>
                        </div>
                        <div class="methodology-item">
                            <div class="methodology-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <h4>Pratique en Temps Réel</h4>
                            <p>Exercices pratiques immédiatement après chaque concept enseigné.</p>
                        </div>
                        <div class="methodology-item">
                            <div class="methodology-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <h4>Certification Validée</h4>
                            <p>Obtention d'une certification professionnelle reconnue sur le marché.</p>
                        </div>
                    </div>
                </div>

                <!-- Débouchés Professionnels -->
                <div class="detail-section" style="margin-top: 4rem;">
                    <h3 class="detail-section-title">
                        Débouchés <span class="highlight-orange">Professionnels</span>
                    </h3>
                    <div class="outcomes-grid">
                        <div class="outcome-item">
                            <h4>Postes Accessibles</h4>
                            <p>Accès à des positions stratégiques dans les plus grandes entreprises nationales et internationales.</p>
                        </div>
                        <div class="outcome-item">
                            <h4>Salaire Moyen</h4>
                            <p>Rémunération compétitive entre 25 000 MAD et 45 000 MAD annuels selon l'expérience.</p>
                        </div>
                        <div class="outcome-item">
                            <h4>Taux d'Emploi</h4>
                            <p>95% de nos diplômés trouvent un emploi dans les 3 mois suivant la fin du parcours.</p>
                        </div>
                    </div>
                </div>
                </div>
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
