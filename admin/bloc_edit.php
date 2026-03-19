<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? $t['admin_edit_block'] : $t['admin_add_block'];
include 'header.php';

$bloc = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM blocs_contenu WHERE id = ?");
    $stmt->execute([$id]);
    $bloc = $stmt->fetch();
    if (!$bloc) { header('Location: blocs_contenu.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type        = $_POST['type'];
    $titre       = $_POST['titre'];
    $titre_en    = $_POST['titre_en'] ?: null;
    $description = $_POST['description'];
    $description_en = $_POST['description_en'] ?: null;
    $icone       = $_POST['icone'];
    $lien        = $_POST['lien'] ?: null;
    $ordre       = (int)$_POST['ordre'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE blocs_contenu SET type=?, titre=?, titre_en=?, description=?, description_en=?, icone=?, lien=?, ordre=? WHERE id=?");
        $stmt->execute([$type, $titre, $titre_en, $description, $description_en, $icone, $lien, $ordre, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO blocs_contenu (type, titre, titre_en, description, description_en, icone, lien, ordre) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$type, $titre, $titre_en, $description, $description_en, $icone, $lien, $ordre]);
    }
    header('Location: blocs_contenu.php');
    exit;
}
?>

<h2><?php echo $pageTitle; ?></h2>

<form method="POST" class="admin-form">
    <div class="form-group">
        <label><?php echo $t['admin_type']; ?></label>
        <select name="type" class="form-control" required>
            <option value="valeur" <?php echo ($bloc['type'] ?? '') == 'valeur' ? 'selected' : ''; ?>><?php echo $t['admin_value']; ?></option>
            <option value="expertise" <?php echo ($bloc['type'] ?? '') == 'expertise' ? 'selected' : ''; ?>><?php echo $t['admin_expertise']; ?></option>
            <option value="credibilite" <?php echo ($bloc['type'] ?? '') == 'credibilite' ? 'selected' : ''; ?>><?php echo $t['admin_credibility']; ?></option>
            <option value="ressource" <?php echo ($bloc['type'] ?? '') == 'ressource' ? 'selected' : ''; ?>><?php echo $t['admin_resource']; ?></option>
        </select>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_title_fr']; ?></label>
            <input type="text" name="titre" class="form-control" value="<?php echo htmlspecialchars($bloc['titre'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_title_en']; ?></label>
            <input type="text" name="titre_en" class="form-control" value="<?php echo htmlspecialchars($bloc['titre_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_description_fr']; ?></label>
            <textarea name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($bloc['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_description_en']; ?></label>
            <textarea name="description_en" class="form-control" rows="4"><?php echo htmlspecialchars($bloc['description_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_icon']; ?></label>
        <input type="text" name="icone" class="form-control" value="<?php echo htmlspecialchars($bloc['icone'] ?? 'fa-star'); ?>" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_link']; ?></label>
        <input type="url" name="lien" class="form-control" value="<?php echo htmlspecialchars($bloc['lien'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_order']; ?></label>
        <input type="number" name="ordre" class="form-control" value="<?php echo $bloc['ordre'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_save']; ?></button>
        <a href="blocs_contenu.php" class="btn btn-secondary"><?php echo $t['admin_cancel']; ?></a>
    </div>
</form>

<?php include 'footer.php'; ?>