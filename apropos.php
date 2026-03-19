<?php include 'header.php';

// Récupérer les données
$expertises = $pdo->query("SELECT * FROM blocs_contenu WHERE type = 'expertise' ORDER BY ordre")->fetchAll();
$valeurs    = $pdo->query("SELECT * FROM blocs_contenu WHERE type = 'valeur' ORDER BY ordre")->fetchAll();
$ressources = $pdo->query("SELECT * FROM blocs_contenu WHERE type = 'ressource' ORDER BY ordre")->fetchAll();
$technologies = $pdo->query("SELECT * FROM technologies ORDER BY categorie, ordre")->fetchAll();
$profil = $pdo->query("SELECT * FROM profil WHERE id = 1")->fetch();
?>

<style>
    /* Amélioration de la section philosophie */
    .philosophy-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    .philosophy-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    .philosophy-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    .philosophy-content h4 {
        color: var(--light);
        margin-bottom: 0.25rem;
        font-size: 1.1rem;
    }
    .philosophy-content p {
        color: var(--light-secondary);
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }
    .philosophy-item.wide {
        grid-column: span 2;
    }
    @media (max-width: 768px) {
        .philosophy-grid {
            grid-template-columns: 1fr;
        }
        .philosophy-item.wide {
            grid-column: span 1;
        }
    }

    /* Uniformisation des hauteurs de cartes */
    #expertise .card,
    #valeurs .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    #expertise .card p,
    #valeurs .card p {
        flex-grow: 1;
    }

    /* Effet de survol renforcé */
    #valeurs .card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-2xl), 0 0 0 2px var(--primary);
    }
</style>

<!-- Hero À propos -->
<section id="apropos-hero" class="animate-fade-in">
    <div class="container">
        <h1 class="section-title">Notre vision, votre réussite digitale</h1>
        <p class="section-subtitle">Concevoir avec rigueur. Créer avec sens. Développer avec exigence.</p>
    </div>
</section>

<!-- Vision et philosophie -->
<section id="vision" class="bg-dark-light">
    <div class="container">
        <div class="grid grid-2">
            <div>
                <h2 style="margin-bottom: 1.5rem; color: var(--light);">PêlêTech Nexus</h2>
                <div class="card" style="background: transparent; border: none; padding: 2rem;">
                    <p style="font-size: 1.05rem; line-height: 1.8; margin-bottom: 2rem; color: var(--light-secondary);">
                        <?php echo nl2br(htmlspecialchars($profil['description'])); ?>
                    </p>

                    <h3 style="color: var(--primary); margin-bottom: 1.5rem;">Notre philosophie</h3>

                    <div class="philosophy-grid">
                        <div class="philosophy-item">
                            <div class="philosophy-icon"><i class="fas fa-eye"></i></div>
                            <div class="philosophy-content">
                                <h4>Clarté</h4>
                                <p>Des choix lisibles, des interfaces compréhensibles, des décisions assumées.</p>
                            </div>
                        </div>
                        <div class="philosophy-item">
                            <div class="philosophy-icon"><i class="fas fa-ruler"></i></div>
                            <div class="philosophy-content">
                                <h4>Rigueur</h4>
                                <p>Chaque détail compte, du design à l’implémentation.</p>
                            </div>
                        </div>
                        <div class="philosophy-item">
                            <div class="philosophy-icon"><i class="fas fa-leaf"></i></div>
                            <div class="philosophy-content">
                                <h4>Durabilité</h4>
                                <p>Des solutions conçues pour évoluer dans le temps.</p>
                            </div>
                        </div>
                        <div class="philosophy-item">
                            <div class="philosophy-icon"><i class="fas fa-clock"></i></div>
                            <div class="philosophy-content">
                                <h4>Livraison dans les délais</h4>
                                <p>Respect des échéances convenues.</p>
                            </div>
                        </div>
                        <div class="philosophy-item wide">
                            <div class="philosophy-icon"><i class="fas fa-handshake"></i></div>
                            <div class="philosophy-content">
                                <h4>Engagement</h4>
                                <p>Votre réussite est intégrée à notre démarche.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-gradient">
                <div style="text-align: center; padding: 2rem;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem; width: 120px; height: 120px;">
                        <img src="assets/logo.png" alt="PêlêTech Nexus" style="width: 100%; height: 100%; object-fit: contain; border-radius: 50%;">
                    </div>
                    <h3 style="margin-bottom: 1.5rem; color: var(--light);">La marque & sa fondatrice</h3>
                    <p style="margin-bottom: 1.5rem; color: var(--light-secondary);">
                        PêlêTech Nexus est une marque fondée et pilotée par
                        <strong style="color: var(--light);"><?php echo htmlspecialchars($profil['fondatrice']); ?></strong>,
                        spécialisée dans le développement frontend, le design d’interfaces
                        et la création de supports visuels professionnels.
                    </p>
                    <div style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-top: 1.5rem;">
                        <p style="font-style: italic; color: var(--primary); font-size: 1.1rem;">
                            “Créer des expériences digitales utiles, élégantes et cohérentes —
                            rien de superflu, tout a un sens.”
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Expertise -->
<section id="expertise">
    <div class="container">
        <h2 class="section-title">Notre expertise digitale</h2>
        <p class="section-subtitle">Des compétences ciblées pour des résultats concrets</p>

        <div class="grid grid-4" style="margin-top: 3rem;">
            <?php foreach ($expertises as $exp): ?>
            <div class="card" style="text-align: center;">
                <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem;">
                    <i class="fas <?php echo htmlspecialchars($exp['icone']); ?>"></i>
                </div>
                <h3 style="color: var(--light);"><?php echo htmlspecialchars($exp['titre']); ?></h3>
                <p style="color: var(--light-secondary); font-size: 0.95rem;"><?php echo htmlspecialchars($exp['description']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="services.php" class="btn btn-primary">Découvrir tous nos services</a>
        </div>
    </div>
</section>

<!-- Valeurs -->
<section id="valeurs" class="bg-dark-light">
    <div class="container">
        <h2 class="section-title">Nos valeurs fondamentales</h2>
        <p class="section-subtitle">Les principes qui guident chaque décision, chaque ligne de code, chaque interaction.</p>

        <div class="grid grid-3">
            <?php foreach ($valeurs as $val): ?>
            <div class="card animate-slide-up">
                <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                    <i class="fas <?php echo htmlspecialchars($val['icone']); ?>"></i>
                </div>
                <h3><?php echo htmlspecialchars($val['titre']); ?></h3>
                <p style="color: var(--light-secondary);"><?php echo htmlspecialchars($val['description']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Approche technique -->
<section id="approche">
    <div class="container">
        <div class="grid grid-2">
            <div>
                <h2 style="margin-bottom: 1.5rem; color: var(--light);">Notre approche technique</h2>
                <div class="card" style="background: transparent; border: none; padding: 2rem;">
                    <p style="color: var(--light-secondary); margin-bottom: 1.5rem; margin-top: 1.5rem;">
                        Nous combinons méthodologie rigoureuse et technologies modernes pour créer des solutions
                        qui résistent à l'épreuve du temps.
                    </p>

                    <div style="margin-top: 2rem;">
                        <h4 style="color: var(--primary); margin-bottom: 1rem;">Environnement technique</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                            <?php foreach ($technologies as $tech): ?>
                            <span class="badge badge-secondary"><?php echo htmlspecialchars($tech['nom']); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <h4 style="color: var(--primary); margin-bottom: 1rem;">Nos standards qualité</h4>
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Code clair, structuré et maintenable</span>
                            </li>
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Respect des bonnes pratiques frontend et mobile</span>
                            </li>
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Validation fonctionnelle rigoureuse</span>
                            </li>
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Documentation essentielle pour la prise en main</span>
                            </li>
                            <li style="padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Performance, lisibilité et cohérence à chaque étape</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card card-gradient">
                <div style="padding: 2rem;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--light);">Pourquoi choisir PêlêTech Nexus ?</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                            <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Expertise focalisée</h4>
                            <p style="color: var(--light-secondary);">Nous nous concentrons exclusivement sur ce que nous maîtrisons parfaitement pour garantir des résultats optimaux.</p>
                        </li>
                        <li style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                            <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Approche sur mesure</h4>
                            <p style="color: var(--light-secondary);">Pas de solutions préfabriquées. Chaque projet est unique et mérite une approche personnalisée.</p>
                        </li>
                        <li>
                            <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Engagement long terme</h4>
                            <p style="color: var(--light-secondary);">Nous bâtissons des relations durables, pas des transactions ponctuelles.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Ressources éducatives -->
<section id="ressources" class="bg-dark-light">
    <div class="container">
        <div style="text-align: center; max-width: 1000px; margin: 0 auto 3rem auto;">
            <h2 class="section-title" style="margin-bottom: 1rem;">Ressources éducatives numériques</h2>
            <p style="color: var(--light-secondary); font-size: 1.2rem; line-height: 1.6;">
                Au-delà de nos services, nous concevons des supports éducatifs pour accompagner les enfants
                à la maison, à l’école ou en garderie.
            </p>
        </div>

        <div class="grid grid-4" style="gap: 1.5rem; margin-bottom: 3rem;">
            <?php foreach ($ressources as $res): ?>
            <div class="card" style="border: 1px solid rgba(138,111,232,0.3); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; text-align: center;">
                <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem auto;">
                    <i class="fas <?php echo htmlspecialchars($res['icone']); ?>"></i>
                </div>
                <h3 style="color: var(--light); font-size: 1.3rem; margin-bottom: 0.5rem; font-weight: 700;">
                    <?php echo htmlspecialchars($res['titre']); ?>
                </h3>
                <p style="color: var(--light-secondary); opacity: 0.7; font-size: 0.95rem;">
                    <?php echo htmlspecialchars($res['description']); ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center;">
            <a href="https://lsdehzyc.mychariow.shop/" class="btn btn-primary" style="padding: 0.8rem 2.5rem;">
                Découvrir les ressources <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section>
    <div class="container">
        <div class="card" style="text-align: center; padding: 4rem 2rem; background: rgba(11, 16, 32, 0.8); border: 1px solid rgba(138, 111, 232, 0.3);">
            <h2 style="margin-bottom: 1rem; color: var(--light);">Travaillons ensemble</h2>
            <p class="section-subtitle" style="margin-bottom: 2.5rem; color: var(--light-secondary);">
                Vous avez un projet en tête ? Discutons-en pour créer une solution qui correspond parfaitement à vos besoins.
            </p>
            <a href="contact.php" class="btn btn-primary btn-large">Prendre contact</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>