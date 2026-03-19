<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? $t['admin_edit_technology'] : $t['admin_add_technology'];
include 'header.php';

$techno = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM technologies WHERE id = ?");
    $stmt->execute([$id]);
    $techno = $stmt->fetch();
    if (!$techno) { header('Location: technologies.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom      = $_POST['nom'];
    $nom_en   = $_POST['nom_en'] ?: null;
    $categorie = $_POST['categorie'];
    $ordre    = (int)$_POST['ordre'];

    if ($id) {
        $stmt = $pdo->prepare("UPDATE technologies SET nom=?, nom_en=?, categorie=?, ordre=? WHERE id=?");
        $stmt->execute([$nom, $nom_en, $categorie, $ordre, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO technologies (nom, nom_en, categorie, ordre) VALUES (?,?,?,?)");
        $stmt->execute([$nom, $nom_en, $categorie, $ordre]);
    }
    header('Location: technologies.php');
    exit;
}
?>

<h2><?php echo $pageTitle; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_name_fr']; ?></label>
            <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($techno['nom'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_name_en']; ?></label>
            <input type="text" name="nom_en" class="form-control" value="<?php echo htmlspecialchars($techno['nom_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_category']; ?></label>
        <select name="categorie" class="form-control" required>
            <option value="frontend" <?php echo ($techno['categorie'] ?? '') == 'frontend' ? 'selected' : ''; ?>><?php echo $t['admin_frontend']; ?></option>
            <option value="design" <?php echo ($techno['categorie'] ?? '') == 'design' ? 'selected' : ''; ?>><?php echo $t['admin_design']; ?></option>
            <option value="mobile" <?php echo ($techno['categorie'] ?? '') == 'mobile' ? 'selected' : ''; ?>><?php echo $t['admin_mobile']; ?></option>
            <option value="outils" <?php echo ($techno['categorie'] ?? '') == 'outils' ? 'selected' : ''; ?>><?php echo $t['admin_tools']; ?></option>
        </select>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_order']; ?></label>
        <input type="number" name="ordre" class="form-control" value="<?php echo $techno['ordre'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_save']; ?></button>
        <a href="technologies.php" class="btn btn-secondary"><?php echo $t['admin_cancel']; ?></a>
    </div>
</form>

<?php include 'footer.php'; ?>