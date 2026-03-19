<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_content_blocks'];
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM blocs_contenu WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: blocs_contenu.php?msg=deleted');
    exit;
}

$typeFiltre = $_GET['type'] ?? '';
if ($typeFiltre) {
    $stmt = $pdo->prepare("SELECT * FROM blocs_contenu WHERE type = ? ORDER BY ordre");
    $stmt->execute([$typeFiltre]);
    $blocs = $stmt->fetchAll();
} else {
    $blocs = $pdo->query("SELECT * FROM blocs_contenu ORDER BY type, ordre")->fetchAll();
}
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2><?php echo $t['admin_content_blocks']; ?></h2>
    <div>
        <a href="?type=valeur" class="btn btn-small btn-secondary"><?php echo $t['admin_values']; ?></a>
        <a href="?type=expertise" class="btn btn-small btn-secondary"><?php echo $t['admin_expertises']; ?></a>
        <a href="?type=credibilite" class="btn btn-small btn-secondary"><?php echo $t['admin_credibilities']; ?></a>
        <a href="?type=ressource" class="btn btn-small btn-secondary"><?php echo $t['admin_resources']; ?></a>
        <a href="blocs_contenu.php" class="btn btn-small btn-secondary"><?php echo $t['admin_all']; ?></a>
        <a href="bloc_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo $t['admin_new_block']; ?></a>
    </div>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success"><?php echo $t['admin_block_deleted']; ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><?php echo $t['admin_type']; ?></th>
                <th><?php echo $t['admin_title']; ?></th>
                <th><?php echo $t['admin_icon']; ?></th>
                <th><?php echo $t['admin_link']; ?></th>
                <th><?php echo $t['admin_order']; ?></th>
                <th><?php echo $t['admin_actions']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blocs as $b): ?>
            <tr>
                <td><?php echo $b['type']; ?></td>
                <td><?php echo htmlspecialchars($b['titre'] ?? ''); ?></td>
                <td><i class="fas <?php echo htmlspecialchars($b['icone'] ?? ''); ?>"></i></td>
                <td><?php echo htmlspecialchars($b['lien'] ?? ''); ?></td>
                <td><?php echo $b['ordre'] ?? ''; ?></td>
                <td>
                    <a href="bloc_edit.php?id=<?php echo $b['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> <?php echo $t['admin_edit']; ?></a>
                    <a href="?delete=<?php echo $b['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> <?php echo $t['admin_delete']; ?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>