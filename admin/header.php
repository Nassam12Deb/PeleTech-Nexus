<?php
require_once __DIR__ . '/../config.php';
redirectIfNotLoggedIn();

$pageTitle = $pageTitle ?? 'Administration';
$username = $_SESSION['admin_username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - <?php echo SITE_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="sidebar-brand"><?php echo SITE_NAME; ?> - Admin</div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>><i class="fas fa-tachometer-alt"></i> <?php echo $t['admin_dashboard']; ?></a></li>

                <li style="padding: 10px 20px 5px; color: var(--text-secondary); font-size:0.75rem; text-transform:uppercase;">CONTENU</li>
                <li><a href="profil.php" <?php echo basename($_SERVER['PHP_SELF']) == 'profil.php' ? 'class="active"' : ''; ?>><i class="fas fa-user"></i> <?php echo $t['admin_profil']; ?></a></li>
                <li><a href="services.php" <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'class="active"' : ''; ?>><i class="fas fa-cogs"></i> <?php echo $t['admin_services']; ?></a></li>
                <li><a href="realisations.php" <?php echo basename($_SERVER['PHP_SELF']) == 'realisations.php' ? 'class="active"' : ''; ?>><i class="fas fa-briefcase"></i> <?php echo $t['admin_realisations']; ?></a></li>
                <li><a href="etapes_processus.php" <?php echo basename($_SERVER['PHP_SELF']) == 'etapes_processus.php' ? 'class="active"' : ''; ?>><i class="fas fa-tasks"></i> <?php echo $t['admin_etapes']; ?></a></li>
                <li><a href="blocs_contenu.php" <?php echo basename($_SERVER['PHP_SELF']) == 'blocs_contenu.php' ? 'class="active"' : ''; ?>><i class="fas fa-cubes"></i> <?php echo $t['admin_blocs']; ?></a></li>
                <li><a href="technologies.php" <?php echo basename($_SERVER['PHP_SELF']) == 'technologies.php' ? 'class="active"' : ''; ?>><i class="fas fa-code"></i> <?php echo $t['admin_technologies']; ?></a></li>
                <li><a href="temoignages.php" <?php echo basename($_SERVER['PHP_SELF']) == 'temoignages.php' ? 'class="active"' : ''; ?>><i class="fas fa-comments"></i> <?php echo $t['admin_temoignages']; ?></a></li>
                <li><a href="blog.php" <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'class="active"' : ''; ?>><i class="fas fa-blog"></i> <?php echo $t['admin_blog']; ?></a></li>

                <li style="padding: 10px 20px 5px; color: var(--text-secondary); font-size:0.75rem; text-transform:uppercase;">COMPTE</li>
                <li><a href="change_password.php" <?php echo basename($_SERVER['PHP_SELF']) == 'change_password.php' ? 'class="active"' : ''; ?>><i class="fas fa-key"></i> <?php echo $t['admin_password']; ?></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <?php echo $t['admin_logout']; ?></a></li>
                <!-- Sélecteur de langue dans l'admin -->
                <li style="margin-top:20px;">
                    <?php
                    $current_url = $_SERVER['REQUEST_URI'];
                    $new_lang = LANG === 'fr' ? 'en' : 'fr';
                    $clean_url = preg_replace('/(\?|&)lang=[^&]*/', '', $current_url);
                    $separator = (strpos($clean_url, '?') === false) ? '?' : '&';
                    $lang_url = $clean_url . $separator . 'lang=' . $new_lang;
                    ?>
                    <a href="<?php echo $lang_url; ?>" class="nav-link">
                        <i class="fas fa-language"></i> <?php echo LANG === 'fr' ? 'English' : 'Français'; ?>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <h1><?php echo $pageTitle; ?></h1>
                <div class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($username); ?></span>
                    <a href="logout.php" class="logout-btn" title="Déconnexion"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </header>
            <div class="admin-content">