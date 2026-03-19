<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_technologies'];
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM technologies WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: technologies.php?msg=deleted');
    exit;
}

$technologies = $pdo->query("SELECT * FROM technologies ORDER BY categorie, ordre")->fetchAll();
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2><?php echo $t['admin_technologies']; ?></h2>
    <a href="technologie_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo $t['admin_new_technology']; ?></a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success"><?php echo $t['admin_technology_deleted']; ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><?php echo $t['admin_name_fr']; ?></th>
                <th><?php echo $t['admin_name_en']; ?></th>
                <th><?php echo $t['admin_category']; ?></th>
                <th><?php echo $t['admin_order']; ?></th>
                <th><?php echo $t['admin_actions']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($technologies as $tech): ?>
            <tr>
                <td><?php echo htmlspecialchars($tech['nom'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($tech['nom_en'] ?? ''); ?></td>
                <td><?php echo $tech['categorie'] ?? ''; ?></td>
                <td><?php echo $tech['ordre'] ?? ''; ?></td>
                <td>
                    <a href="technologie_edit.php?id=<?php echo $tech['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> <?php echo $t['admin_edit']; ?></a>
                    <a href="?delete=<?php echo $tech['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> <?php echo $t['admin_delete']; ?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>