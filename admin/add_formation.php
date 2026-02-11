<?php
// admin/add_formation.php
include 'includes/header.php';
require_once '../includes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre       = htmlspecialchars(trim($_POST['titre'] ?? ''));
    $categorie   = htmlspecialchars(trim($_POST['categorie'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $duree       = htmlspecialchars(trim($_POST['duree'] ?? ''));
    $prix        = floatval($_POST['prix'] ?? 0);
    $image_url   = 'logo.png'; // Image par défaut

    // Gestion de l'upload d'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/img/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = basename($_FILES['image']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($file_ext, $allowed_ext)) {
            $unique_name = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
            $upload_path = $upload_dir . $unique_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_url = $unique_name;
            }
        }
    }

    if ($titre && $description) {
        $stmt = $pdo->prepare("INSERT INTO formations (titre, categorie, description, duree, prix, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $categorie, $description, $duree, $prix, $image_url]);
        header('Location: admin_formations.php');
        exit();
    }
}
?>

<div class="admin-page-header">
    <div class="container">
        <h1>Ajouter une <span style="color: var(--accent-orange);">Formation</span></h1>
        <p>Créez un nouveau programme d'excellence pour vos futurs étudiants.</p>
    </div>
</div>

<main class="container admin-content">
    <div class="form-card">
        <div class="form-header">
            <h2>Nouvelle Formation</h2>
            <p>Remplissez les informations ci-dessous</p>
        </div>

        <form action="add_formation.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label><i class="fas fa-image"></i> Image de couverture</label>
                <div class="image-preview-container">
                    <div class="image-preview" id="image-preview">
                        <div class="preview-content">
                            <i class="fas fa-cloud-upload-alt fa-2x" style="color: #CBD5E0;"></i>
                            <p>Cliquez pour choisir une image</p>
                        </div>
                        <button type="button" class="remove-image-btn" id="remove-image-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <input type="file" id="image-input" name="image" accept="image/*" style="display: none;">
                </div>
            </div>

            <div class="form-group">
                <label for="titre"><i class="fas fa-graduation-cap"></i> Titre de la Formation *</label>
                <input type="text" name="titre" id="titre" required placeholder="ex: Développeur Full-Stack">
            </div>

            <div class="form-group">
                <label for="categorie"><i class="fas fa-tag"></i> Catégorie</label>
                <input type="text" name="categorie" id="categorie" placeholder="ex: Informatique, Management...">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="duree"><i class="far fa-clock"></i> Durée</label>
                    <input type="text" name="duree" id="duree" placeholder="ex: 3 mois">
                </div>
                <div class="form-group">
                    <label for="prix"><i class="fas fa-euro-sign"></i> Prix (MAD)</label>
                    <input type="number" step="0.01" name="prix" id="prix" placeholder="0.00">
                </div>
            </div>

            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Description Détaillée *</label>
                <textarea name="description" id="description" required rows="5" placeholder="Décrivez le contenu..."></textarea>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-admin btn-save">
                    <i class="fas fa-check-circle"></i> Enregistrer la formation
                </button>
                <a href="admin_formations.php" class="btn-admin btn-cancel">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</main>

<script>
    // Script de gestion de la prévisualisation
    const imagePreview = document.getElementById('image-preview');
    const imageInput = document.getElementById('image-input');
    const removeImageBtn = document.getElementById('remove-image-btn');

    imagePreview.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                imagePreview.style.backgroundImage = `url('${event.target.result}')`;
                imagePreview.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        imageInput.value = '';
        imagePreview.style.backgroundImage = '';
        imagePreview.classList.remove('has-image');
    });
</script>

<?php include 'includes/footer.php'; ?>