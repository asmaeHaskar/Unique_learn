<?php
// admin/admin_formations.php
require_once 'includes/header.php';
require_once '../includes/connexion.php';

// Récupération de la catégorie pour le filtrage
$selected_cat = $_GET['cat'] ?? '';

// Récupérer les catégories uniques
$cat_stmt = $pdo->query("SELECT DISTINCT categorie FROM formations WHERE categorie != '' ORDER BY categorie ASC");
$categories = $cat_stmt->fetchAll(PDO::FETCH_COLUMN);

// Construction de la requête SQL
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
<div class="admin-page-header">
    <div class="container">
        <h1 style="font-family: var(--font-display); font-size: 3.5rem; color: white; margin-top: 1rem;">Liste des <span style="color: var(--accent-orange);">Formations</span></h1>
        <p style="opacity: 0.8; font-size: 1.1rem; margin-top: 1rem;">Gérez votre catalogue de programmes et leurs tarifs.</p>
    </div>
</div>

<main id="admin-content" class="container" style="margin-top: -4rem; padding-bottom: 5rem; position: relative; z-index: 10;">
    
   <div style="background: #ffffff; padding: 1rem 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; position: relative; z-index: 10;">
    
    <form action="admin_formations.php" method="GET" style="display: flex; gap: 1rem; align-items: center;">
        <label style="font-weight: 800; color: #002347; font-size: 0.9rem;">Catégorie :</label>
        
        <select name="cat" style="width: auto; min-width: 220px; padding: 0.7rem; border-radius: 8px; border: 1px solid #e2e8f0; background-color: #f8fafc; font-family: 'Poppins', sans-serif;">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $selected_cat === $cat ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($cat); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-filtrer-custom" style="padding: 0.7rem 1.8rem; background: #FF8C00; border: none; border-radius: 8px; color: white; cursor: pointer; font-weight: 700; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(255, 140, 0, 0.2);">
            Filtrer
        </button>

        <?php if ($selected_cat): ?>
            <a href="admin_formations.php" style="color: #64748b; font-size: 0.85rem; text-decoration: none; font-weight: 500; margin-left: 5px;">
                Reset
            </a>
        <?php endif; ?>
    </form>

    <a href="add_formation.php" class="btn-new-custom" style="background: #001F3F; color: white; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 31, 63, 0.2);">
        <i class="fas fa-plus"></i> Nouvelle Formation
    </a>
</div>

    <div class="table-container" style="background: white; border-radius: 12px; box-shadow: var(--shadow-sm); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #edf2f7;">
                    <th style="padding: 1.2rem; text-align: left; color: var(--primary-blue);">Aperçu</th>
                    <th style="padding: 1.2rem; text-align: left; color: var(--primary-blue);">Formation</th>
                    <th style="padding: 1.2rem; text-align: left; color: var(--primary-blue);">Catégorie</th>
                    <th style="padding: 1.2rem; text-align: left; color: var(--primary-blue);">Prix</th>
                    <th style="padding: 1.2rem; text-align: center; color: var(--primary-blue);">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($formations)): ?>
                    <tr><td colspan="5" style="text-align: center; padding: 4rem; color: var(--text-gray);">Aucune formation trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($formations as $f): ?>
                        <tr style="border-bottom: 1px solid #edf2f7;">
                            <td style="padding: 1.2rem;">
                                <img src="../assets/img/<?php echo $f['image_url']; ?>" style="width: 80px; height: 50px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td style="padding: 1.2rem;">
                                <div style="font-weight: 700; color: var(--primary-blue);"><?php echo htmlspecialchars($f['titre']); ?></div>
<div style="font-size: 0.8rem; color: #94a3b8;">
                                        ID: #UL-<?php echo str_pad($f['id'], 3, '0', STR_PAD_LEFT); ?>
                                    </div>                            </td>
                            <td style="padding: 1.2rem;">
                               <span class="badge" style=" display: inline-block;padding: 0.4rem 1rem;border-radius: 8px;font-size: 0.8rem;font-weight: 700;background: #e0f2fe;color: #0369a1;">
                                        <?php echo htmlspecialchars($f['categorie'] ?: 'Non catégorisé'); ?>
                                    </span>
                            </td>
                            <td style="padding: 1.2rem;">
                                <div style="font-size: 0.9rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">
                                        <i class="far fa-clock" style="color: var(--accent-orange); margin-right: 0.5rem;"></i>
                                        <?php echo htmlspecialchars($f['duree']); ?>
                                </div>
                                <div style="font-weight: 700; color: var(--accent-orange);"><?php echo number_format($f['prix'], 2); ?> MAD</div>
                            </td>
                            <td style="padding: 1.2rem; text-align: center;">
                                <div style="display: flex; gap: 0.8rem; justify-content: center;">
                                        <a href="edit_formation.php?id=<?php echo $f['id']; ?>"
                                           class="action-btn"
                                           style="background: #f0f9ff; color: #0369a1;"
                                           title="Modifier">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="delete_formation.php?id=<?php echo $f['id']; ?>"
                                           class="action-btn"
                                           style="background: #fff1f2; color: #e11d48;"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');"
                                           title="Supprimer">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

