<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? $t['admin_edit_step'] : $t['admin_add_step'];
include 'header.php';

$etape = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM etapes_processus WHERE id = ?");
    $stmt->execute([$id]);
    $etape = $stmt->fetch();
    if (!$etape) { header('Location: etapes_processus.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre        = $_POST['titre'];
    $titre_en     = $_POST['titre_en'] ?: null;
    $description  = $_POST['description'];
    $description_en = $_POST['description_en'] ?: null;
    $livrables    = $_POST['livrables'];
    $livrables_en = $_POST['livrables_en'] ?: null;
    $duree_estimee = $_POST['duree_estimee'];
    $duree_estimee_en = $_POST['duree_estimee_en'] ?: null;
    $icone        = $_POST['icone'];
    $ordre        = (int)$_POST['ordre'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE etapes_processus SET titre=?, titre_en=?, description=?, description_en=?, livrables=?, livrables_en=?, duree_estimee=?, duree_estimee_en=?, icone=?, ordre=? WHERE id=?");
        $stmt->execute([$titre, $titre_en, $description, $description_en, $livrables, $livrables_en, $duree_estimee, $duree_estimee_en, $icone, $ordre, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO etapes_processus (titre, titre_en, description, description_en, livrables, livrables_en, duree_estimee, duree_estimee_en, icone, ordre) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([$titre, $titre_en, $description, $description_en, $livrables, $livrables_en, $duree_estimee, $duree_estimee_en, $icone, $ordre]);
    }
    header('Location: etapes_processus.php');
    exit;
}
?>

<h2><?php echo $pageTitle; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_title_fr']; ?></label>
            <input type="text" name="titre" class="form-control" value="<?php echo htmlspecialchars($etape['titre'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_title_en']; ?></label>
            <input type="text" name="titre_en" class="form-control" value="<?php echo htmlspecialchars($etape['titre_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_description_fr']; ?></label>
            <textarea name="description" class="form-control" rows="5" required><?php echo htmlspecialchars($etape['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_description_en']; ?></label>
            <textarea name="description_en" class="form-control" rows="5"><?php echo htmlspecialchars($etape['description_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_deliverables_fr']; ?></label>
            <textarea name="livrables" class="form-control" rows="3"><?php echo htmlspecialchars($etape['livrables'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_deliverables_en']; ?></label>
            <textarea name="livrables_en" class="form-control" rows="3"><?php echo htmlspecialchars($etape['livrables_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_duration_fr']; ?></label>
            <input type="text" name="duree_estimee" class="form-control" value="<?php echo htmlspecialchars($etape['duree_estimee'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_duration_en']; ?></label>
            <input type="text" name="duree_estimee_en" class="form-control" value="<?php echo htmlspecialchars($etape['duree_estimee_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_icon']; ?></label>
        <input type="text" name="icone" class="form-control" value="<?php echo htmlspecialchars($etape['icone'] ?? 'fa-search'); ?>" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_order']; ?></label>
        <input type="number" name="ordre" class="form-control" value="<?php echo $etape['ordre'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_save']; ?></button>
        <a href="etapes_processus.php" class="btn btn-secondary"><?php echo $t['admin_cancel']; ?></a>
    </div>
</form>

<?php include 'footer.php'; ?>