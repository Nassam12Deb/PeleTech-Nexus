<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? $t['admin_edit_service'] : $t['admin_add_service'];
include 'header.php';

$service = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch();
    if (!$service) { header('Location: services.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre      = $_POST['titre'];
    $titre_en   = $_POST['titre_en'] ?: null;
    $description = $_POST['description'];
    $description_en = $_POST['description_en'] ?: null;
    $icone      = $_POST['icone'];
    $categorie  = $_POST['categorie'];
    $ordre      = (int)$_POST['ordre'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE services SET titre=?, titre_en=?, description=?, description_en=?, icone=?, categorie=?, ordre=? WHERE id=?");
        $stmt->execute([$titre, $titre_en, $description, $description_en, $icone, $categorie, $ordre, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO services (titre, titre_en, description, description_en, icone, categorie, ordre) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$titre, $titre_en, $description, $description_en, $icone, $categorie, $ordre]);
    }
    header('Location: services.php');
    exit;
}
?>

<h2><?php echo $pageTitle; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_title_fr']; ?></label>
            <input type="text" name="titre" class="form-control" value="<?php echo htmlspecialchars($service['titre'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_title_en']; ?></label>
            <input type="text" name="titre_en" class="form-control" value="<?php echo htmlspecialchars($service['titre_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_description_fr']; ?></label>
            <textarea name="description" class="form-control" rows="5" required><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_description_en']; ?></label>
            <textarea name="description_en" class="form-control" rows="5"><?php echo htmlspecialchars($service['description_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_icon']; ?></label>
        <input type="text" name="icone" class="form-control" value="<?php echo htmlspecialchars($service['icone'] ?? 'fa-globe'); ?>" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_category']; ?></label>
        <select name="categorie" class="form-control" required>
            <option value="web" <?php echo ($service['categorie'] ?? '') == 'web' ? 'selected' : ''; ?>>Web</option>
            <option value="design" <?php echo ($service['categorie'] ?? '') == 'design' ? 'selected' : ''; ?>>Design</option>
            <option value="mobile" <?php echo ($service['categorie'] ?? '') == 'mobile' ? 'selected' : ''; ?>>Mobile</option>
            <option value="supports" <?php echo ($service['categorie'] ?? '') == 'supports' ? 'selected' : ''; ?>>Supports</option>
        </select>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_order']; ?></label>
        <input type="number" name="ordre" class="form-control" value="<?php echo $service['ordre'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_save']; ?></button>
        <a href="services.php" class="btn btn-secondary"><?php echo $t['admin_cancel']; ?></a>
    </div>
</form>

<?php include 'footer.php'; ?>