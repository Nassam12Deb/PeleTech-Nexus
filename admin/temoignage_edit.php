<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? "Modifier un témoignage" : "Ajouter un témoignage";
include 'header.php';

$temoignage = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM temoignages WHERE id = ?");
    $stmt->execute([$id]);
    $temoignage = $stmt->fetch();
    if (!$temoignage) { header('Location: temoignages.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auteur       = $_POST['auteur'];
    $auteur_en    = $_POST['auteur_en'] ?: null;
    $fonction     = $_POST['fonction'];
    $fonction_en  = $_POST['fonction_en'] ?: null;
    $texte        = $_POST['texte'];
    $texte_en     = $_POST['texte_en'] ?: null;
    $note         = (int)$_POST['note'];
    $ordre        = (int)$_POST['ordre'];
    $statut       = $_POST['statut'] ?? 'en_attente';

    // Gestion upload photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../assets/img/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photo = 'assets/img/uploads/' . $fileName;
        } else {
            $photo = $temoignage['photo'] ?? '';
        }
    } else {
        $photo = $temoignage['photo'] ?? '';
    }

    if ($id) {
        $sql = "UPDATE temoignages SET auteur=?, auteur_en=?, fonction=?, fonction_en=?, photo=?, texte=?, texte_en=?, note=?, ordre=?, statut=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$auteur, $auteur_en, $fonction, $fonction_en, $photo, $texte, $texte_en, $note, $ordre, $statut, $id]);
    } else {
        $sql = "INSERT INTO temoignages (auteur, auteur_en, fonction, fonction_en, photo, texte, texte_en, note, ordre, statut) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$auteur, $auteur_en, $fonction, $fonction_en, $photo, $texte, $texte_en, $note, $ordre, $statut]);
    }
    header('Location: temoignages.php');
    exit;
}
?>

<h2><?php echo $id ? 'Modifier le témoignage' : 'Ajouter un témoignage'; ?></h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Auteur (FR)</label>
            <input type="text" name="auteur" class="form-control" value="<?php echo htmlspecialchars($temoignage['auteur'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label>Auteur (EN)</label>
            <input type="text" name="auteur_en" class="form-control" value="<?php echo htmlspecialchars($temoignage['auteur_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Fonction (FR)</label>
            <input type="text" name="fonction" class="form-control" value="<?php echo htmlspecialchars($temoignage['fonction'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label>Fonction (EN)</label>
            <input type="text" name="fonction_en" class="form-control" value="<?php echo htmlspecialchars($temoignage['fonction_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Photo (optionnelle)</label>
        <?php if (!empty($temoignage['photo'])): ?>
            <div style="margin-bottom:10px;">
                <img src="<?php echo BASE_URL . $temoignage['photo']; ?>" alt="Photo" style="max-width:100px; border-radius:50%;">
            </div>
        <?php endif; ?>
        <input type="file" name="photo" accept="image/*" class="form-control">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label>Texte (FR)</label>
            <textarea name="texte" class="form-control" rows="4" required><?php echo htmlspecialchars($temoignage['texte'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label>Texte (EN)</label>
            <textarea name="texte_en" class="form-control" rows="4"><?php echo htmlspecialchars($temoignage['texte_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label>Note (sur 5)</label>
        <input type="number" name="note" min="1" max="5" class="form-control" value="<?php echo $temoignage['note'] ?? 5; ?>">
    </div>
    <div class="form-group">
        <label>Ordre d'affichage</label>
        <input type="number" name="ordre" class="form-control" value="<?php echo $temoignage['ordre'] ?? 0; ?>">
    </div>
    <div class="form-group">
        <label>Statut</label>
        <select name="statut" class="form-control">
            <option value="en_attente" <?php echo ($temoignage['statut'] ?? '') == 'en_attente' ? 'selected' : ''; ?>>En attente</option>
            <option value="publie" <?php echo ($temoignage['statut'] ?? '') == 'publie' ? 'selected' : ''; ?>>Publié</option>
            <option value="rejete" <?php echo ($temoignage['statut'] ?? '') == 'rejete' ? 'selected' : ''; ?>>Rejeté</option>
        </select>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="temoignages.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<?php include 'footer.php'; ?>