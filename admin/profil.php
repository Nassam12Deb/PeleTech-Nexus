<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_edit_profile'];
include 'header.php';

$profil = $pdo->query("SELECT * FROM profil WHERE id = 1")->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_marque  = $_POST['nom_marque'];
    $fondatrice  = $_POST['fondatrice'];
    $slogan      = $_POST['slogan'];
    $slogan_en   = $_POST['slogan_en'] ?: null;
    $description = $_POST['description'];
    $description_en = $_POST['description_en'] ?: null;
    $email_contact = $_POST['email_contact'];
    $telephone   = $_POST['telephone'];
    $adresse     = $_POST['adresse'];

    // Gestion upload photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../assets/img/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = uniqid() . '_' . basename($_FILES['photo']['name']);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photo = 'assets/img/uploads/' . $fileName;
        } else {
            $photo = $profil['photo'];
        }
    } else {
        $photo = $profil['photo'] ?? '';
    }

    $sql = "UPDATE profil SET nom_marque=?, fondatrice=?, slogan=?, slogan_en=?, description=?, description_en=?, email_contact=?, telephone=?, adresse=?, photo=? WHERE id=1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom_marque, $fondatrice, $slogan, $slogan_en, $description, $description_en, $email_contact, $telephone, $adresse, $photo]);

    header('Location: profil.php?success=1');
    exit;
}
?>

<h2><?php echo $t['admin_edit_profile']; ?></h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success"><?php echo $t['admin_profile_updated']; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form" style="max-width: 900px;">
    <div class="form-group">
        <label><?php echo $t['admin_brand_name']; ?></label>
        <input type="text" name="nom_marque" class="form-control" value="<?php echo htmlspecialchars($profil['nom_marque']); ?>" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_founder']; ?></label>
        <input type="text" name="fondatrice" class="form-control" value="<?php echo htmlspecialchars($profil['fondatrice']); ?>" required>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_slogan_fr']; ?></label>
            <input type="text" name="slogan" class="form-control" value="<?php echo htmlspecialchars($profil['slogan']); ?>">
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_slogan_en']; ?></label>
            <input type="text" name="slogan_en" class="form-control" value="<?php echo htmlspecialchars($profil['slogan_en'] ?? ''); ?>">
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_description_fr']; ?></label>
            <textarea name="description" class="form-control" rows="6"><?php echo htmlspecialchars($profil['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_description_en']; ?></label>
            <textarea name="description_en" class="form-control" rows="6"><?php echo htmlspecialchars($profil['description_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_contact_email']; ?></label>
        <input type="email" name="email_contact" class="form-control" value="<?php echo htmlspecialchars($profil['email_contact']); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_phone']; ?></label>
        <input type="text" name="telephone" class="form-control" value="<?php echo htmlspecialchars($profil['telephone']); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_address']; ?></label>
        <input type="text" name="adresse" class="form-control" value="<?php echo htmlspecialchars($profil['adresse']); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_profile_photo']; ?></label>
        <?php if (!empty($profil['photo'])): ?>
            <div style="margin-bottom:10px;">
                <img src="<?php echo BASE_URL . $profil['photo']; ?>" alt="Photo" style="max-width:150px; border-radius:10px;">
            </div>
        <?php endif; ?>
        <input type="file" name="photo" accept="image/*" class="form-control">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_update']; ?></button>
    </div>
</form>

<?php include 'footer.php'; ?>