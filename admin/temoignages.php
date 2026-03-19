<?php
$pageTitle = "Gestion des témoignages";
include 'header.php';

// Traitement des actions de modération
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $action = $_GET['action'];
    if (in_array($action, ['approuver', 'rejeter', 'delete'])) {
        if ($action == 'delete') {
            $stmt = $pdo->prepare("DELETE FROM temoignages WHERE id = ?");
            $stmt->execute([$id]);
            $msg = "Témoignage supprimé.";
        } else {
            $statut = ($action == 'approuver') ? 'publie' : 'rejete';
            $stmt = $pdo->prepare("UPDATE temoignages SET statut = ? WHERE id = ?");
            $stmt->execute([$statut, $id]);
            $msg = ($action == 'approuver') ? "Témoignage approuvé." : "Témoignage rejeté.";
        }
        header('Location: temoignages.php?msg=' . urlencode($msg));
        exit;
    }
}

// Affichage du message
if (isset($_GET['msg'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_GET['msg']) . '</div>';
}

// Filtre par statut avec liste blanche
$statut_filter = $_GET['statut'] ?? 'tous';
$allowed = ['tous', 'en_attente', 'publie', 'rejete'];
if (!in_array($statut_filter, $allowed)) {
    $statut_filter = 'tous';
}

if ($statut_filter != 'tous') {
    $stmt = $pdo->prepare("SELECT * FROM temoignages WHERE statut = ? ORDER BY CASE statut WHEN 'en_attente' THEN 0 ELSE 1 END, ordre");
    $stmt->execute([$statut_filter]);
    $temoignages = $stmt->fetchAll();
} else {
    $temoignages = $pdo->query("SELECT * FROM temoignages ORDER BY CASE statut WHEN 'en_attente' THEN 0 ELSE 1 END, ordre")->fetchAll();
}
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Témoignages</h2>
    <a href="temoignage_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> Nouveau témoignage</a>
</div>

<div style="margin-bottom:20px;">
    <a href="?statut=tous" class="btn btn-small <?php echo $statut_filter == 'tous' ? 'btn-primary' : 'btn-secondary'; ?>">Tous</a>
    <a href="?statut=en_attente" class="btn btn-small <?php echo $statut_filter == 'en_attente' ? 'btn-primary' : 'btn-secondary'; ?>">En attente</a>
    <a href="?statut=publie" class="btn btn-small <?php echo $statut_filter == 'publie' ? 'btn-primary' : 'btn-secondary'; ?>">Publiés</a>
    <a href="?statut=rejete" class="btn btn-small <?php echo $statut_filter == 'rejete' ? 'btn-primary' : 'btn-secondary'; ?>">Rejetés</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Fonction</th>
                <th>Note</th>
                <th>Statut</th>
                <th>Ordre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($temoignages as $t): ?>
            <tr>
                <td><?php echo htmlspecialchars($t['auteur']); ?></td>
                <td><?php echo htmlspecialchars($t['fonction']); ?></td>
                <td><?php echo $t['note']; ?>/5</td>
                <td>
                    <?php
                    $badge = '';
                    if ($t['statut'] == 'en_attente') $badge = 'badge-warning';
                    elseif ($t['statut'] == 'publie') $badge = 'badge-success';
                    else $badge = 'badge-danger';
                    ?>
                    <span class="badge <?php echo $badge; ?>"><?php echo $t['statut']; ?></span>
                </td>
                <td><?php echo $t['ordre']; ?></td>
                <td>
                    <a href="temoignage_edit.php?id=<?php echo $t['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> Modifier</a>
                    <?php if ($t['statut'] == 'en_attente'): ?>
                        <a href="?action=approuver&id=<?php echo $t['id']; ?>" class="btn btn-small btn-success" onclick="return confirm('Approuver ce témoignage ?');"><i class="fas fa-check"></i> Approuver</a>
                        <a href="?action=rejeter&id=<?php echo $t['id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Rejeter ce témoignage ?');"><i class="fas fa-times"></i> Rejeter</a>
                    <?php endif; ?>
                    <a href="?action=delete&id=<?php echo $t['id']; ?>" class="btn btn-small btn-secondary delete-link" onclick="return confirm('Supprimer ce témoignage ?');"><i class="fas fa-trash"></i> Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>