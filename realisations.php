<?php include 'header.php';

$realisations = $pdo->query("SELECT * FROM realisations ORDER BY ordre")->fetchAll();
?>
<style>
    /* FILTRE ACTIF – VISIBLE IMMÉDIATEMENT */
    .filter-btn.active {
        box-shadow: 0 0 0 3px var(--primary) !important;
        transform: scale(1.05) !important;
        background: rgba(138, 111, 232, 0.2) !important;
        border-color: var(--primary) !important;
        color: var(--light) !important;
        transition: all 0.2s ease !important;
    }

    /* Styles pour le modal de galerie */
    .galerie-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 1000;
        overflow-y: auto;
        animation: fadeInModal 0.3s ease;
    }

    @keyframes fadeInModal {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .galerie-modal-content {
        background: var(--dark);
        margin: 2rem auto;
        width: 90%;
        max-width: 1200px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(138, 111, 232, 0.2);
        animation: slideUpModal 0.3s ease;
    }

    @keyframes slideUpModal {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .galerie-modal-header {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, rgba(26, 29, 38, 0.9), rgba(19, 21, 28, 0.95));
        border-bottom: 1px solid rgba(138, 111, 232, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .galerie-modal-header h3 {
        color: var(--light);
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .galerie-modal-close {
        background: none;
        border: none;
        color: var(--light-secondary);
        font-size: 1.8rem;
        cursor: pointer;
        transition: color 0.3s;
        line-height: 1;
        padding: 0.5rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .galerie-modal-close:hover {
        color: var(--light);
        background: rgba(138, 111, 232, 0.1);
    }

    .galerie-modal-body {
        padding: 2rem;
        min-height: 500px;
    }

    /* Onglets */
    .galerie-modal-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 0.5rem;
        flex-wrap: wrap;
    }

    .galerie-modal-tab {
        background: none;
        border: none;
        padding: 0.75rem 1.5rem;
        color: var(--light-secondary);
        cursor: pointer;
        border-radius: 8px 8px 0 0;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .galerie-modal-tab:hover {
        color: var(--light);
        background: rgba(138, 111, 232, 0.05);
    }

    .galerie-modal-tab.active {
        color: var(--primary);
        background: rgba(138, 111, 232, 0.1);
        border-bottom: 3px solid var(--primary);
    }

    .galerie-tab-badge {
        background: var(--primary);
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    /* Contenu des onglets */
    .galerie-modal-tab-content {
        display: none;
    }

    .galerie-modal-tab-content.active {
        display: block;
        animation: fadeInModal 0.3s ease;
    }

    /* Galerie d'images */
    .galerie-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .galerie-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s;
        aspect-ratio: 4/3;
        background: var(--dark-light);
    }

    .galerie-item:hover {
        transform: scale(1.02);
    }

    .galerie-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s;
    }

    .galerie-item:hover img {
        transform: scale(1.05);
    }

    .galerie-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.8);
        padding: 0.75rem;
        transform: translateY(100%);
        transition: transform 0.3s;
    }

    .galerie-item:hover .galerie-overlay {
        transform: translateY(0);
    }

    /* Vidéos */
    .galerie-video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .galerie-video-item {
        background: var(--dark-light);
        border-radius: 8px;
        overflow: hidden;
        padding: 1.5rem;
        border: 1px solid rgba(138, 111, 232, 0.1);
    }

    .galerie-video-placeholder {
        width: 100%;
        height: 180px;
        background: rgba(138, 111, 232, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 3rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .galerie-video-placeholder:hover {
        transform: scale(1.05);
        background: rgba(138, 111, 232, 0.2);
    }

    .galerie-video-info h4 {
        color: var(--light);
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .galerie-video-info {
        color: var(--light-secondary);
        font-size: 0.9rem;
    }

    /* Documents */
    .galerie-documents-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .galerie-document-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--dark-light);
        border-radius: 8px;
        transition: background 0.3s;
        text-decoration: none;
        color: var(--light-secondary);
        border: 1px solid rgba(138, 111, 232, 0.05);
    }

    .galerie-document-item:hover {
        background: rgba(138, 111, 232, 0.1);
        color: var(--light);
        border-color: rgba(138, 111, 232, 0.2);
        transform: translateY(-2px);
    }

    .galerie-document-icon {
        font-size: 1.5rem;
        color: var(--primary);
        min-width: 40px;
    }

    .galerie-document-info {
        flex: 1;
    }

    .galerie-document-name {
        font-weight: 600;
        color: var(--light);
        margin-bottom: 0.25rem;
    }

    .galerie-document-size {
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .galerie-document-download {
        color: var(--primary);
        font-size: 1.2rem;
        transition: transform 0.3s;
    }

    .galerie-document-item:hover .galerie-document-download {
        transform: translateY(-2px);
    }

    /* Informations du projet */
    .galerie-project-info {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .galerie-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .galerie-info-item h4 {
        color: var(--primary);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .galerie-info-item p {
        color: var(--light);
        font-size: 1.1rem;
        font-weight: 600;
    }

    .galerie-tech-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .galerie-tech-tag {
        background: rgba(138, 111, 232, 0.1);
        color: var(--primary);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .galerie-info-section {
        background: var(--dark-light);
        padding: 1.5rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .galerie-info-section h4 {
        color: var(--light);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.1rem;
    }

    .galerie-info-section p {
        color: var(--light-secondary);
        line-height: 1.6;
    }

    .galerie-features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .galerie-features-list li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
        color: var(--light-secondary);
    }

    .galerie-features-list li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: var(--primary);
        font-weight: bold;
        font-size: 1.2rem;
    }

    .galerie-file-stats {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .galerie-file-stat {
        text-align: center;
    }

    .galerie-file-stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        display: block;
    }

    .galerie-file-stat-label {
        color: var(--light-secondary);
        font-size: 0.9rem;
    }

    /* Footer du modal */
    .galerie-modal-footer {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, rgba(26, 29, 38, 0.9), rgba(19, 21, 28, 0.95));
        border-top: 1px solid rgba(138, 111, 232, 0.1);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    /* Bouton "Voir la galerie" */
    .btn-galerie {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(138, 111, 232, 0.1);
        color: var(--primary);
        border: 1px solid rgba(138, 111, 232, 0.2);
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-galerie:hover {
        background: rgba(138, 111, 232, 0.2);
        color: var(--light);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(138, 111, 232, 0.2);
    }

    /* État de chargement */
    .galerie-loading {
        text-align: center;
        padding: 3rem;
        color: var(--light-secondary);
    }

    .galerie-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(138, 111, 232, 0.2);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Message d'erreur */
    .galerie-error {
        text-align: center;
        padding: 3rem;
        color: var(--light-secondary);
    }

    .galerie-error i {
        font-size: 3rem;
        color: #ff6b6b;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .galerie-modal-content {
            width: 95%;
            margin: 1rem auto;
        }
        .galerie-modal-header {
            padding: 1rem;
        }
        .galerie-modal-body {
            padding: 1rem;
        }
        .galerie-modal-tabs {
            flex-wrap: wrap;
        }
        .galerie-modal-footer {
            flex-direction: column;
            padding: 1rem;
        }
        .galerie-modal-footer .btn {
            width: 100%;
        }
        .galerie-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .galerie-video-grid {
            grid-template-columns: 1fr;
        }
        .galerie-info-grid {
            grid-template-columns: 1fr;
        }
        .galerie-file-stats {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .galerie-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $titre = (LANG === 'en' && !empty($projet['titre_en'])) ? $projet['titre_en'] : $projet['titre'];
$client = (LANG === 'en' && !empty($projet['client_en'])) ? $projet['client_en'] : $projet['client'];
$defi = (LANG === 'en' && !empty($projet['defi_en'])) ? $projet['defi_en'] : $projet['defi'];
// etc.?>

<!-- Hero Réalisations -->
<section id="realisations-hero" class="animate-fade-in">
    <div class="container">
        <h1 class="section-title">Nos réalisations</h1>
        <p class="section-subtitle">Des solutions concrètes, des résultats mesurables. Découvrez comment nous transformons les idées en produits digitaux performants.</p>

        <div style="text-align: center; margin-top: 3rem;">
            <div style="display: inline-flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                <button class="badge badge-accent filter-btn active" data-filter="all">Tous les projets</button>
                <button class="badge badge-secondary filter-btn" data-filter="web">Développement Web</button>
                <button class="badge badge-primary filter-btn" data-filter="mobile">Applications Mobile</button>
                <button class="badge badge-secondary filter-btn" data-filter="design">UI/UX Design</button>
                <button class="badge badge-accent filter-btn" data-filter="maquettes">Maquettes</button>
                <button class="badge badge-secondary filter-btn" data-filter="supports">Supports</button>
            </div>
        </div>
    </div>
</section>

<!-- Projets détaillés -->
<section id="projets" class="bg-dark-light">
    <div class="container">
        <?php foreach ($realisations as $index => $projet): 
            // Déterminer la catégorie pour le data-category
            $dataCategory = $projet['categorie'];
            if ($dataCategory == 'ui_ux') $dataCategory = 'design';
        ?>
        <div class="projet-card card animate-slide-up" data-category="<?php echo $dataCategory; ?>" style="margin-top: <?php echo $index === 0 ? '4rem' : '4rem'; ?>;">
            <div class="grid grid-2">
                <div>
                    <div class="badge badge-primary" style="margin-bottom: 1rem;"><?php echo ucfirst($projet['categorie'] ?? ''); ?></div>
                    <h3 style="color: var(--light); margin-bottom: 0.5rem;"><?php echo htmlspecialchars($projet['titre'] ?? ''); ?></h3>
                    <h3 style="color: var(--primary); font-size: 1.1rem; margin-bottom: 1.5rem;">
                        <?php echo htmlspecialchars($projet['client'] ?? ''); ?> • <?php echo $projet['annee'] ?? ''; ?>
                    </h3>

                    <div style="margin-bottom: 2rem;">
                        <h4 style="color: var(--light); margin-bottom: 0.75rem;">Le défi</h4>
                        <p style="color: var(--light-secondary);"><?php echo nl2br(htmlspecialchars($projet['defi'] ?? '')); ?></p>
                    </div>

                    <div style="margin-bottom: 2rem;">
                        <h4 style="color: var(--light); margin-bottom: 0.75rem;">Notre solution</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <?php 
                            $solutionLines = explode("\n", $projet['solution'] ?? '');
                            foreach ($solutionLines as $ligne): 
                                $ligne = trim($ligne);
                                // Supprimer le premier "•" s'il est présent
                                $ligne = ltrim($ligne, "• ");
                                if ($ligne !== ''):
                            ?>
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                <span style="color: var(--light-secondary);"><?php echo htmlspecialchars($ligne); ?></span>
                            </li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    </div>

                    <div>
                        <h4 style="color: var(--light); margin-bottom: 0.75rem;">Technologies utilisées</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                            <?php foreach (explode(',', $projet['technologies'] ?? '') as $tech): ?>
                            <?php if (trim($tech)): ?>
                            <span class="badge badge-secondary"><?php echo trim(htmlspecialchars($tech)); ?></span>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if (!empty($projet['drive_folder_id'])): ?>
                    <div style="margin-top: 2rem;">
                        <button class="btn-galerie" data-drive-id="<?php echo $projet['drive_folder_id']; ?>" data-project-title="<?php echo htmlspecialchars($projet['titre'] ?? ''); ?>">
                            <i class="fas fa-images"></i>
                            <span>Voir la galerie du projet</span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>

                <div>
                    <div class="card card-gradient" style="height: 100%; padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                        <div style="text-align: center; margin-bottom: 2rem;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 style="color: var(--light); margin-bottom: 0.5rem;">Résultats obtenus</h3>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                            <?php
                            $resultats = explode("\n", $projet['resultats'] ?? '');
                            foreach ($resultats as $res):
                                if (trim($res)):
                                    $parts = explode(':', $res, 2);
                                    if (count($parts) == 2):
                            ?>
                            <div style="text-align: center;">
                                <div style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;"><?php echo trim($parts[0]); ?></div>
                                <p style="color: var(--light-secondary); font-size: 0.9rem;"><?php echo trim($parts[1]); ?></p>
                            </div>
                            <?php
                                    endif;
                                endif;
                            endforeach;
                            ?>
                        </div>

                        <?php if (!empty($projet['temoignage'])): ?>
                        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(138, 111, 232, 0.2);">
                            <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Retour client</h4>
                            <p style="color: var(--light-secondary); font-style: italic;">"<?php echo htmlspecialchars($projet['temoignage'] ?? ''); ?>"</p>
                            <?php if (!empty($projet['temoignage_auteur'])): ?>
                            <p style="color: var(--light); margin-top: 0.5rem; font-weight: 600;">— <?php echo htmlspecialchars($projet['temoignage_auteur'] ?? ''); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Autres projets (cartes compactes) -->
<section id="autres-projets">
    <div class="container">
        <h2 class="section-title">Autres réalisations</h2>
        <p class="section-subtitle">Découvrez d'autres projets où nous avons fait la différence.</p>

        <div class="grid grid-3" style="margin-top: 3rem;">
            <!-- Carte 1 : Portail client immobilier -->
            <div class="card animate-slide-up" data-category="web">
                <div class="badge badge-primary" style="margin-bottom: 1rem; font-size: 0.7rem;">Web</div>
                <h3 style="color: var(--light); margin-bottom: 0.75rem;">Portail client immobilier</h3>
                <p style="color: var(--light-secondary); font-size: 0.95rem; margin-bottom: 1.5rem;">
                    Plateforme de gestion de biens immobiliers avec suivi des locations, paiements en ligne et communication propriétaire-locataire.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <span class="badge badge-secondary" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Vue.js</span>
                    <span class="badge badge-secondary" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Laravel</span>
                    <span class="badge badge-accent" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Stripe</span>
                </div>
                <div style="color: var(--primary); font-weight: 600;">+50% d'automatisation</div>
                <div style="margin-top: 1rem;">
                    <button class="btn-galerie btn-small" data-drive-id="FOLDER_ID_5" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                        <i class="fas fa-images"></i>
                        <span>Voir la galerie</span>
                    </button>
                </div>
            </div>

            <!-- Carte 2 : App de fitness connectée -->
            <div class="card animate-slide-up" data-category="mobile" style="animation-delay: 0.1s;">
                <div class="badge badge-primary" style="margin-bottom: 1rem; font-size: 0.7rem;">Mobile</div>
                <h3 style="color: var(--light); margin-bottom: 0.75rem;">App de fitness connectée</h3>
                <p style="color: var(--light-secondary); font-size: 0.95rem; margin-bottom: 1.5rem;">
                    Application de suivi d'activité physique avec synchronisation des bracelets connectés et programmes d'entraînement personnalisés.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <span class="badge badge-secondary" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Flutter</span>
                    <span class="badge badge-secondary" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Firebase</span>
                    <span class="badge badge-accent" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">API HealthKit</span>
                </div>
                <div style="color: var(--primary); font-weight: 600;">4.7★ sur les stores</div>
                <div style="margin-top: 1rem;">
                    <button class="btn-galerie btn-small" data-drive-id="FOLDER_ID_6" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                        <i class="fas fa-images"></i>
                        <span>Voir la galerie</span>
                    </button>
                </div>
            </div>

            <!-- Carte 3 : Site vitrine premium -->
            <div class="card animate-slide-up" data-category="design" style="animation-delay: 0.2s;">
                <div class="badge badge-primary" style="margin-bottom: 1rem; font-size: 0.7rem;">Design</div>
                <h3 style="color: var(--light); margin-bottom: 0.75rem;">Site vitrine premium</h3>
                <p style="color: var(--light-secondary); font-size: 0.95rem; margin-bottom: 1.5rem;">
                    Design et développement d'un site vitrine haut de gamme pour une marque de luxe, avec animations subtiles et expérience immersive.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <span class="badge badge-secondary" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Figma</span>
                    <span class="badge badge-secondary" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">GSAP</span>
                    <span class="badge badge-accent" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Three.js</span>
                </div>
                <div style="color: var(--primary); font-weight: 600;">+35% de leads qualifiés</div>
                <div style="margin-top: 1rem;">
                    <button class="btn-galerie btn-small" data-drive-id="FOLDER_ID_7" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                        <i class="fas fa-images"></i>
                        <span>Voir la galerie</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section id="realisations-cta" style="background: linear-gradient(135deg, rgba(138,111,232,0.1), rgba(79,163,217,0.1)); margin-top: 4rem;">
    <div class="container">
        <div class="card card-gradient" style="text-align: center; padding: 4rem 2rem; border: 1px solid rgba(138,111,232,0.3);">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--light);">Et votre projet ?</h2>
            <p class="section-subtitle" style="margin-bottom: 2.5rem; color: var(--light-secondary);">
                Vous avez une idée, un besoin spécifique ? Discutons-en pour créer la prochaine réussite dans notre portfolio.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="contact.php" class="btn btn-primary btn-large">Discuter de mon projet</a>
                <a href="services.php" class="btn btn-secondary btn-large">Découvrir nos services</a>
            </div>
        </div>
    </div>
</section>

<!-- Modal pour la galerie -->
<div id="galerie-modal" class="galerie-modal">
    <div class="galerie-modal-content">
        <div class="galerie-modal-header">
            <h3 id="galerie-modal-title">Galerie du projet</h3>
            <button class="galerie-modal-close">&times;</button>
        </div>

        <div class="galerie-modal-body">
            <!-- État de chargement -->
            <div id="galerie-loading" class="galerie-loading">
                <div class="galerie-spinner"></div>
                <p>Chargement de la galerie...</p>
            </div>

            <!-- Contenu de la galerie (sera rempli dynamiquement) -->
            <div id="galerie-content" style="display: none;">
                <!-- Onglets -->
                <div class="galerie-modal-tabs">
                    <button class="galerie-modal-tab active" data-tab="images">
                        <i class="fas fa-images"></i> Images
                        <span id="galerie-image-count" class="galerie-tab-badge">0</span>
                    </button>
                    <button class="galerie-modal-tab" data-tab="videos">
                        <i class="fas fa-video"></i> Vidéos
                        <span id="galerie-video-count" class="galerie-tab-badge">0</span>
                    </button>
                    <button class="galerie-modal-tab" data-tab="documents">
                        <i class="fas fa-folder"></i> Documents
                        <span id="galerie-doc-count" class="galerie-tab-badge">0</span>
                    </button>
                </div>

                <!-- Contenu des onglets -->
                <div class="galerie-modal-tab-content active" id="galerie-tab-images">
                    <div class="galerie-grid" id="galerie-images">
                        <!-- Images seront chargées ici -->
                    </div>
                </div>

                <div class="galerie-modal-tab-content" id="galerie-tab-videos">
                    <div class="galerie-video-grid" id="galerie-videos">
                        <!-- Vidéos seront chargées ici -->
                    </div>
                </div>

                <div class="galerie-modal-tab-content" id="galerie-tab-documents">
                    <div class="galerie-documents-list" id="galerie-documents">
                        <!-- Documents seront chargés ici -->
                    </div>
                </div>
            </div>

            <!-- État d'erreur -->
            <div id="galerie-error" class="galerie-error" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Erreur de chargement</h3>
                <p>Impossible de charger la galerie. Vérifiez votre connexion internet.</p>
                <button class="btn btn-primary" onclick="window.galerieManager.retryLoad()" style="margin-top: 1rem;">
                    <i class="fas fa-redo"></i> Réessayer
                </button>
            </div>
        </div>

        <div class="galerie-modal-footer">
            <a href="#" id="galerie-folder-link" class="btn btn-secondary" target="_blank">
                <i class="fas fa-external-link-alt"></i> Voir sur Google Drive
            </a>
            <button class="btn btn-primary" id="galerie-download-all">
                <i class="fas fa-download"></i> Télécharger tous les fichiers
            </button>
        </div>
    </div>
</div>

<script src="assets/js/drive-config.js"></script>
<script src="assets/js/drive-projects.js"></script>
<script src="assets/js/galerie-manager.js"></script>
<script>
    // Filtrage des projets
    document.addEventListener('DOMContentLoaded', function () {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projectCards = document.querySelectorAll('.projet-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                projectCards.forEach(card => {
                    const cardCategories = card.getAttribute('data-category') || '';
                    const categoriesArray = cardCategories.split(' ').filter(cat => cat.trim() !== '');

                    if (filter === 'all' || categoriesArray.includes(filter)) {
                        card.style.display = 'block';
                        card.style.animation = 'slideUp 0.5s ease-out';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

<?php include 'footer.php'; ?>