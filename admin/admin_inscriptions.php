<?php
// admin/admin_inscriptions.php
include 'includes/header.php';
require_once '../includes/connexion.php';

// INITIALISATION : Correction de l'erreur "Undefined variable"
$filter_id = filter_input(INPUT_GET, 'formation_filter', FILTER_VALIDATE_INT) ?: null;

/**
 * RÉCUPÉRATION DES INSCRIPTIONS
 */
$query = "SELECT i.*, f.titre as formation_titre 
          FROM inscriptions i 
          JOIN formations f ON i.id_formation = f.id";
$params = [];

if ($filter_id) {
    $query .= " WHERE i.id_formation = ?";
    $params[] = $filter_id;
}

$query .= " ORDER BY i.date_inscription DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$inscriptions = $stmt->fetchAll();

// Liste des formations pour le menu déroulant
$formations_stmt = $pdo->query("SELECT id, titre FROM formations ORDER BY titre ASC");
$list_formations = $formations_stmt->fetchAll();
?>

<div class="admin-page-header">
    <div class="container">
        <h1>Liste des <span style="color: var(--accent-orange);">Inscriptions</span></h1>
        <p>Analysez et gérez les demandes d'admission en temps réel.</p>
    </div>
</div>

<main id="admin-content" class="container admin-content">
    
    <div style="background: var(--white); padding: 1.5rem 2.5rem; border-radius: 10px; margin-bottom: 2rem; box-shadow: var(--shadow-heavy); display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 10;">
        
        <form action="admin_inscriptions.php#admin-content" method="GET" style="display: flex; gap: 1.5rem; align-items: center; flex: 1;">
            <label style="font-weight: 800; color: var(--primary-blue); font-size: 0.95rem; white-space: nowrap;">
                Filtrer par Formation :
            </label>
            
            <select name="formation_filter" style="width: auto; min-width: 250px; padding: 0.8rem 1.2rem; border-radius: 12px; border: 1px solid #E2E8F0; background: #F8FAFC; font-family: var(--font-primary);">
                <option value="">Tous les programmes</option>
                <?php foreach ($list_formations as $lf): ?>
                    <option value="<?php echo $lf['id']; ?>" <?php echo ($filter_id == $lf['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($lf['titre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn-admin btn-filter" style="border-radius: 20px; padding: 0.8rem 2.5rem;">
                Appliquer
            </button>

            <?php if ($filter_id): ?>
                <a href="admin_inscriptions.php" style="color: var(--text-gray); font-size: 0.9rem; font-weight: 600; text-decoration: none; margin-left: 10px;">
                    Réinitialiser
                </a>
            <?php endif; ?>
        </form>

        <div style="background: #F8FAFC; color: var(--primary-blue); padding: 0.7rem 1.5rem; border-radius: 12px; font-weight: 300; font-size: 0.9rem; border: 1px solid #E2E8F0; white-space: nowrap;">
            <i class="fas fa-user-check" style="color: var(--accent-orange); margin-right: 3px;"></i>
            <?php echo count($inscriptions); ?> Candidat(s)
        </div>
    </div>

    <div class="admin-table-container">
        <table>
            <thead>
                <tr>
                    <th>NOM & PRÉNOM</th>
                    <th>CONTACT</th>
                    <th>FORMATION CHOISIE</th>
                    <th>DATE D'INSCRIPTION</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($inscriptions)): ?>
                    <tr><td colspan="4" style="text-align: center; padding: 4rem;">Aucune inscription trouvée.</td></tr>
                <?php else: ?>
                    <?php foreach ($inscriptions as $i): ?>
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: var(--primary-blue);"><?php echo htmlspecialchars($i['nom'] . ' ' . $i['prenom']); ?></div>
                            </td>
                            <td>
                                <div style="font-size: 0.95rem; font-weight: 500;"><?php echo htmlspecialchars($i['email']); ?></div>
                                <div style="font-size: 0.85rem; color: var(--text-gray);"><i class="fas fa-phone" style="color: var(--accent-orange); margin-right: 5px;"></i><?php echo htmlspecialchars($i['tel']); ?></div>
                            </td>
                            <td>
                                <span class="badge-formation"><?php echo htmlspecialchars($i['formation_titre']); ?></span>
                            </td>
                            <td>
                                <div style="font-weight: 600; font-size: 0.9rem;"><?php echo date('d/m/Y', strtotime($i['date_inscription'])); ?></div>
                                <div style="font-size: 0.8rem; color: var(--text-gray);"><?php echo date('H:i', strtotime($i['date_inscription'])); ?></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

