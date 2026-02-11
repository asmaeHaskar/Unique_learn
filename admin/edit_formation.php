<?php
/**
 * PARTIE 1 : RÉCUPÉRATION ET SÉCURITÉ PHP
 */
include 'includes/header.php'; 
require_once '../includes/connexion.php'; 

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: admin_formations.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM formations WHERE id = ?");
$stmt->execute([$id]);
$f = $stmt->fetch();

if (!$f) { 
    die("Formation non trouvée."); 
}

/**
 * PARTIE 2 : TRAITEMENT DE LA MISE À JOUR
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre       = htmlspecialchars(trim($_POST['titre'] ?? ''));
    $categorie   = htmlspecialchars(trim($_POST['categorie'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $duree       = htmlspecialchars(trim($_POST['duree'] ?? ''));
    $prix        = floatval($_POST['prix'] ?? 0);
    
    // On garde l'image actuelle par défaut
    $image_url = $f['image_url']; 

    // Gestion du nouvel Upload d'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../assets/img/';
        $file_name = basename($_FILES['image']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($file_ext, $allowed_ext)) {
            $unique_name = time() . '_' . rand(1000, 9999) . '.' . $file_ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $unique_name)) {
                $image_url = $unique_name;
                // Optionnel : supprimer l'ancienne image du serveur ici si besoin
            }
        }
    }

    if ($titre && $description) {
        // Ajout de image_url dans la requête UPDATE
        $stmt = $pdo->prepare("UPDATE formations SET titre=?, categorie=?, description=?, duree=?, prix=?, image_url=? WHERE id=?");
        $stmt->execute([$titre, $categorie, $description, $duree, $prix, $image_url, $id]);
        
        header('Location: admin_formations.php');
        exit();
    }
}
?>

<div class="admin-page-header">
    <div class="container">
        <h1>Modifier la <span style="color: var(--accent-orange);">Formation</span></h1>
        <p>Mise à jour du programme: <strong><?php echo htmlspecialchars($f['titre']); ?></strong></p>
    </div>
</div>

<main class="container admin-content">
    <div class="form-card">
        <div class="form-header text-center">
            <h2>Modifier la Formation</h2>
            <p class="text-gray">Mettez à jour les informations et l'image de couverture</p>
        </div>

        <form action="edit_formation.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="mt-4">
            
            <div class="form-group">
                <label><i class="fas fa-image"></i> Image de couverture actuelle</label>
                <div class="image-preview-container">
                    <div class="image-preview has-image" id="image-preview" 
                         style="background-image: url('../assets/img/<?php echo $f['image_url']; ?>');">
                        <div class="preview-content">
                            <i class="fas fa-cloud-upload-alt fa-2x" style="color: #CBD5E0;"></i>
                            <p>Cliquez pour changer l'image</p>
                        </div>
                        <button type="button" class="remove-image-btn" id="remove-image-btn" style="display:flex;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <input type="file" id="image-input" name="image" accept="image/*" style="display: none;">
                </div>
            </div>

            <div class="form-group">
                <label for="titre"><i class="fas fa-graduation-cap"></i> Titre de la Formation *</label>
                <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($f['titre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="categorie"><i class="fas fa-tag"></i> Catégorie</label>
                <input type="text" name="categorie" id="categorie" value="<?php echo htmlspecialchars($f['categorie']); ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="duree"><i class="far fa-clock"></i> Durée</label>
                    <input type="text" name="duree" id="duree" value="<?php echo htmlspecialchars($f['duree']); ?>">
                </div>
                <div class="form-group">
                    <label for="prix"><i class="fas fa-euro-sign"></i> Prix (MAD)</label>
                    <input type="number" step="0.01" name="prix" id="prix" value="<?php echo $f['prix']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="description"><i class="fas fa-align-left"></i> Description Détaillée *</label>
                <textarea name="description" id="description" required rows="5"><?php echo htmlspecialchars($f['description']); ?></textarea>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-admin btn-save" style="flex:2; justify-content:center;">
                    <i class="fas fa-check-circle"></i> Enregistrer les modifications
                </button>
                <a href="admin_formations.php" class="btn-admin btn-cancel" style="flex:1; justify-content:center;">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
</main>

<script>
    /**
     * JS pour gérer la prévisualisation interactive du changement d'image
     */
    const imagePreview = document.getElementById('image-preview');
    const imageInput = document.getElementById('image-input');
    const removeImageBtn = document.getElementById('remove-image-btn');

    // Déclenche le choix de fichier au clic sur la zone
    imagePreview.addEventListener('click', () => imageInput.click());

    // Affiche la nouvelle image dès qu'elle est choisie
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

    // Réinitialise l'image (attention: ici cela vide juste le champ d'upload)
    removeImageBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        imageInput.value = '';
        imagePreview.style.backgroundImage = "url('../assets/img/<?php echo $f['image_url']; ?>')";
    });
</script>

<?php include 'includes/footer.php'; ?>