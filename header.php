<?php
require_once 'config.php';
// Récupérer les infos du profil pour le footer
$stmt = $pdo->query("SELECT * FROM profil WHERE id = 1");
$profil = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> | Agence numérique</title>
    <meta name="description" content="Sites web modernes, UI/UX design, applications mobile et supports visuels.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">
    <!-- Balises hreflang pour SEO -->
    <link rel="alternate" href="<?php echo BASE_URL; ?>?lang=fr" hreflang="fr">
    <link rel="alternate" href="<?php echo BASE_URL; ?>?lang=en" hreflang="en">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">PêlêTech Nexus</a>

            <button class="menu-toggle" id="menuToggle" aria-label="Menu">
                <span class="icon"><i class="fas fa-bars"></i></span>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="nav-link"><?php echo $t['nav_home']; ?></a></li>
                <li><a href="services.php" class="nav-link"><?php echo $t['nav_services']; ?></a></li>
                <li><a href="realisations.php" class="nav-link"><?php echo $t['nav_realisations']; ?></a></li>
                <li><a href="blog.php" class="nav-link"><?php echo $t['nav_blog']; ?></a></li>
                <li><a href="process.php" class="nav-link"><?php echo $t['nav_process']; ?></a></li>
                <li><a href="apropos.php" class="nav-link"><?php echo $t['nav_about']; ?></a></li>
                <li><a href="contact.php" class="nav-link cta-nav"><?php echo $t['nav_cta']; ?></a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-progress" id="scrollProgress"></div>
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <main id="main-content">