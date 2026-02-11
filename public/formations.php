<?php
// formations.php
require_once '../includes/connexion.php';
include '../includes/header.php';

// Get selected category
$selected_cat = $_GET['cat'] ?? '';

// Fetch all unique categories for the filter bar
$cat_stmt = $pdo->query("SELECT DISTINCT categorie FROM formations WHERE categorie != '' ORDER BY categorie ASC");
$categories = $cat_stmt->fetchAll(PDO::FETCH_COLUMN);

// Prepare the formation query with filter
$query = "SELECT * FROM formations";
$params = [];

if ($selected_cat) {
    $query .= " WHERE categorie = ?";
    $params[] = $selected_cat;
}

$query .= " ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$formations = $stmt->fetchAll();
?>

<!-- Premium Header for Formations List -->
<section class="formations-header">
    <div class="formations-header-overlay"></div>
    <div class="container">
        <div class="formations-header-content">
            <h1 class="formations-header-title">
                Explorez nos <span class="highlight-orange">Formations</span>
            </h1>
            <div class="section-underline"></div>
            <p class="formations-header-description">
                Découvrez des parcours d'apprentissage conçus pour l'avenir. Des technologies de pointe aux soft skills indispensables.
            </p>
        </div>
    </div>
</section>

<!-- Catalogue Section -->
<section class="catalogue-section" id="catalogue">
    <div class="container">
        <!-- Premium Filter Bar -->
        <div class="filter-bar">
            <span class="filter-label">Filtrer par :</span>
            <div class="filter-buttons">
                <a href="formations.php#catalogue" class="filter-btn <?php echo !$selected_cat ? 'active' : ''; ?>">
                    Toutes
                </a>

                <?php foreach ($categories as $cat): ?>
                    <a href="formations.php?cat=<?php echo urlencode($cat); ?>#catalogue"
                       class="filter-btn <?php echo $selected_cat === $cat ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($cat); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Formations Grid -->
        <div class="cards-grid">
            <?php if (empty($formations)): ?>
                <div class="empty-state">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="M21 21l-4.35-4.35"></path>
                    </svg>
                    <h3>Aucune formation trouvée</h3>
                    <p>Essayez de sélectionner une autre catégorie</p>
                    <a href="formations.php" class="btn btn-primary" style="margin-top: 2rem;">Voir toutes les formations</a>
                </div>
            <?php else: ?>
                <?php foreach ($formations as $f): ?>
                    <div class="program-card">
                        <div class="card-image" style="background-image: url('../assets/img/<?php echo $f['image_url']; ?>');">
                            <span class="card-badge badge-engineering"><?php echo htmlspecialchars($f['categorie']); ?></span>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title"><?php echo htmlspecialchars($f['titre']); ?></h3>
                            <p class="card-description">
                                <?php echo htmlspecialchars(substr($f['description'], 0, 120)) . '...'; ?>
                            </p>
                            <div class="card-meta">
                                <span class="meta-item">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <?php echo htmlspecialchars($f['duree']); ?>
                                </span>
                                <span class="meta-price"><?php echo number_format($f['prix'], 2); ?> MAD</span>
                            </div>
                            <a href="formation_detail.php?id=<?php echo $f['id']; ?>" class="btn-card">
                                Voir la formation
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

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
