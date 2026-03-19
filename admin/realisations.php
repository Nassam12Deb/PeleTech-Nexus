<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_realisations'];
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM realisations WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: realisations.php?msg=deleted');
    exit;
}

$realisations = $pdo->query("SELECT * FROM realisations ORDER BY ordre")->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2><?php echo $t['admin_realisations']; ?></h2>
    <a href="realisation_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo $t['admin_new_project']; ?></a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success"><?php echo $t['admin_project_deleted']; ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><?php echo $t['admin_title']; ?></th>
                <th><?php echo $t['admin_client']; ?></th>
                <th><?php echo $t['admin_year']; ?></th>
                <th><?php echo $t['admin_category']; ?></th>
                <th><?php echo $t['admin_order']; ?></th>
                <th><?php echo $t['admin_actions']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($realisations as $r): ?>
            <tr>
                <td><?php echo htmlspecialchars($r['titre'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($r['client'] ?? ''); ?></td>
                <td><?php echo $r['annee'] ?? ''; ?></td>
                <td><?php echo htmlspecialchars($r['categorie'] ?? ''); ?></td>
                <td><?php echo $r['ordre'] ?? ''; ?></td>
                <td>
                    <a href="realisation_edit.php?id=<?php echo $r['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> <?php echo $t['admin_edit']; ?></a>
                    <a href="?delete=<?php echo $r['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> <?php echo $t['admin_delete']; ?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>