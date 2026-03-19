<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? $t['admin_edit_project'] : $t['admin_add_project'];
include 'header.php';

$realisation = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM realisations WHERE id = ?");
    $stmt->execute([$id]);
    $realisation = $stmt->fetch();
    if (!$realisation) { header('Location: realisations.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre        = $_POST['titre'];
    $titre_en     = $_POST['titre_en'] ?: null;
    $client       = $_POST['client'];
    $client_en    = $_POST['client_en'] ?: null;
    $annee        = $_POST['annee'];
    $categorie    = $_POST['categorie'];
    $defi         = $_POST['defi'];
    $defi_en      = $_POST['defi_en'] ?: null;
    $solution     = $_POST['solution'];
    $solution_en  = $_POST['solution_en'] ?: null;
    $technologies = $_POST['technologies'];
    $resultats    = $_POST['resultats'];
    $resultats_en = $_POST['resultats_en'] ?: null;
    $temoignage   = $_POST['temoignage'];
    $temoignage_en = $_POST['temoignage_en'] ?: null;
    $temoignage_auteur = $_POST['temoignage_auteur'];
    $temoignage_auteur_en = $_POST['temoignage_auteur_en'] ?: null;
    $drive_folder_id = $_POST['drive_folder_id'];
    $cover_image  = $_POST['cover_image'];
    $ordre        = (int)$_POST['ordre'];

    if ($id) {
        $sql = "UPDATE realisations SET titre=?, titre_en=?, client=?, client_en=?, annee=?, categorie=?, defi=?, defi_en=?, solution=?, solution_en=?, technologies=?, resultats=?, resultats_en=?, temoignage=?, temoignage_en=?, temoignage_auteur=?, temoignage_auteur_en=?, drive_folder_id=?, cover_image=?, ordre=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titre, $titre_en, $client, $client_en, $annee, $categorie, $defi, $defi_en, $solution, $solution_en, $technologies, $resultats, $resultats_en, $temoignage, $temoignage_en, $temoignage_auteur, $temoignage_auteur_en, $drive_folder_id, $cover_image, $ordre, $id]);
    } else {
        $sql = "INSERT INTO realisations (titre, titre_en, client, client_en, annee, categorie, defi, defi_en, solution, solution_en, technologies, resultats, resultats_en, temoignage, temoignage_en, temoignage_auteur, temoignage_auteur_en, drive_folder_id, cover_image, ordre) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titre, $titre_en, $client, $client_en, $annee, $categorie, $defi, $defi_en, $solution, $solution_en, $technologies, $resultats, $resultats_en, $temoignage, $temoignage_en, $temoignage_auteur, $temoignage_auteur_en, $drive_folder_id, $cover_image, $ordre]);
    }
    header('Location: realisations.php');
    exit;
}
?>

<h2><?php echo $pageTitle; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_title_fr']; ?></label>
            <input type="text" name="titre" class="form-control" value="<?php echo htmlspecialchars($realisation['titre'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_title_en']; ?></label>
            <input type="text" name="titre_en" class="form-control" value="<?php echo htmlspecialchars($realisation['titre_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_client_fr']; ?></label>
            <input type="text" name="client" class="form-control" value="<?php echo htmlspecialchars($realisation['client'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_client_en']; ?></label>
            <input type="text" name="client_en" class="form-control" value="<?php echo htmlspecialchars($realisation['client_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_year']; ?></label>
        <input type="number" name="annee" class="form-control" value="<?php echo $realisation['annee'] ?? date('Y'); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_category']; ?></label>
        <select name="categorie" class="form-control" required>
            <option value="web" <?php echo ($realisation['categorie'] ?? '') == 'web' ? 'selected' : ''; ?>>Web</option>
            <option value="mobile" <?php echo ($realisation['categorie'] ?? '') == 'mobile' ? 'selected' : ''; ?>>Mobile</option>
            <option value="design" <?php echo ($realisation['categorie'] ?? '') == 'design' ? 'selected' : ''; ?>>Design</option>
            <option value="supports" <?php echo ($realisation['categorie'] ?? '') == 'supports' ? 'selected' : ''; ?>>Supports</option>
            <option value="maquettes" <?php echo ($realisation['categorie'] ?? '') == 'maquettes' ? 'selected' : ''; ?>>Maquettes</option>
        </select>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_challenge_fr']; ?></label>
            <textarea name="defi" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['defi'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_challenge_en']; ?></label>
            <textarea name="defi_en" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['defi_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_solution_fr']; ?></label>
            <textarea name="solution" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['solution'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_solution_en']; ?></label>
            <textarea name="solution_en" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['solution_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_technologies']; ?></label>
        <input type="text" name="technologies" class="form-control" value="<?php echo htmlspecialchars($realisation['technologies'] ?? ''); ?>">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_results_fr']; ?></label>
            <textarea name="resultats" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['resultats'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_results_en']; ?></label>
            <textarea name="resultats_en" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['resultats_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_testimonial_fr']; ?></label>
            <textarea name="temoignage" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['temoignage'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_testimonial_en']; ?></label>
            <textarea name="temoignage_en" class="form-control" rows="4"><?php echo htmlspecialchars($realisation['temoignage_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_testimonial_author_fr']; ?></label>
            <input type="text" name="temoignage_auteur" class="form-control" value="<?php echo htmlspecialchars($realisation['temoignage_auteur'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_testimonial_author_en']; ?></label>
            <input type="text" name="temoignage_auteur_en" class="form-control" value="<?php echo htmlspecialchars($realisation['temoignage_auteur_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_drive_folder_id']; ?></label>
        <input type="text" name="drive_folder_id" class="form-control" value="<?php echo htmlspecialchars($realisation['drive_folder_id'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_cover_image']; ?></label>
        <input type="text" name="cover_image" class="form-control" value="<?php echo htmlspecialchars($realisation['cover_image'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_order']; ?></label>
        <input type="number" name="ordre" class="form-control" value="<?php echo $realisation['ordre'] ?? 0; ?>">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_save']; ?></button>
        <a href="realisations.php" class="btn btn-secondary"><?php echo $t['admin_cancel']; ?></a>
    </div>
</form>

<?php include 'footer.php'; ?>