<?php
// index.php
require_once '../includes/connexion.php';
include '../includes/header.php';

// On récupère les 8 dernières formations pour un slider bien rempli
$stmt = $pdo->query("SELECT * FROM formations ORDER BY id DESC LIMIT 8");
$featured = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>


<section class="hero" id="accueil">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">
            <span class="title-fst">UNIQUE</span>
            <span class="title-settat">LEARN</span>
        </h1>
        <p class="hero-description">
            Nous avons pour mission de former et guider les futurs ingénieurs, en
            leur offrant les compétences et les connaissances nécessaires pour
            relever les défis technologiques de demain.
        </p>
        <div class="hero-buttons">
            <button class="btn btn-primary" onclick="document.getElementById('apropos').scrollIntoView({behavior: 'smooth'})">En savoir plus</button>
            <button class="btn btn-secondary" onclick="document.getElementById('formations').scrollIntoView({behavior: 'smooth'})">
                Voir les filières
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>

<section class="about" id="apropos">
    <div class="container">
        <h2 class="section-title">À Propos de la UNIQUE LEARN</h2>
        <p class="about-text">
            <b>Unique Learn</b> est une plateforme de l'enseignement supérieur,
            faisant partie de l'Université Hassan 1er. Elle a pour vocation la
            formation, la recherche continue et le développement des compétences
            dans les domaines des sciences et techniques.
        </p>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <h3 class="stat-number">+1500</h3>
                <p class="stat-label">Étudiants Formés</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-number">95%</h3>
                <p class="stat-label">Taux de Réussite</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-number">50+</h3>
                <p class="stat-label">Experts Formateurs</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-number">100%</h3>
                <p class="stat-label">Accompagnement Pro</p>
            </div>
        </div>
    </div>
</section>

<section class="formations" id="formations">
    <div class="container">
        <h2 class="section-title">Nos Formations Phares</h2>
        <div class="section-underline"></div>
        <p class="section-subtitle">
            Découvrez nos programmes d'excellence conçus pour répondre aux besoins du marché.
        </p>

        <div class="formations-slider-container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($featured as $f): ?>
                        <div class="swiper-slide">
                            <div class="program-card">
                                <div class="card-image" style="background-image: url('../assets/img/<?php echo $f['image_url']; ?>');">
                                    <span class="card-badge badge-engineering"><?php echo htmlspecialchars($f['categorie']); ?></span>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title"><?php echo htmlspecialchars($f['titre']); ?></h3>
                                    <p class="card-description">
                                        <?php echo htmlspecialchars(substr($f['description'], 0, 110)) . '...'; ?>
                                    </p>
                                    <div class="card-meta">
                                        <span class="meta-item">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <?php echo htmlspecialchars($f['duree']); ?>
                                        </span>
                                    </div>
                                    <a href="formation_detail.php?id=<?php echo $f['id']; ?>" class="btn-card">
                                        Voir la formation
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <div class="catalog-button-container">
            <a href="formations.php" class="btn btn-outline">
                Voir tout le catalogue
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<section class="pourquoi-nous" id="about">
    <div class="container">
        <div class="pourquoi-grid">
            <div class="pourquoi-image">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1471" alt="Pourquoi Unique Learn">
            </div>
            <div class="pourquoi-content">
                <span class="pourquoi-badge">POURQUOI NOUS ?</span>
                <h2 class="pourquoi-title">Une méthode d'apprentissage <span class="highlight">Unique</span></h2>
                <p class="pourquoi-description">
                    Nos formations sont conçues pour être concrètes, immersives et orientées vers le résultat. Nous ne nous contentons pas de transmettre du savoir, nous forgeons des compétences prêtes à l'emploi.
                </p>

                <div class="pourquoi-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                <path d="M2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h4>Accélération de Carrière</h4>
                            <p>Programmes condensés pour un impact maximum en un minimum de temps.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        <div class="feature-text">
                            <h4>Certifications Reconnues</h4>
                            <p>Obtenez une reconnaissance officielle de vos nouvelles compétences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="logo-fst" style=" color: var(--accent-orange)">UNIQUE</span>
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
                <p><a href="">5 23 40 07 36</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> UNIQUE LEARN. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 15,
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      // Sur tablette
      768: { slidesPerView: 2, spaceBetween: 25 },
      // Sur PC (3 cartes)
      1024: { slidesPerView: 3, spaceBetween: 30 },
      // Sur grand écran (4 cartes pour occuper tout l'espace blanc)
      1440: { slidesPerView: 4, spaceBetween: 30 },
    },
  });
</script>

</body>
</html>
