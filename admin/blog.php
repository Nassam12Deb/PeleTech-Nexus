<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_blog'];
include 'header.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM blog WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: blog.php?msg=deleted');
    exit;
}

$articles = $pdo->query("SELECT * FROM blog ORDER BY date DESC")->fetchAll();
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2><?php echo $t['admin_blog_list']; ?></h2>
    <a href="blog_edit.php" class="btn btn-primary"><i class="fas fa-plus"></i> <?php echo $t['admin_new_article']; ?></a>
</div>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
    <div class="alert alert-success"><?php echo $t['admin_article_deleted']; ?></div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><?php echo $t['admin_title']; ?></th>
                <th><?php echo $t['admin_date']; ?></th>
                <th><?php echo $t['admin_slug']; ?></th>
                <th><?php echo $t['admin_actions']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $a): ?>
            <tr>
                <td><?php echo htmlspecialchars($a['title'] ?? ''); ?></td>
                <td><?php echo $a['date'] ?? ''; ?></td>
                <td><?php echo $a['slug'] ?? ''; ?></td>
                <td>
                    <a href="blog_edit.php?id=<?php echo $a['id']; ?>" class="btn btn-small btn-secondary"><i class="fas fa-edit"></i> <?php echo $t['admin_edit']; ?></a>
                    <a href="?delete=<?php echo $a['id']; ?>" class="btn btn-small btn-secondary delete-link"><i class="fas fa-trash"></i> <?php echo $t['admin_delete']; ?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>