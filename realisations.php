<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Réalisations | PêlêTech Nexus</title>
    <meta name="description"
        content="Découvrez nos projets clients et études de cas. Des solutions concrètes pour des résultats mesurables.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">
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
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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
            cursor: pointer;
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

        /* Image Viewer - CORRIGÉ */
        .galerie-image-viewer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.98);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .galerie-image-viewer.active {
            display: flex;
            opacity: 1;
        }

        .galerie-image-viewer-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .galerie-image-viewer-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
        }

        .galerie-image-viewer-close {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            font-size: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
            z-index: 2001;
        }

        .galerie-image-viewer-close:hover {
            background: rgba(138, 111, 232, 0.8);
            transform: scale(1.1);
        }

        .galerie-image-viewer-nav {
            position: fixed;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            font-size: 1.5rem;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
            z-index: 2001;
        }

        .galerie-image-viewer-nav:hover {
            background: rgba(138, 111, 232, 0.8);
            transform: translateY(-50%) scale(1.1);
        }

        .galerie-image-viewer-nav.prev {
            left: 20px;
        }

        .galerie-image-viewer-nav.next {
            right: 20px;
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
            to {
                transform: rotate(360deg);
            }
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

        /* Info sur l'image */
        .galerie-image-info {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.7);
            z-index: 2001;
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

            .galerie-image-viewer-nav {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .galerie-image-viewer-nav.prev {
                left: 10px;
            }

            .galerie-image-viewer-nav.next {
                right: 10px;
            }
        }

        @media (max-width: 480px) {
            .galerie-grid {
                grid-template-columns: 1fr;
            }

            .galerie-image-viewer-nav {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>
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
                <li><a href="index.php" class="nav-link">Accueil</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="realisations.php" class="nav-link active">Réalisations</a></li>
                <li><a href="process.php" class="nav-link">Processus</a></li>
                <li><a href="apropos.php" class="nav-link">À propos</a></li>
                <li><a href="contact.php" class="nav-link cta-nav">Démarrer un projet</a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-progress" id="scrollProgress"></div>
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <main id="main-content">
        <!-- Hero Réalisations -->
        <section id="realisations-hero" class="animate-fade-in">
            <div class="container">
                <h1 class="section-title">Nos réalisations</h1>
                <p class="section-subtitle">Des solutions concrètes, des résultats mesurables. Découvrez comment nous
                    transformons les idées en produits digitaux performants.</p>

                <div style="text-align: center; margin-top: 3rem;">
                    <div style="display: inline-flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                        <button class="badge badge-accent filter-btn active" data-filter="all">Tous les
                            projets</button>
                        <button class="badge badge-secondary filter-btn" data-filter="web">Développement Web</button>
                        <button class="badge badge-primary filter-btn" data-filter="mobile">Applications
                            Mobile</button>
                        <button class="badge badge-secondary filter-btn" data-filter="ui_ux">UI/UX Design</button>
                        <button class="badge badge-accent filter-btn" data-filter="maquettes">Maquettes</button>
                        <button class="badge badge-secondary filter-btn" data-filter="supports">Supports</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projets -->
        <section id="projets" class="bg-dark-light">
            <div class="container">
                <!-- Projet 1 -->
                <div class="projet-card card animate-slide-up" data-category="web">
                    <div class="grid grid-2">
                        <div>
                            <div class="badge badge-primary" style="margin-bottom: 1rem;">Développement Web</div>
                            <h2 style="color: var(--light); margin-bottom: 0.5rem;">Plateforme e-commerce B2B</h2>
                            <h3 style="color: var(--primary); font-size: 1.1rem; margin-bottom: 1.5rem;">Fabricant
                                industriel • 6 mois</h3>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Le défi</h4>
                                <p style="color: var(--light-secondary);">
                                    Un fabricant industriel cherchait à digitaliser ses ventes en gros. Le processus
                                    manuel entraînait des erreurs, des délais de traitement longs et une limitation des
                                    ventes aux heures de bureau.
                                </p>
                            </div>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Notre solution</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Plateforme e-commerce B2B avec
                                            catalogue produits personnalisé par client</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Système de devis automatisé avec
                                            validation en ligne</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Intégration complète avec l'ERP
                                            existant (SAP)</span>
                                    </li>
                                    <li style="padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Tableau de bord analytique pour le
                                            suivi des ventes</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Technologies utilisées</h4>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                                    <span class="badge badge-secondary">React</span>
                                    <span class="badge badge-secondary">Node.js</span>
                                    <span class="badge badge-secondary">PostgreSQL</span>
                                    <span class="badge badge-accent">SAP Integration</span>
                                    <span class="badge badge-accent">AWS</span>
                                </div>
                            </div>

                            <!-- Bouton pour ouvrir la galerie Drive -->
                            <div style="margin-top: 2rem;">
                                <button class="btn-galerie" data-drive-id="1WaTX4zZx3ztPpORmp8qQCNZofyeenioP">
                                    <i class="fas fa-images"></i>
                                    <span>Voir la galerie du projet</span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <div class="card card-gradient"
                                style="height: 100%; padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                                <div style="text-align: center; margin-bottom: 2rem;">
                                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h3 style="color: var(--light); margin-bottom: 0.5rem;">Résultats obtenus</h3>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +40%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Ventes en ligne</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            -70%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Erreurs de commande
                                        </p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            24/7</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Disponibilité</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            -60%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Temps de traitement
                                        </p>
                                    </div>
                                </div>

                                <div
                                    style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(138, 111, 232, 0.2);">
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Retour client</h4>
                                    <p style="color: var(--light-secondary); font-style: italic;">
                                        "PêlêTech Nexus a non seulement livré une plateforme technique solide, mais a
                                        surtout compris nos processus métier. La solution s'intègre parfaitement à notre
                                        écosystème."
                                    </p>
                                    <p style="color: var(--light); margin-top: 0.5rem; font-weight: 600;">
                                        — Directeur Commercial
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projet 2 -->
                <div class="projet-card card animate-slide-up" data-category="mobile" style="margin-top: 4rem;">
                    <div class="grid grid-2">
                        <div>
                            <div class="badge badge-primary" style="margin-bottom: 1rem;">Application Mobile</div>
                            <h2 style="color: var(--light); margin-bottom: 0.5rem;">Application de livraison de repas
                            </h2>
                            <h3 style="color: var(--primary); font-size: 1.1rem; margin-bottom: 1.5rem;">Startup
                                FoodTech • 4 mois</h3>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Le défi</h4>
                                <p style="color: var(--light-secondary);">
                                    Une startup de livraison de repas santé cherchait à développer une application
                                    mobile pour concurrencer les leaders du marché tout en offrant une expérience
                                    utilisateur supérieure.
                                </p>
                            </div>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Notre solution</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Application mobile cross-platform
                                            (iOS & Android)</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Système de géolocalisation en temps
                                            réel pour le suivi des livraisons</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Paiement intégré avec validation
                                            instantanée</span>
                                    </li>
                                    <li style="padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Interface intuitive avec
                                            recommandations personnalisées</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Technologies utilisées</h4>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                                    <span class="badge badge-secondary">React Native</span>
                                    <span class="badge badge-secondary">Node.js</span>
                                    <span class="badge badge-secondary">MongoDB</span>
                                    <span class="badge badge-accent">Google Maps API</span>
                                    <span class="badge badge-accent">Stripe</span>
                                </div>
                            </div>

                            <!-- Bouton pour ouvrir la galerie Drive -->
                            <div style="margin-top: 2rem;">
                                <button class="btn-galerie" data-drive-id="1iEwk5flZc1_rHyjk6UxYxgBdKPuA7VrK">
                                    <i class="fas fa-images"></i>
                                    <span>Voir la galerie du projet</span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <div class="card card-gradient"
                                style="height: 100%; padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                                <div style="text-align: center; margin-bottom: 2rem;">
                                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <h3 style="color: var(--light); margin-bottom: 0.5rem;">Impact mesuré</h3>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            4.8★</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Note moyenne App
                                            Store</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +25k</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Téléchargements</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +300%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Commandes/mois</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            -40%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Délai de
                                            développement</p>
                                    </div>
                                </div>

                                <div
                                    style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(138, 111, 232, 0.2);">
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Retour client</h4>
                                    <p style="color: var(--light-secondary); font-style: italic;">
                                        "Le développement avec React Native nous a permis de lancer simultanément sur
                                        iOS et Android, économisant temps et budget. L'application est stable et les
                                        utilisateurs l'adorent."
                                    </p>
                                    <p style="color: var(--light); margin-top: 0.5rem; font-weight: 600;">
                                        — CEO, Startup FoodTech
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projet 3 -->
                <div class="projet-card card animate-slide-up" data-category="design" style="margin-top: 4rem;">
                    <div class="grid grid-2">
                        <div>
                            <div class="badge badge-primary" style="margin-bottom: 1rem;">UI/UX Design</div>
                            <h2 style="color: var(--light); margin-bottom: 0.5rem;">Refonte d'interface SaaS B2B</h2>
                            <h3 style="color: var(--primary); font-size: 1.1rem; margin-bottom: 1.5rem;">Éditeur de
                                logiciel • 3 mois</h3>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Le défi</h4>
                                <p style="color: var(--light-secondary);">
                                    Un éditeur de logiciel SaaS B2B voyait ses taux d'adoption stagner malgré des
                                    fonctionnalités solides. L'interface vieillissante et complexe décourageait les
                                    nouveaux utilisateurs.
                                </p>
                            </div>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Notre approche</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Audit UX complet avec analyse des
                                            parcours utilisateurs</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Conception d'un nouveau système de
                                            design cohérent</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Simplification des workflows
                                            complexes</span>
                                    </li>
                                    <li style="padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Tests utilisateurs itératifs pour
                                            validation</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Livrables</h4>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                                    <span class="badge badge-secondary">Design System</span>
                                    <span class="badge badge-secondary">Wireframes</span>
                                    <span class="badge badge-secondary">Prototypes interactifs</span>
                                    <span class="badge badge-accent">Guide de style</span>
                                    <span class="badge badge-accent">Composants React</span>
                                </div>
                            </div>

                            <!-- Bouton pour ouvrir la galerie Drive -->
                            <div style="margin-top: 2rem;">
                                <button class="btn-galerie" data-drive-id="FOLDER_ID_3">
                                    <i class="fas fa-images"></i>
                                    <span>Voir la galerie du projet</span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <div class="card card-gradient"
                                style="height: 100%; padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                                <div style="text-align: center; margin-bottom: 2rem;">
                                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <h3 style="color: var(--light); margin-bottom: 0.5rem;">Améliorations mesurées</h3>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +65%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Taux de complétion
                                            onboarding</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            -55%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Tickets support</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +42%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">NPS (Net Promoter
                                            Score)</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            4.2→4.8</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Satisfaction
                                            utilisateur</p>
                                    </div>
                                </div>

                                <div
                                    style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(138, 111, 232, 0.2);">
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Retour client</h4>
                                    <p style="color: var(--light-secondary); font-style: italic;">
                                        "La refonte a complètement transformé l'expérience de nos utilisateurs. Non
                                        seulement elle est plus belle, mais surtout plus efficace. Nos équipes internes
                                        peuvent maintenant développer de nouvelles fonctionnalités beaucoup plus
                                        rapidement grâce au design system."
                                    </p>
                                    <p style="color: var(--light); margin-top: 0.5rem; font-weight: 600;">
                                        — Product Manager
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NOUVEAU PROJET -->
                <div class="projet-card card animate-slide-up" data-category="web" style="margin-top: 4rem;">
                    <div class="grid grid-2">
                        <div>
                            <div class="badge badge-primary" style="margin-bottom: 1rem;">Développement Web</div>
                            <h2 style="color: var(--light); margin-bottom: 0.5rem;">Application de Gestion de Projets
                            </h2>
                            <h3 style="color: var(--primary); font-size: 1.1rem; margin-bottom: 1.5rem;">Startup Tech •
                                3 mois</h3>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Le défi</h4>
                                <p style="color: var(--light-secondary);">
                                    Une startup tech avait besoin d'une application web pour gérer ses projets
                                    collaboratifs en temps réel avec une équipe distribuée dans plusieurs pays.
                                </p>
                            </div>

                            <div style="margin-bottom: 2rem;">
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Notre solution</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Application web responsive avec
                                            tableau de bord personnalisé</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Synchronisation en temps réel entre
                                            tous les utilisateurs</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Système de notifications et rappels
                                            automatisés</span>
                                    </li>
                                    <li style="padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Export de rapports en PDF et
                                            Excel</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h4 style="color: var(--light); margin-bottom: 0.75rem;">Technologies utilisées</h4>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                                    <span class="badge badge-secondary">React</span>
                                    <span class="badge badge-secondary">TypeScript</span>
                                    <span class="badge badge-secondary">Firebase</span>
                                    <span class="badge badge-accent">Material-UI</span>
                                    <span class="badge badge-accent">Chart.js</span>
                                </div>
                            </div>

                            <!-- Bouton pour ouvrir la galerie Drive -->
                            <div style="margin-top: 2rem;">
                                <button class="btn-galerie" data-drive-id="FOLDER_ID_4">
                                    <i class="fas fa-images"></i>
                                    <span>Voir la galerie du projet</span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <div class="card card-gradient"
                                style="height: 100%; padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                                <div style="text-align: center; margin-bottom: 2rem;">
                                    <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <h3 style="color: var(--light); margin-bottom: 0.5rem;">Résultats obtenus</h3>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +45%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Productivité équipe
                                        </p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            -60%</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Retards projet</p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            +50</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Utilisateurs actifs
                                        </p>
                                    </div>
                                    <div style="text-align: center;">
                                        <div
                                            style="font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.25rem;">
                                            9.2/10</div>
                                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Satisfaction</p>
                                    </div>
                                </div>

                                <div
                                    style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(138, 111, 232, 0.2);">
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Retour client</h4>
                                    <p style="color: var(--light-secondary); font-style: italic;">
                                        "L'application a transformé notre façon de travailler. Notre équipe est plus
                                        organisée et nous respectons désormais systématiquement nos délais."
                                    </p>
                                    <p style="color: var(--light); margin-top: 0.5rem; font-weight: 600;">
                                        — CEO, Startup Tech
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Autres projets (cartes compactes) -->
        <section id="autres-projets">
            <div class="container">
                <h2 class="section-title">Autres réalisations</h2>
                <p class="section-subtitle">Découvrez d'autres projets où nous avons fait la différence.</p>

                <div class="grid grid-3" style="margin-top: 3rem;">
                    <div class="card animate-slide-up" data-category="web">
                        <div class="badge badge-primary" style="margin-bottom: 1rem; font-size: 0.7rem;">Web</div>
                        <h3 style="color: var(--light); margin-bottom: 0.75rem;">Portail client immobilier</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem; margin-bottom: 1.5rem;">
                            Plateforme de gestion de biens immobiliers avec suivi des locations, paiements en ligne et
                            communication propriétaire-locataire.
                        </p>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                            <span class="badge badge-secondary"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Vue.js</span>
                            <span class="badge badge-secondary"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Laravel</span>
                            <span class="badge badge-accent"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Stripe</span>
                        </div>
                        <div style="color: var(--primary); font-weight: 600;">+50% d'automatisation</div>
                        <!-- Bouton pour ouvrir la galerie Drive -->
                        <div style="margin-top: 1rem;">
                            <button class="btn-galerie btn-small" data-drive-id="FOLDER_ID_5"
                                style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                <i class="fas fa-images"></i>
                                <span>Voir la galerie</span>
                            </button>
                        </div>
                    </div>

                    <div class="card animate-slide-up" data-category="mobile" style="animation-delay: 0.1s;">
                        <div class="badge badge-primary" style="margin-bottom: 1rem; font-size: 0.7rem;">Mobile</div>
                        <h3 style="color: var(--light); margin-bottom: 0.75rem;">App de fitness connectée</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem; margin-bottom: 1.5rem;">
                            Application de suivi d'activité physique avec synchronisation des bracelets connectés et
                            programmes d'entraînement personnalisés.
                        </p>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                            <span class="badge badge-secondary"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Flutter</span>
                            <span class="badge badge-secondary"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Firebase</span>
                            <span class="badge badge-accent" style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">API
                                HealthKit</span>
                        </div>
                        <div style="color: var(--primary); font-weight: 600;">4.7★ sur les stores</div>
                        <!-- Bouton pour ouvrir la galerie Drive -->
                        <div style="margin-top: 1rem;">
                            <button class="btn-galerie btn-small" data-drive-id="FOLDER_ID_6"
                                style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                <i class="fas fa-images"></i>
                                <span>Voir la galerie</span>
                            </button>
                        </div>
                    </div>

                    <div class="card animate-slide-up" data-category="design" style="animation-delay: 0.2s;">
                        <div class="badge badge-primary" style="margin-bottom: 1rem; font-size: 0.7rem;">Design</div>
                        <h3 style="color: var(--light); margin-bottom: 0.75rem;">Site vitrine premium</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem; margin-bottom: 1.5rem;">
                            Design et développement d'un site vitrine haut de gamme pour une marque de luxe, avec
                            animations subtiles et expérience immersive.
                        </p>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1.5rem;">
                            <span class="badge badge-secondary"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Figma</span>
                            <span class="badge badge-secondary"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">GSAP</span>
                            <span class="badge badge-accent"
                                style="font-size: 0.65rem; padding: 0.4rem 0.6rem;">Three.js</span>
                        </div>
                        <div style="color: var(--primary); font-weight: 600;">+35% de leads qualifiés</div>
                        <!-- Bouton pour ouvrir la galerie Drive -->
                        <div style="margin-top: 1rem;">
                            <button class="btn-galerie btn-small" data-drive-id="FOLDER_ID_7"
                                style="padding: 0.5rem 1rem; font-size: 0.8rem;">
                                <i class="fas fa-images"></i>
                                <span>Voir la galerie</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section id="realisations-cta"
            style="background: linear-gradient(135deg, rgba(138, 111, 232, 0.1), rgba(79, 163, 217, 0.1)); margin-top: 4rem;">
            <div class="container">
                <div class="card card-gradient"
                    style="text-align: center; padding: 4rem 2rem; border: 1px solid rgba(138, 111, 232, 0.3);">
                    <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--light);">Et votre projet ?</h2>
                    <p class="section-subtitle" style="margin-bottom: 2.5rem; color: var(--light-secondary);">
                        Vous avez une idée, un besoin spécifique ? Discutons-en pour créer la prochaine réussite dans
                        notre portfolio.
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="contact.php" class="btn btn-primary btn-large">Discuter de mon projet</a>
                        <a href="services.php" class="btn btn-secondary btn-large">Découvrir nos services</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h4>PêlêTech Nexus</h4>
                    <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Silence structuré. Code incarné. Le
                        sens, sous la surface.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=2290165203660" class="social-link"
                            aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="realisations.php">Réalisations</a></li>
                        <li><a href="process.php">Processus</a></li>
                        <li><a href="apropos.php">À propos</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Légal</h4>
                    <ul>
                        <li><a href="mentions-legales.php">Mentions légales</a></li>
                        <li><a href="confidentialite.php">Politique de confidentialité</a></li>
                        <li><a href="cookies.php">Gestion des cookies</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li style="color: var(--gray-light);">Email: contact@peletech-nexus.com</li>
                        <li style="color: var(--gray-light);">Réponse sous 24h</li>
                        <li><a href="contact.php">Formulaire de contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p style="color: var(--gray);">&copy; 2026 PêlêTech Nexus. Tous droits réservés.</p>
                <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray-light);">Marque fondée et pilotée
                    par Pêlê Deb NASSAM</p>
            </div>
        </div>
    </footer>

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
                        <button class="galerie-modal-tab" data-tab="info">
                            <i class="fas fa-info-circle"></i> Informations
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

                    <div class="galerie-modal-tab-content" id="galerie-tab-info">
                        <div class="galerie-project-info">
                            <div class="galerie-info-grid">
                                <div class="galerie-info-item">
                                    <h4><i class="fas fa-user"></i> Client</h4>
                                    <p id="galerie-info-client">-</p>
                                </div>
                                <div class="galerie-info-item">
                                    <h4><i class="fas fa-calendar"></i> Année</h4>
                                    <p id="galerie-info-year">-</p>
                                </div>
                                <div class="galerie-info-item">
                                    <h4><i class="fas fa-layer-group"></i> Catégorie</h4>
                                    <p id="galerie-info-category">-</p>
                                </div>
                                <div class="galerie-info-item">
                                    <h4><i class="fas fa-code"></i> Technologies</h4>
                                    <div id="galerie-info-technologies" class="galerie-tech-tags"></div>
                                </div>
                            </div>

                            <div class="galerie-info-section">
                                <h4><i class="fas fa-bullseye"></i> Défi</h4>
                                <p id="galerie-info-challenge">-</p>
                            </div>

                            <div class="galerie-info-section">
                                <h4><i class="fas fa-chart-line"></i> Résultats</h4>
                                <p id="galerie-info-results">-</p>
                            </div>

                            <div class="galerie-info-section">
                                <h4><i class="fas fa-star"></i> Fonctionnalités</h4>
                                <ul id="galerie-info-features" class="galerie-features-list"></ul>
                            </div>

                            <div class="galerie-info-section">
                                <h4><i class="fas fa-folder-open"></i> Fichiers disponibles</h4>
                                <div id="galerie-file-stats" class="galerie-file-stats"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- État d'erreur -->
                <div id="galerie-error" class="galerie-error" style="display: none;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Erreur de chargement</h3>
                    <p>Impossible de charger la galerie. Vérifiez votre connexion internet.</p>
                    <button class="btn btn-primary" onclick="window.galerieManager.retryLoad()"
                        style="margin-top: 1rem;">
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

    <!-- Image Viewer (fullscreen) - CORRIGÉ -->
    <div id="galerie-image-viewer" class="galerie-image-viewer">
        <button class="galerie-image-viewer-close">&times;</button>
        <button class="galerie-image-viewer-nav prev"><i class="fas fa-chevron-left"></i></button>
        <button class="galerie-image-viewer-nav next"><i class="fas fa-chevron-right"></i></button>
        <div class="galerie-image-viewer-content">
            <img id="galerie-viewer-image" src="" alt="">
        </div>
        <div id="galerie-image-info" class="galerie-image-info" style="display: none;"></div>
    </div>

    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="js/main.js"></script>
    <script src="js/drive-config.js"></script>
    <script src="js/drive-projects.js"></script>
    <script src="js/galerie-manager.js"></script>
    <script>
        // Filtrage des projets existants
        document.addEventListener('DOMContentLoaded', function () {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.projet-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    // Retirer la classe active de tous les boutons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Ajouter la classe active au bouton cliqué
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    projectCards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-category') === filter) {
                            card.style.display = 'block';
                            card.style.animation = 'slideUp 0.5s ease-out';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Gestionnaire d'images pour le viewer - CORRECTION
            let currentImages = [];
            let currentImageIndex = 0;

            // Fonction pour ouvrir le viewer d'images
            window.openImageViewer = function (index, images) {
                if (!images || images.length === 0) return;

                currentImages = images;
                currentImageIndex = index;

                const viewer = document.getElementById('galerie-image-viewer');
                const viewerImg = document.getElementById('galerie-viewer-image');
                const imageInfo = document.getElementById('galerie-image-info');

                if (viewer && viewerImg) {
                    viewerImg.src = images[index].url || images[index].thumbnail;
                    viewerImg.alt = images[index].name || 'Image';

                    // Afficher le nom de l'image
                    if (imageInfo) {
                        imageInfo.textContent = images[index].name || '';
                        imageInfo.style.display = images[index].name ? 'block' : 'none';
                    }

                    viewer.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            };

            // Fonction pour fermer le viewer
            window.closeImageViewer = function () {
                const viewer = document.getElementById('galerie-image-viewer');
                if (viewer) {
                    viewer.classList.remove('active');
                    document.body.style.overflow = '';
                }
            };

            // Fonction pour naviguer entre les images
            window.navigateImageViewer = function (direction) {
                if (currentImages.length === 0) return;

                currentImageIndex = (currentImageIndex + direction + currentImages.length) % currentImages.length;

                const viewerImg = document.getElementById('galerie-viewer-image');
                const imageInfo = document.getElementById('galerie-image-info');

                if (viewerImg) {
                    viewerImg.src = currentImages[currentImageIndex].url || currentImages[currentImageIndex].thumbnail;
                    viewerImg.alt = currentImages[currentImageIndex].name || 'Image';

                    // Afficher le nom de l'image
                    if (imageInfo) {
                        imageInfo.textContent = currentImages[currentImageIndex].name || '';
                        imageInfo.style.display = currentImages[currentImageIndex].name ? 'block' : 'none';
                    }
                }
            };

            // Attacher les événements du viewer
            const viewerClose = document.querySelector('.galerie-image-viewer-close');
            const viewerPrev = document.querySelector('.galerie-image-viewer-nav.prev');
            const viewerNext = document.querySelector('.galerie-image-viewer-nav.next');

            if (viewerClose) {
                viewerClose.addEventListener('click', closeImageViewer);
            }

            if (viewerPrev) {
                viewerPrev.addEventListener('click', () => navigateImageViewer(-1));
            }

            if (viewerNext) {
                viewerNext.addEventListener('click', () => navigateImageViewer(1));
            }

            // Fermer avec Escape
            document.addEventListener('keydown', function (e) {
                const viewer = document.getElementById('galerie-image-viewer');
                if (e.key === 'Escape' && viewer && viewer.classList.contains('active')) {
                    closeImageViewer();
                }

                // Navigation avec flèches
                if (viewer && viewer.classList.contains('active')) {
                    if (e.key === 'ArrowLeft') {
                        navigateImageViewer(-1);
                    } else if (e.key === 'ArrowRight') {
                        navigateImageViewer(1);
                    }
                }
            });

            // Fermer en cliquant à l'extérieur de l'image
            const viewer = document.getElementById('galerie-image-viewer');
            if (viewer) {
                viewer.addEventListener('click', function (e) {
                    if (e.target === this || e.target.classList.contains('galerie-image-viewer-content')) {
                        closeImageViewer();
                    }
                });
            }

            // Surcharger la méthode openImageViewer du galerieManager
            if (window.galerieManager && window.galerieManager.openImageViewer) {
                const originalOpenImageViewer = window.galerieManager.openImageViewer;
                window.galerieManager.openImageViewer = function (index) {
                    if (this.currentImages && this.currentImages.length > 0) {
                        window.openImageViewer(index, this.currentImages);
                    } else {
                        originalOpenImageViewer.call(this, index);
                    }
                };
            }
        });

        // Redéfinir les fonctions du viewer pour les rendre accessibles globalement
        window.openImageViewer = window.openImageViewer || function (index, images) {
            // Implémentation par défaut
            console.log('Ouvrir viewer:', index, images);
        };

        window.closeImageViewer = window.closeImageViewer || function () {
            // Implémentation par défaut
            console.log('Fermer viewer');
        };

        window.navigateImageViewer = window.navigateImageViewer || function (direction) {
            // Implémentation par défaut
            console.log('Naviguer viewer:', direction);
        };
    </script>
</body>

</html>