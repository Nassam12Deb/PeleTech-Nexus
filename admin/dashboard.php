<?php
require_once __DIR__ . '/../config.php';
$pageTitle = $t['admin_dashboard'];
include 'header.php';

// Compter les éléments
$servicesCount   = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
$realisationsCount = $pdo->query("SELECT COUNT(*) FROM realisations")->fetchColumn();
$blogCount       = $pdo->query("SELECT COUNT(*) FROM blog")->fetchColumn();
$temoignagesCount = $pdo->query("SELECT COUNT(*) FROM temoignages")->fetchColumn();
?>

<style>
/* ============= ANIMATIONS DASHBOARD ============= */

/* --- Entrée en cascade des cartes --- */
@keyframes cardReveal {
    from {
        opacity: 0;
        transform: translateY(28px) scale(0.97);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.dashboard-grid .dashboard-card {
    opacity: 0;
    animation: cardReveal 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* Stagger : chaque carte décalée de 90ms */
.dashboard-grid .dashboard-card:nth-child(1) { animation-delay: 0.05s; }
.dashboard-grid .dashboard-card:nth-child(2) { animation-delay: 0.14s; }
.dashboard-grid .dashboard-card:nth-child(3) { animation-delay: 0.23s; }
.dashboard-grid .dashboard-card:nth-child(4) { animation-delay: 0.32s; }
.dashboard-grid .dashboard-card:nth-child(5) { animation-delay: 0.41s; }

/* --- Icône : rotation douce + glow au hover --- */
@keyframes iconSpin {
    from { transform: rotate(0deg) scale(1); }
    to   { transform: rotate(360deg) scale(1.1); }
}

.dashboard-card i {
    display: inline-block;
    transition: filter 0.3s ease, transform 0.3s ease;
}

.dashboard-card:hover i {
    animation: iconSpin 0.55s cubic-bezier(0.4, 0, 0.2, 1) both;
    filter: drop-shadow(0 0 10px rgba(138, 111, 232, 0.7));
}

/* --- Compteur : pop à l'entrée --- */
@keyframes countPop {
    0%   { transform: scale(0.5); opacity: 0; }
    70%  { transform: scale(1.15); opacity: 1; }
    100% { transform: scale(1); }
}

.dashboard-card p {
    animation: countPop 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
    animation-delay: inherit; /* hérite du délai de la carte parente */
}

/* Réappliquer les delays sur les <p> explicitement */
.dashboard-grid .dashboard-card:nth-child(1) p { animation-delay: 0.18s; }
.dashboard-grid .dashboard-card:nth-child(2) p { animation-delay: 0.27s; }
.dashboard-grid .dashboard-card:nth-child(3) p { animation-delay: 0.36s; }
.dashboard-grid .dashboard-card:nth-child(4) p { animation-delay: 0.45s; }
.dashboard-grid .dashboard-card:nth-child(5) p { animation-delay: 0.54s; }

/* --- Ligne de progression animée sur la carte au hover --- */
.dashboard-card {
    position: relative;
    overflow: hidden;
}

.dashboard-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    height: 2px;
    width: 0;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 0 0 var(--radius-xl, 1rem) var(--radius-xl, 1rem);
}

.dashboard-card:hover::after {
    width: 100%;
}

/* --- Shimmer de fond au hover --- */
.dashboard-card::before {
    content: '';
    position: absolute;
    top: -60%; left: -60%;
    width: 60%; height: 200%;
    background: linear-gradient(
        105deg,
        transparent,
        rgba(138, 111, 232, 0.06),
        transparent
    );
    transform: skewX(-20deg);
    transition: left 0.6s ease;
    pointer-events: none;
}

.dashboard-card:hover::before {
    left: 160%;
}

/* --- Bouton : micro rebond au hover --- */
.dashboard-card .btn {
    transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1),
                box-shadow 0.2s ease,
                background 0.3s ease;
}

.dashboard-card:hover .btn {
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 6px 18px rgba(138, 111, 232, 0.35);
}

/* --- Respiration du grid à l'entrée de page --- */
@keyframes gridFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.dashboard-grid {
    animation: gridFadeIn 0.3s ease both;
}

/* --- Respect des préférences d'accessibilité --- */
@media (prefers-reduced-motion: reduce) {
    .dashboard-card,
    .dashboard-card p {
        animation: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
    .dashboard-card i { animation: none !important; }
    .dashboard-card::before { transition: none !important; }
    .dashboard-card::after  { transition: none !important; }
}
</style>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <i class="fas fa-cogs"></i>
        <h3><?php echo $t['admin_services']; ?></h3>
        <p><?php echo $servicesCount; ?></p>
        <a href="services.php" class="btn btn-small btn-primary"><?php echo $t['admin_manage']; ?></a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-briefcase"></i>
        <h3><?php echo $t['admin_realisations']; ?></h3>
        <p><?php echo $realisationsCount; ?></p>
        <a href="realisations.php" class="btn btn-small btn-primary"><?php echo $t['admin_manage']; ?></a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-blog"></i>
        <h3><?php echo $t['admin_blog']; ?></h3>
        <p><?php echo $blogCount; ?></p>
        <a href="blog.php" class="btn btn-small btn-primary"><?php echo $t['admin_manage']; ?></a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-comments"></i>
        <h3><?php echo $t['admin_temoignages']; ?></h3>
        <p><?php echo $temoignagesCount; ?></p>
        <a href="temoignages.php" class="btn btn-small btn-primary"><?php echo $t['admin_manage']; ?></a>
    </div>
    <div class="dashboard-card">
        <i class="fas fa-user"></i>
        <h3><?php echo $t['admin_profil']; ?></h3>
        <p><?php echo $t['admin_edit_info']; ?></p>
        <a href="profil.php" class="btn btn-small btn-primary"><?php echo $t['admin_edit']; ?></a>
    </div>
</div>

<?php include 'footer.php'; ?>