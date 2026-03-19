<?php include 'header.php';

$slug = $_GET['slug'] ?? '';
if (!$slug) {
    header('Location: blog.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM blog WHERE slug = ?");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: blog.php');
    exit;
}
?>

<section class="container" style="padding: 4rem 2rem;">
    <article class="card" style="max-width: 800px; margin: 0 auto;">
        <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1rem;">
            <i class="fas <?php echo htmlspecialchars($article['image']); ?>"></i>
        </div>
        <h1 class="section-title"><?php echo htmlspecialchars($article['title']); ?></h1>
        <p style="color: var(--gray-light); text-align: center;">
            <i class="far fa-calendar"></i> <?php echo date('d F Y', strtotime($article['date'])); ?>
            · <?php echo $article['read_time']; ?> min de lecture
        </p>
        <div style="line-height: 1.8; margin: 2rem 0;">
            <?php echo nl2br(htmlspecialchars($article['content'])); ?>
        </div>
        <?php if ($article['tags']): ?>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <?php foreach (explode(',', $article['tags']) as $tag): ?>
                <span class="badge badge-secondary"><?php echo trim(htmlspecialchars($tag)); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div style="margin-top: 2rem;">
            <a href="blog.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour au blog</a>
        </div>
    </article>
</section>

<?php include 'footer.php'; ?>