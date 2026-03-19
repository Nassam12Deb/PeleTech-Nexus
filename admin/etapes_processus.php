<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_process_steps'];
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM etapes_processus WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: etapes_processus.php?msg=deleted');
    exit;
}

$etapes = $pdo->query("SELECT * FROM etapes_processus ORDER BY ordre")->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2><?php echo $t['admin_process_steps']; ?></h2>
    <a href="etape_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo $t['admin_new_step']; ?></a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success"><?php echo $t['admin_step_deleted']; ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><?php echo $t['admin_title']; ?></th>
                <th><?php echo $t['admin_duration']; ?></th>
                <th><?php echo $t['admin_icon']; ?></th>
                <th><?php echo $t['admin_order']; ?></th>
                <th><?php echo $t['admin_actions']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etapes as $e): ?>
            <tr>
                <td><?php echo htmlspecialchars($e['titre'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($e['duree_estimee'] ?? ''); ?></td>
                <td><i class="fas <?php echo htmlspecialchars($e['icone'] ?? ''); ?>"></i></td>
                <td><?php echo $e['ordre'] ?? ''; ?></td>
                <td>
                    <a href="etape_edit.php?id=<?php echo $e['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> <?php echo $t['admin_edit']; ?></a>
                    <a href="?delete=<?php echo $e['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> <?php echo $t['admin_delete']; ?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>