<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_change_password'];
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $error = $t['admin_password_mismatch'];
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['admin_id']]);
        $user = $stmt->fetch();

        if ($user && password_verify($current, $user['password'])) {
            $hash = password_hash($new, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->execute([$hash, $_SESSION['admin_id']]);
            $success = $t['admin_password_changed'];
        } else {
            $error = $t['admin_current_password_incorrect'];
        }
    }
}
?>

<h2><?php echo $t['admin_change_password']; ?></h2>

<?php if (isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>
<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<form method="POST" class="admin-form" style="max-width: 500px;">
    <div class="form-group">
        <label><?php echo $t['admin_current_password']; ?></label>
        <input type="password" name="current_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_new_password']; ?></label>
        <input type="password" name="new_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_confirm_password']; ?></label>
        <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_change_password']; ?></button>
    </div>
</form>

<?php include 'footer.php'; ?>