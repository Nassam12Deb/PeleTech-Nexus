<?php include 'header.php';

$etapes = $pdo->query("SELECT * FROM etapes_processus ORDER BY ordre")->fetchAll();
?>

<style>
    .process-steps {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: stretch;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .step-card {
        flex: 1 1 140px;
        max-width: 180px;
        background: rgba(20,24,39,0.8);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(138,111,232,0.2);
        border-radius: 20px;
        padding: 1.5rem 1rem;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }
    .step-card:hover {
        transform: translateY(-8px) scale(1.02);
        border-color: var(--primary);
        box-shadow: 0 20px 30px rgba(138,111,232,0.3);
        background: rgba(30,35,55,0.9);
    }
    .step-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 40px;
        margin-bottom: 1rem;
        letter-spacing: 0.5px;
    }
    .step-card h4 {
        color: var(--light);
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .step-card p {
        color: var(--light-secondary);
        font-size: 0.85rem;
        line-height: 1.4;
    }
    .step-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.2rem;
        opacity: 0.7;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .process-steps {
            flex-direction: column;
            align-items: center;
        }
        .step-card {
            max-width: 280px;
            width: 100%;
        }
        .step-arrow {
            display: none;
        }
    }
    .steps-intro {
        text-align: center;
        color: var(--light-secondary);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        font-style: italic;
        border-bottom: 1px dashed rgba(138,111,232,0.3);
        padding-bottom: 1rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<!-- Hero Process -->
<section id="process-hero" class="animate-fade-in">
    <div class="container">
        <h1 class="section-title"><?php echo $t['process_hero_title']; ?></h1>
        <p class="section-subtitle"><?php echo sprintf($t['process_hero_subtitle'], count($etapes)); ?></p>
    </div>
</section>

<!-- Timeline / Étapes -->
<section id="process-timeline" class="bg-dark-light">
    <div class="container">
        <p class="steps-intro">
            <i class="fas fa-hand-point-right" style="margin-right: 0.5rem; color: var(--primary);"></i>
            <?php echo $t['steps_intro']; ?>
        </p>

        <div class="process-steps">
            <?php foreach ($etapes as $index => $etape): ?>
            <div class="step-card" onclick="document.getElementById('etape-<?php echo $etape['id']; ?>').scrollIntoView({behavior: 'smooth'})">
                <span class="step-badge"><?php echo $t['etape'] . ' ' . ($index+1); ?></span>
                <h4><?php 
                    $titre = (LANG === 'en' && !empty($etape['titre_en'])) ? $etape['titre_en'] : $etape['titre'];
                    echo htmlspecialchars($titre ?? ''); 
                ?></h4>
                <p><?php 
                    $desc = (LANG === 'en' && !empty($etape['description_en'])) ? $etape['description_en'] : $etape['description'];
                    echo htmlspecialchars($desc ?? ''); 
                ?></p>
            </div>
            <?php if ($index < count($etapes)-1): ?>
            <div class="step-arrow"><i class="fas fa-arrow-right"></i></div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php foreach ($etapes as $index => $etape): 
    $titre = (LANG === 'en' && !empty($etape['titre_en'])) ? $etape['titre_en'] : $etape['titre'];
    $description = (LANG === 'en' && !empty($etape['description_en'])) ? $etape['description_en'] : $etape['description'];
    $livrables = (LANG === 'en' && !empty($etape['livrables_en'])) ? $etape['livrables_en'] : $etape['livrables'];
    $duree = (LANG === 'en' && !empty($etape['duree_estimee_en'])) ? $etape['duree_estimee_en'] : $etape['duree_estimee'];
?>
<!-- Étape <?php echo $index+1; ?> -->
<section id="etape-<?php echo $etape['id']; ?>" class="<?php echo $index % 2 == 0 ? '' : 'bg-dark-light'; ?>">
    <div class="container">
        <div class="grid grid-2">
            <?php if ($index % 2 == 0): ?>
            <div>
                <div class="badge badge-secondary" style="margin-bottom: 1rem;"><?php echo $t['etape'] . ' ' . ($index+1); ?></div>
                <h2 style="color: var(--light); margin-bottom: 1rem;"><?php echo htmlspecialchars($titre ?? ''); ?></h2>
                <p style="color: var(--light-secondary); margin-bottom: 1.5rem;"><?php echo nl2br(htmlspecialchars($description ?? '')); ?></p>

                <?php if (!empty($livrables)): ?>
                <div style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                    <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><?php echo $t['livrables']; ?></h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php 
                        $livrablesList = explode("\n", $livrables);
                        foreach ($livrablesList as $l): 
                            $ligne = trim($l);
                            $ligne = ltrim($ligne, "• ");
                            if ($ligne !== ''):
                        ?>
                        <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                            <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                            <span style="color: var(--light-secondary);"><?php echo htmlspecialchars($ligne); ?></span>
                        </li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (!empty($duree)): ?>
                <div>
                    <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><?php echo $t['duree_estimee']; ?></h4>
                    <p style="color: var(--light-secondary);"><?php echo htmlspecialchars($duree); ?></p>
                </div>
                <?php endif; ?>
            </div>

            <div class="card card-gradient">
                <div style="padding: 2rem; text-align: center;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($etape['icone'] ?? ''); ?>"></i>
                    </div>
                    <h3 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['en_pratique']; ?></h3>
                    <p style="color: var(--light-secondary);">
                        <?php echo htmlspecialchars($description ?? ''); ?>
                    </p>
                </div>
            </div>
            <?php else: ?>
            <div class="card card-gradient">
                <div style="padding: 2rem; text-align: center;">
                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($etape['icone'] ?? ''); ?>"></i>
                    </div>
                    <h3 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['en_pratique']; ?></h3>
                    <p style="color: var(--light-secondary);">
                        <?php echo htmlspecialchars($description ?? ''); ?>
                    </p>
                </div>
            </div>

            <div>
                <div class="badge badge-secondary" style="margin-bottom: 1rem;"><?php echo $t['etape'] . ' ' . ($index+1); ?></div>
                <h2 style="color: var(--light); margin-bottom: 1rem;"><?php echo htmlspecialchars($titre ?? ''); ?></h2>
                <p style="color: var(--light-secondary); margin-bottom: 1.5rem;"><?php echo nl2br(htmlspecialchars($description ?? '')); ?></p>

                <?php if (!empty($livrables)): ?>
                <div style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                    <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><?php echo $t['livrables']; ?></h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php 
                        $livrablesList = explode("\n", $livrables);
                        foreach ($livrablesList as $l): 
                            $ligne = trim($l);
                            $ligne = ltrim($ligne, "• ");
                            if ($ligne !== ''):
                        ?>
                        <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                            <span style="position: absolute; left: 0; color: var(--primary);;">•</span>
                            <span style="color: var(--light-secondary);"><?php echo htmlspecialchars($ligne); ?></span>
                        </li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (!empty($duree)): ?>
                <div>
                    <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><?php echo $t['duree_estimee']; ?></h4>
                    <p style="color: var(--light-secondary);"><?php echo htmlspecialchars($duree); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

<!-- CTA -->
<section id="process-cta" style="background: linear-gradient(135deg, rgba(138,111,232,0.1), rgba(79,163,217,0.1));">
    <div class="container">
        <div class="grid grid-2">
            <div class="card" style="background: rgba(11,16,32,0.8); padding: 3rem;">
                <h2 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['transparence_title']; ?></h2>
                <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                    <?php echo $t['transparence_text']; ?>
                </p>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                        <span style="color: var(--light-secondary);"><?php echo $t['transparence_item1']; ?></span>
                    </li>
                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                        <span style="color: var(--light-secondary);"><?php echo $t['transparence_item2']; ?></span>
                    </li>
                    <li style="padding-left: 1.5rem; position: relative;">
                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                        <span style="color: var(--light-secondary);"><?php echo $t['transparence_item3']; ?></span>
                    </li>
                </ul>
            </div>

            <div class="card card-gradient" style="text-align: center; padding: 3rem; display: flex; flex-direction: column; justify-content: center;">
                <h2 style="color: var(--light); margin-bottom: 1rem;"><?php echo $t['process_cta_title']; ?></h2>
                <p style="color: var(--light-secondary); margin-bottom: 2rem;">
                    <?php echo $t['process_cta_text']; ?>
                </p>
                <a href="contact.php" class="btn btn-primary btn-large"><?php echo $t['process_cta_btn']; ?></a>
            </div>
        </div>
    </div>
</section>

<script>
    // S'assurer que le défilement fluide fonctionne
    document.querySelectorAll('.step-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // l'attribut onclick est déjà géré, mais on peut laisser
        });
    });
</script>

<?php include 'footer.php'; ?>