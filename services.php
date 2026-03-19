<?php include 'header.php';

// Récupérer tous les services
$services = $pdo->query("SELECT * FROM services ORDER BY categorie, ordre")->fetchAll();
// Regrouper par catégorie
$servicesParCategorie = [];
foreach ($services as $s) {
    $servicesParCategorie[$s['categorie']][] = $s;
}
?>

<!-- Hero -->
<section id="services-hero" class="animate-fade-in">
    <div class="container">
        <h1 class="section-title"><?php echo $t['services_hero_title']; ?></h1>
        <p class="section-subtitle"><?php echo $t['services_hero_subtitle']; ?></p>
    </div>
</section>

<!-- Sites Web -->
<?php if (isset($servicesParCategorie['web'])): foreach ($servicesParCategorie['web'] as $service):
    $titre = (LANG === 'en' && !empty($service['titre_en'])) ? $service['titre_en'] : $service['titre'];
    $description = (LANG === 'en' && !empty($service['description_en'])) ? $service['description_en'] : $service['description'];
?>
<section id="web" class="bg-dark-light">
    <div class="container">
        <div class="grid grid-2">
            <div>
                <span class="badge badge-primary"><?php echo $t['service_principal']; ?></span>
                <h2 style="margin: 1rem 0; color: var(--light);"><?php echo htmlspecialchars($titre); ?></h2>

                <div style="margin: 1.5rem 0;">
                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;"><?php echo $t['votre_enjeu']; ?></h4>
                    <p style="color: var(--light-secondary);">Inspirer confiance, capter l’attention et affirmer votre crédibilité dès les premières secondes.</p>

                    <h4 style="color: var(--primary); margin: 1.5rem 0 0.5rem;"><?php echo $t['notre_approche']; ?></h4>
                    <p style="color: var(--light-secondary);"><?php echo nl2br(htmlspecialchars($description)); ?></p>

                    <h4 style="color: var(--primary); margin: 1.5rem 0 0.5rem;"><?php echo $t['ce_que_vous_obtenez']; ?></h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li><span style="color: var(--primary);">✓</span> <span style="color: var(--light-secondary);">Une expérience fluide et cohérente sur tous les écrans</span></li>
                        <li><span style="color: var(--primary);">✓</span> <span style="color: var(--light-secondary);">Une image professionnelle forte et différenciante</span></li>
                        <li><span style="color: var(--primary);">✓</span> <span style="color: var(--light-secondary);">Une base saine pour la visibilité et le référencement</span></li>
                        <li><span style="color: var(--primary);">✓</span> <span style="color: var(--light-secondary);">Une navigation claire, intuitive et rassurante</span></li>
                        <li><span style="color: var(--primary);">✓</span> <span style="color: var(--light-secondary);">Un outil évolutif, fiable et maintenable dans le temps</span></li>
                    </ul>
                </div>

                <div style="margin-top: 2rem;">
                    <h4 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['technologies_utilisees']; ?></h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                        <span class="badge badge-secondary">HTML5 / CSS3</span>
                        <span class="badge badge-secondary">JavaScript</span>
                        <span class="badge badge-secondary">Design system</span>
                        <span class="badge badge-secondary">PHP / MySQL</span>
                        <span class="badge badge-secondary">GitHub</span>
                    </div>
                </div>
            </div>

            <div class="card card-gradient">
                <div style="text-align: center; padding: 2rem;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($service['icone']); ?>"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; color: var(--light);"><?php echo $t['types_sites']; ?></h3>
                    <ul style="text-align: left; list-style: none; padding: 0;">
                        <li>• <span style="color: var(--light-secondary);">Sites vitrines & portfolios</span></li>
                        <li>• <span style="color: var(--light-secondary);">Sites institutionnels</span></li>
                        <li>• <span style="color: var(--light-secondary);">Landing pages orientées conversion</span></li>
                        <li>• <span style="color: var(--light-secondary);">Sites e-commerce essentiels</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endforeach; endif; ?>

<!-- UI/UX -->
<?php if (isset($servicesParCategorie['design'])): foreach ($servicesParCategorie['design'] as $service):
    $titre = (LANG === 'en' && !empty($service['titre_en'])) ? $service['titre_en'] : $service['titre'];
    $description = (LANG === 'en' && !empty($service['description_en'])) ? $service['description_en'] : $service['description'];
?>
<section id="design">
    <div class="container">
        <div class="grid grid-2">
            <div class="card card-gradient">
                <div style="text-align: center; padding: 2rem;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($service['icone']); ?>"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; color: var(--light);">UI / UX orienté utilisateur</h3>
                    <p style="color: var(--light-secondary);">Chaque décision de design est guidée par l’usage, la clarté et l’efficacité.</p>
                </div>
            </div>

            <div>
                <span class="badge badge-primary"><?php echo $t['service_strategic']; ?></span>
                <h2 style="margin: 1rem 0; color: var(--light);"><?php echo htmlspecialchars($titre); ?></h2>

                <p style="color: var(--light-secondary);"><?php echo nl2br(htmlspecialchars($description)); ?></p>

                <div style="margin-top: 2rem;">
                    <h4 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['outils_maitrises']; ?></h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                        <span class="badge badge-secondary">Figma</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endforeach; endif; ?>

<!-- Mobile -->
<?php if (isset($servicesParCategorie['mobile'])): foreach ($servicesParCategorie['mobile'] as $service):
    $titre = (LANG === 'en' && !empty($service['titre_en'])) ? $service['titre_en'] : $service['titre'];
    $description = (LANG === 'en' && !empty($service['description_en'])) ? $service['description_en'] : $service['description'];
?>
<section id="mobile" class="bg-dark-light">
    <div class="container">
        <div class="grid grid-2">
            <div>
                <span class="badge badge-primary"><?php echo $t['service_technical']; ?></span>
                <h2 style="margin: 1rem 0; color: var(--light);"><?php echo htmlspecialchars($titre); ?></h2>

                <p style="color: var(--light-secondary);"><?php echo nl2br(htmlspecialchars($description)); ?></p>

                <div style="margin-top: 2rem;">
                    <h4 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['technologies_utilisees']; ?></h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                        <span class="badge badge-secondary">Flutter</span>
                        <span class="badge badge-secondary">Dart</span>
                    </div>
                </div>
            </div>

            <div class="card card-gradient">
                <div style="text-align: center; padding: 2rem;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($service['icone']); ?>"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; color: var(--light);">Approche mobile-first</h3>
                    <p style="color: var(--light-secondary);">Des interfaces pensées pour la performance, la lisibilité et une expérience utilisateur optimale.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endforeach; endif; ?>

<!-- Supports visuels -->
<?php if (isset($servicesParCategorie['supports'])): foreach ($servicesParCategorie['supports'] as $service):
    $titre = (LANG === 'en' && !empty($service['titre_en'])) ? $service['titre_en'] : $service['titre'];
    $description = (LANG === 'en' && !empty($service['description_en'])) ? $service['description_en'] : $service['description'];
?>
<section id="visuels">
    <div class="container">
        <div class="grid grid-2">
            <div class="card card-gradient">
                <div style="text-align: center; padding: 2rem;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($service['icone']); ?>"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; color: var(--light);">Identité & supports visuels</h3>
                    <p style="color: var(--light-secondary);">Des visuels cohérents, élégants et alignés avec votre image de marque.</p>
                </div>
            </div>

            <div>
                <span class="badge badge-primary"><?php echo $t['service_creative']; ?></span>
                <h2 style="margin: 1rem 0; color: var(--light);"><?php echo htmlspecialchars($titre); ?></h2>

                <p style="color: var(--light-secondary);"><?php echo nl2br(htmlspecialchars($description)); ?></p>

                <div style="margin-top: 2rem;">
                    <h4 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['outils_creation']; ?></h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                        <span class="badge badge-secondary">Figma</span>
                        <span class="badge badge-secondary">Canva Pro</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endforeach; endif; ?>

<!-- Section ComeUp -->
<section class="bg-darker" style="padding: 60px 0;">
    <div class="container">
        <div class="card card-gradient" style="text-align: center; padding: 4rem 2rem; border: 1px solid rgba(138, 111, 232, 0.3);">
            <h2 style="font-size: 2.2rem; margin-bottom: 1rem; color: var(--light);"><?php echo $t['cta_title']; ?></h2>
            <p style="color: var(--light-secondary); font-size: 1.1rem; margin-bottom: 2rem;">
                Découvrez mes services détaillés et commandez directement sur ComeUp
            </p>
            <a href="https://comeup.com/fr/@peledebnassam" class="btn btn-primary btn-large" target="_blank" rel="noopener noreferrer">
                Voir mes services sur ComeUp →
            </a>
            <p style="color: var(--light-secondary); margin-top: 1.5rem; font-size: 0.95rem; display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <span><i class="fas fa-bolt" style="color: var(--primary); margin-right: 0.3rem;"></i> Réponse en moins de 2h</span>
                <span><i class="fas fa-box" style="color: var(--primary); margin-right: 0.3rem;"></i> Livraison garantie</span>
                <span><i class="fas fa-thumbs-up" style="color: var(--primary); margin-right: 0.3rem;"></i> Support inclus</span>
            </p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>