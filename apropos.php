<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos | PêlêTech Nexus</title>
    <meta name="description"
        content="Découvrez PêlêTech Nexus, notre vision, notre philosophie et notre approche du développement numérique.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">
    <style>
        .icon-circle {
            border-radius: 100%;
            background: linear-gradient(135deg,
                    rgba(138, 111, 232, 0.15),
                    rgba(79, 163, 217, 0.15));
            margin-bottom: 50px;
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 200px;
        }

        .logo-icon img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            border-radius: 100%;
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
                <li><a href="realisations.php" class="nav-link">Réalisations</a></li>
                <li><a href="process.php" class="nav-link">Processus</a></li>
                <li><a href="apropos.php" class="nav-link active">À propos</a></li>
                <li><a href="contact.php" class="nav-link cta-nav">Démarrer un projet</a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-progress" id="scrollProgress"></div>
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <main id="main-content">
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
                            <p
                                style="font-size: 1.05rem; line-height: 1.8; margin-bottom: 2rem; color: var(--light-secondary);">
                                PêlêTech Nexus est un studio digital spécialisé dans la conception de
                                <span class="text-gradient">sites web modernes</span>, conception de
                                <span class="text-gradient">maquettes d’interfaces</span> et le
                                <span class="text-gradient">UI/UX design orienté utilisateur</span>.
                                Chaque projet est pensé comme un outil stratégique au service de votre image
                                et de vos objectifs.
                            </p>

                            <h3 style="color: var(--primary); margin-bottom: 1rem;">Notre philosophie</h3>
                            <ul style="list-style: none; padding: 0;">
                                <li style="margin-bottom: 1rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--primary); font-weight: 600;">Clarté :</span>
                                    <span style="color: var(--light-secondary);"> des choix lisibles, des interfaces
                                        compréhensibles, des décisions assumées</span>
                                </li>
                                <li style="margin-bottom: 1rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--primary); font-weight: 600;">Rigueur
                                        :</span>
                                    <span style="color: var(--light-secondary);"> chaque détail compte, du design à
                                        l’implémentation</span>
                                </li>
                                <li style="margin-bottom: 1rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--primary); font-weight: 600;"> Durabilité
                                        :</span>
                                    <span style="color: var(--light-secondary);"> des solutions conçues pour évoluer
                                        dans le temps</span>
                                </li>
                                <li style="margin-bottom: 1rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--primary); font-weight: 600;">Livraison dans les délais
                                        :</span>
                                    <span style="color: var(--light-secondary);"> respect des échéances convenues</span>
                                </li>
                                <li style="margin-bottom: 1rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--primary); font-weight: 600;"> Engagement
                                        :</span>
                                    <span style="color: var(--light-secondary);"> votre réussite est intégrée à notre
                                        démarche</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-gradient">
                        <div style="text-align: center; padding: 2rem;">
                            <div class="icon icon-lg icon-gradient icon-circle logo-icon">
                                <img src="assets/logo.png" alt="PêlêTech Nexus">
                            </div>
                            <h3 style="margin-bottom: 1.5rem; color: var(--light);">La marque & sa fondatrice</h3>
                            <p style="margin-bottom: 1.5rem; color: var(--light-secondary);">
                                PêlêTech Nexus est une marque fondée et pilotée par
                                <strong style="color: var(--light);">Pêlê Deb NASSAM</strong>,
                                spécialisée dans le développement frontend, le design d’interfaces
                                et la création de supports visuels professionnels.
                            </p>
                            <div
                                style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-top: 1.5rem;">
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
                    <div class="card" style="text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem;">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 style="color: var(--light);">Sites Web Modernes</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem;">
                            Conception de sites performants, responsives et alignés avec votre identité de marque.
                        </p>
                    </div>

                    <div class="card" style="text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem;">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h3 style="color: var(--light);">UI/UX Design</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem;">
                            Maquettes d’interfaces et parcours utilisateurs pensés pour la clarté et l’efficacité.
                        </p>
                    </div>

                    <div class="card" style="text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem;">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 style="color: var(--light);">Applications Mobile</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem;">
                            Développement d’interfaces Android fluides, fiables et optimisées.
                        </p>
                    </div>

                    <div class="card" style="text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem;">
                            <i class="fas fa-file-image"></i>
                        </div>
                        <h3 style="color: var(--light);">Supports Visuels</h3>
                        <p style="color: var(--light-secondary); font-size: 0.95rem;">
                            Création de flyers et supports visuels cohérents avec votre image.
                        </p>
                    </div>
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
                <p class="section-subtitle">Les principes qui guident chaque décision, chaque ligne de code, chaque
                    interaction.</p>

                <div class="grid grid-3">
                    <div class="card animate-slide-up">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Précision</h3>
                        <p style="color: var(--light-secondary);">Chaque détail compte. Nous visons l'excellence
                            technique et l'exécution impeccable dans tout ce que nous faisons.</p>
                    </div>

                    <div class="card animate-slide-up" style="animation-delay: 0.1s;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3>Efficacité</h3>
                        <p style="color: var(--light-secondary);">Nous optimisons nos processus pour livrer des
                            solutions robustes, dans des délais maîtrisés, sans compromis sur la qualité.</p>
                    </div>

                    <div class="card animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                            <i class="fas fa-arrows-rotate"></i>
                        </div>
                        <h3>Évolutivité</h3>
                        <p style="color: var(--light-secondary);">Nous concevons des solutions qui grandissent avec
                            vous, anticipant les besoins futurs et facilitant les évolutions.</p>
                    </div>
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
                                    <span class="badge badge-secondary">HTML5 / CSS3</span>
                                    <span class="badge badge-secondary">JavaScript</span>
                                    <span class="badge badge-secondary">Design System</span>
                                    <span class="badge badge-secondary">PHP</span>
                                    <span class="badge badge-secondary">MySQL</span>
                                    <span class="badge badge-secondary">Flutter</span>
                                    <span class="badge badge-secondary">Dart</span>
                                    <span class="badge badge-secondary">GitHub</span>
                                    <span class="badge badge-secondary">Figma</span>
                                    <span class="badge badge-secondary">Canva Pro</span>
                                </div>
                            </div>

                            <div>
                                <h4 style="color: var(--primary); margin-bottom: 1rem;">Nos standards qualité</h4>
                                <ul style="list-style: none; padding: 0;">
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                        <span style="color: var(--light-secondary);">Code clair, structuré et
                                            maintenable</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                        <span style="color: var(--light-secondary);">Respect des bonnes pratiques
                                            frontend et mobile</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                        <span style="color: var(--light-secondary);">Validation fonctionnelle
                                            rigoureuse</span>
                                    </li>
                                    <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                        <span style="color: var(--light-secondary);">Documentation essentielle pour la
                                            prise en main</span>
                                    </li>
                                    <li style="padding-left: 1.5rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                        <span style="color: var(--light-secondary);">Performance, lisibilité et
                                            cohérence à chaque étape</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card card-gradient">
                        <div style="padding: 2rem;">
                            <h3 style="margin-bottom: 1.5rem; color: var(--light);">Pourquoi choisir PêlêTech Nexus ?
                            </h3>
                            <ul style="list-style: none; padding: 0;">
                                <li
                                    style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Expertise focalisée</h4>
                                    <p style="color: var(--light-secondary);">Nous nous concentrons exclusivement sur ce
                                        que nous maîtrisons parfaitement pour garantir des résultats optimaux.</p>
                                </li>
                                <li
                                    style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Approche sur mesure</h4>
                                    <p style="color: var(--light-secondary);">Pas de solutions préfabriquées. Chaque
                                        projet est unique et mérite une approche personnalisée.</p>
                                </li>
                                <li>
                                    <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Engagement long terme</h4>
                                    <p style="color: var(--light-secondary);">Nous bâtissons des relations durables, pas
                                        des transactions ponctuelles.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Ressources éducatives – cartes design amélioré, icônes centrées -->
        <section id="ressources" class="bg-dark-light">
            <div class="container">
                <!-- Titre et introduction -->
                <div style="text-align: center; max-width: 1000px; margin: 0 auto 3rem auto;">
                    <h2 class="section-title" style="margin-bottom: 1rem;">Ressources éducatives numériques</h2>
                    <p style="color: var(--light-secondary); font-size: 1.2rem; line-height: 1.6;">
                        Au-delà de nos services, nous concevons des supports éducatifs pour accompagner les enfants
                        à la maison, à l’école ou en garderie.
                    </p>
                </div>

                <!-- Grille de 4 cartes -->
                <div class="grid grid-4" style="gap: 1.5rem; margin-bottom: 3rem;">
                    <!-- Carte 1 : Ebooks éducatifs (mis en avant) -->
                    <div class="card"
                        style="border: 1px solid rgba(138,111,232,0.3); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.3); transition: transform 0.2s ease, box-shadow 0.2s ease; text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem auto;">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 style="color: var(--light); font-size: 1.3rem; margin-bottom: 0.5rem; font-weight: 700;">
                            Ebooks éducatifs
                        </h3>
                        <p style="color: var(--light-secondary); opacity: 0.7; font-size: 0.95rem;">
                            français & anglais
                        </p>
                    </div>

                    <!-- Carte 2 : PDF prêts à imprimer -->
                    <div class="card"
                        style="border: 1px solid rgba(138,111,232,0.2); box-shadow: 0 8px 15px -5px rgba(0,0,0,0.2); transition: transform 0.2s ease, box-shadow 0.2s ease; text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem auto;">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3 style="color: var(--light); font-size: 1.1rem; margin-bottom: 0.5rem;">
                            PDF prêts à imprimer
                        </h3>
                        <p style="color: var(--light-secondary); opacity: 0.7; font-size: 0.95rem;">
                            activités clé en main
                        </p>
                    </div>

                    <!-- Carte 3 : Pages PNG -->
                    <div class="card"
                        style="border: 1px solid rgba(138,111,232,0.2); box-shadow: 0 8px 15px -5px rgba(0,0,0,0.2); transition: transform 0.2s ease, box-shadow 0.2s ease; text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem auto;">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 style="color: var(--light); font-size: 1.1rem; margin-bottom: 0.5rem;">
                            Pages PNG
                        </h3>
                        <p style="color: var(--light-secondary); opacity: 0.7; font-size: 0.95rem;">
                            utilisation numérique
                        </p>
                    </div>

                    <!-- Carte 4 : École & Famille -->
                    <div class="card"
                        style="border: 1px solid rgba(138,111,232,0.2); box-shadow: 0 8px 15px -5px rgba(0,0,0,0.2); transition: transform 0.2s ease, box-shadow 0.2s ease; text-align: center;">
                        <div class="icon icon-md icon-gradient icon-circle" style="margin: 0 auto 1rem auto;">
                            <i class="fas fa-school"></i>
                        </div>
                        <h3 style="color: var(--light); font-size: 1.1rem; margin-bottom: 0.5rem;">
                            École & Famille
                        </h3>
                        <p style="color: var(--light-secondary); opacity: 0.7; font-size: 0.95rem;">
                            contextes adaptés
                        </p>
                    </div>
                </div>

                <!-- Bouton vers la page ressources -->
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
                <!-- style="background: linear-gradient(135deg, rgba(138, 111, 232, 0.1), rgba(79, 163, 217, 0.1));" -->
                <div class="card"
                    style="text-align: center; padding: 4rem 2rem; background: rgba(11, 16, 32, 0.8); border: 1px solid rgba(138, 111, 232, 0.3);">
                    <h2 style="margin-bottom: 1rem; color: var(--light);">Travaillons ensemble</h2>
                    <p class="section-subtitle" style="margin-bottom: 2.5rem; color: var(--light-secondary);">
                        Vous avez un projet en tête ? Discutons-en pour créer une solution qui correspond parfaitement à
                        vos besoins.
                    </p>
                    <a href="contact.php" class="btn btn-primary btn-large">Prendre contact</a>
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
                        <a href="https://www.facebook.com/people/PêlêTech-Nexus/61582899320642/" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/peledebnassam" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/peledebnassam?igsh=MTIycDV5eGZ6dmR2Mw==" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
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
                        <li style="color: var(--gray-light);">Email: contact.pelenexus@gmail.com</li>
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

    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="js/main.js"></script>
</body>

</html>