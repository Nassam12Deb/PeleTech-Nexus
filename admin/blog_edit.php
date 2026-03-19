<?php
$id = $_GET['id'] ?? null;
$pageTitle = $id ? $t['admin_edit_article'] : $t['admin_add_article'];
include 'header.php';

$article = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM blog WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();
    if (!$article) {
        header('Location: blog.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title     = $_POST['title'];
    $title_en  = $_POST['title_en'] ?: null;
    $slug      = $_POST['slug'] ?: slugify($title);
    $excerpt   = $_POST['excerpt'];
    $excerpt_en= $_POST['excerpt_en'] ?: null;
    $content   = $_POST['content'];
    $content_en= $_POST['content_en'] ?: null;
    $image     = $_POST['image'];
    $date      = $_POST['date'];
    $read_time = (int)$_POST['read_time'];
    $tags      = $_POST['tags'];
    $tags_en   = $_POST['tags_en'] ?: null;

    // Vérifier l'unicité du slug
    if (!$id) {
        $check = $pdo->prepare("SELECT id FROM blog WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->fetch()) {
            $slug = $slug . '-' . uniqid();
        }
    } else {
        $check = $pdo->prepare("SELECT id FROM blog WHERE slug = ? AND id != ?");
        $check->execute([$slug, $id]);
        if ($check->fetch()) {
            $slug = $slug . '-' . uniqid();
        }
    }

    if ($id) {
        $sql = "UPDATE blog SET title=?, title_en=?, slug=?, excerpt=?, excerpt_en=?, content=?, content_en=?, image=?, date=?, read_time=?, tags=?, tags_en=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $title_en, $slug, $excerpt, $excerpt_en, $content, $content_en, $image, $date, $read_time, $tags, $tags_en, $id]);
    } else {
        $sql = "INSERT INTO blog (title, title_en, slug, excerpt, excerpt_en, content, content_en, image, date, read_time, tags, tags_en) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $title_en, $slug, $excerpt, $excerpt_en, $content, $content_en, $image, $date, $read_time, $tags, $tags_en]);
    }
    header('Location: blog.php');
    exit;
}
?>

<h2><?php echo $pageTitle; ?></h2>

<form method="POST" class="admin-form">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_title_fr']; ?></label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($article['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_title_en']; ?></label>
            <input type="text" name="title_en" class="form-control" value="<?php echo htmlspecialchars($article['title_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_slug']; ?></label>
        <input type="text" name="slug" class="form-control" value="<?php echo htmlspecialchars($article['slug'] ?? ''); ?>">
        <small><?php echo $t['admin_slug_help']; ?></small>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_excerpt_fr']; ?></label>
            <textarea name="excerpt" class="form-control" rows="3"><?php echo htmlspecialchars($article['excerpt'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_excerpt_en']; ?></label>
            <textarea name="excerpt_en" class="form-control" rows="3"><?php echo htmlspecialchars($article['excerpt_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_content_fr']; ?></label>
            <textarea name="content" class="form-control" rows="10" required><?php echo htmlspecialchars($article['content'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_content_en']; ?></label>
            <textarea name="content_en" class="form-control" rows="10"><?php echo htmlspecialchars($article['content_en'] ?? ''); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_image']; ?></label>
        <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($article['image'] ?? 'fa-newspaper'); ?>">
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_date']; ?></label>
        <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($article['date'] ?? date('Y-m-d')); ?>" required>
    </div>
    <div class="form-group">
        <label><?php echo $t['admin_read_time']; ?></label>
        <input type="number" name="read_time" class="form-control" value="<?php echo $article['read_time'] ?? 5; ?>">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div class="form-group">
            <label><?php echo $t['admin_tags_fr']; ?></label>
            <input type="text" name="tags" class="form-control" value="<?php echo htmlspecialchars($article['tags'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label><?php echo $t['admin_tags_en']; ?></label>
            <input type="text" name="tags_en" class="form-control" value="<?php echo htmlspecialchars($article['tags_en'] ?? ''); ?>">
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $t['admin_save']; ?></button>
        <a href="blog.php" class="btn btn-secondary"><?php echo $t['admin_cancel']; ?></a>
    </div>
</form>

<?php include 'footer.php'; ?>