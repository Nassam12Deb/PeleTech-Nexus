<?php include 'header.php';

$articles = $pdo->query("SELECT * FROM blog ORDER BY date DESC")->fetchAll();
?>

<section class="container" style="padding: 4rem 2rem;">
    <h1 class="section-title">Blog</h1>
    <p class="section-subtitle">Actualités, conseils et retours d’expérience</p>

    <div class="grid grid-auto">
        <?php foreach ($articles as $article): ?>
        <div class="card animate-slide-up">
            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1rem;">
                <i class="fas <?php echo htmlspecialchars($article['image']); ?>"></i>
            </div>
            <h3><?php echo htmlspecialchars($article['title']); ?></h3>
            <p style="color: var(--gray-light); font-size: 0.9rem;">
                <i class="far fa-calendar"></i> <?php echo date('d/m/Y', strtotime($article['date'])); ?>
                · <?php echo $article['read_time']; ?> min
            </p>
            <p><?php echo htmlspecialchars($article['excerpt']); ?></p>
            <a href="blog_post.php?slug=<?php echo urlencode($article['slug']); ?>" class="btn btn-secondary btn-small">Lire la suite →</a>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'footer.php'; ?>