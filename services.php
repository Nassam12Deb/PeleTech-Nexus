<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | PêlêTech Nexus</title>
    <meta name="description"
        content="Sites web modernes, UI/UX design orienté utilisateur, supports visuels et développement frontend d’applications Android.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">
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
                <li><a href="services.php" class="nav-link active">Services</a></li>
                <li><a href="realisations.php" class="nav-link">Réalisations</a></li>
                <li><a href="process.php" class="nav-link">Processus</a></li>
                <li><a href="apropos.php" class="nav-link">À propos</a></li>
                <li><a href="contact.php" class="nav-link cta-nav">Démarrer un projet</a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-progress" id="scrollProgress"></div>
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <main id="main-content">

        <!-- Hero -->
        <section id="services-hero" class="animate-fade-in">
            <div class="container">
                <h1 class="section-title">
                    Nous concevons des expériences numériques qui font grandir les marques
                </h1>
                <p class="section-subtitle">
                    Sites web, interfaces et applications conçus pour la performance,
                    l’élégance et une expérience utilisateur maîtrisée.
                </p>
            </div>
        </section>

        <!-- Sites Web -->
        <section id="web" class="bg-dark-light">
            <div class="container">
                <div class="grid grid-2">

                    <div>
                        <span class="badge badge-primary">Service principal</span>
                        <h2 style="margin: 1rem 0; color: var(--light);">Sites Web Modernes</h2>

                        <div style="margin: 1.5rem 0;">
                            <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Votre enjeu</h4>
                            <p style="color: var(--light-secondary);">
                                Inspirer confiance, capter l’attention et affirmer votre crédibilité dès les premières
                                secondes.
                            </p>

                            <h4 style="color: var(--primary); margin: 1.5rem 0 0.5rem;">Notre approche</h4>
                            <p style="color: var(--light-secondary);">
                                Nous concevons des sites sur mesure, rapides et structurés,
                                alignés avec votre identité de marque et pensés pour guider
                                l’utilisateur avec fluidité et clarté.
                            </p>

                            <h4 style="color: var(--primary); margin: 1.5rem 0 0.5rem;">Ce que vous obtenez</h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li><span style="color: var(--primary);">✓</span> <span
                                        style="color: var(--light-secondary);">Une expérience fluide et cohérente sur
                                        tous les écrans</span></li>
                                <li><span style="color: var(--primary);">✓</span> <span
                                        style="color: var(--light-secondary);">Une image professionnelle forte et
                                        différenciante</span></li>
                                <li><span style="color: var(--primary);">✓</span> <span
                                        style="color: var(--light-secondary);">Une base saine pour la visibilité et le
                                        référencement</span></li>
                                <li><span style="color: var(--primary);">✓</span> <span
                                        style="color: var(--light-secondary);">Une navigation claire, intuitive et
                                        rassurante</span></li>
                                <li><span style="color: var(--primary);">✓</span> <span
                                        style="color: var(--light-secondary);">Un outil évolutif, fiable et maintenable
                                        dans le temps</span></li>
                            </ul>
                        </div>

                        <div style="margin-top: 2rem;">
                            <h4 style="color: var(--light); margin-bottom: 1rem;">Technologies utilisées</h4>
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
                                <i class="fas fa-globe"></i>
                            </div>
                            <h3 style="margin-bottom: 1rem; color: var(--light);">Types de sites réalisés</h3>
                            <ul style="text-align: left; list-style: none; padding: 0;">
                                <li>• <span style="color: var(--light-secondary);">Sites vitrines & portfolios</span>
                                </li>
                                <li>• <span style="color: var(--light-secondary);">Sites institutionnels</span></li>
                                <li>• <span style="color: var(--light-secondary);">Landing pages orientées
                                        conversion</span></li>
                                <li>• <span style="color: var(--light-secondary);">Sites e-commerce essentiels</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- UI/UX -->
        <section id="design">
            <div class="container">
                <div class="grid grid-2">

                    <div class="card card-gradient">
                        <div style="text-align: center; padding: 2rem;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <h3 style="margin-bottom: 1rem; color: var(--light);">UI / UX orienté utilisateur</h3>
                            <p style="color: var(--light-secondary);">
                                Chaque décision de design est guidée par l’usage,
                                la clarté et l’efficacité.
                            </p>
                        </div>
                    </div>

                    <div>
                        <span class="badge badge-primary">Service stratégique</span>
                        <h2 style="margin: 1rem 0; color: var(--light);">UI / UX Design</h2>

                        <p style="color: var(--light-secondary);">
                            Nous concevons des interfaces intuitives, élégantes et fonctionnelles,
                            pensées pour répondre aux besoins réels des utilisateurs tout en soutenant
                            vos objectifs business.
                        </p>

                        <div style="margin-top: 2rem;">
                            <h4 style="color: var(--light); margin-bottom: 1rem;">Outils maîtrisés</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                                <span class="badge badge-secondary">Figma</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Mobile -->
        <section id="mobile" class="bg-dark-light">
            <div class="container">
                <div class="grid grid-2">

                    <div>
                        <span class="badge badge-primary">Service technique</span>
                        <h2 style="margin: 1rem 0; color: var(--light);">Frontend Mobile Android</h2>

                        <p style="color: var(--light-secondary);">
                            Développement d’interfaces Android performantes, fluides et élégantes,
                            respectant les standards modernes et les bonnes pratiques de l’écosystème Android.
                        </p>

                        <div style="margin-top: 2rem;">
                            <h4 style="color: var(--light); margin-bottom: 1rem;">Technologies utilisées</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                                <span class="badge badge-secondary">Flutter</span>
                                <span class="badge badge-secondary">Dart</span>
                            </div>
                        </div>
                    </div>

                    <div class="card card-gradient">
                        <div style="text-align: center; padding: 2rem;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3 style="margin-bottom: 1rem; color: var(--light);">Approche mobile-first</h3>
                            <p style="color: var(--light-secondary);">
                                Des interfaces pensées pour la performance,
                                la lisibilité et une expérience utilisateur optimale.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Supports visuels -->
        <section id="visuels">
            <div class="container">
                <div class="grid grid-2">

                    <div class="card card-gradient">
                        <div style="text-align: center; padding: 2rem;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-file-image"></i>
                            </div>
                            <h3 style="margin-bottom: 1rem; color: var(--light);">Identité & supports visuels</h3>
                            <p style="color: var(--light-secondary);">
                                Des visuels cohérents, élégants et alignés avec votre image de marque.
                            </p>
                        </div>
                    </div>

                    <div>
                        <span class="badge badge-primary">Service créatif</span>
                        <h2 style="margin: 1rem 0; color: var(--light);">Supports Visuels</h2>

                        <p style="color: var(--light-secondary);">
                            Nous concevons des supports de communication clairs et percutants,
                            pensés pour renforcer votre crédibilité et votre visibilité.
                        </p>

                        <div style="margin-top: 2rem;">
                            <h4 style="color: var(--light); margin-bottom: 1rem;">Outils de création</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                                <span class="badge badge-secondary">Figma</span>
                                <span class="badge badge-secondary">Canva Pro</span>
                            </div>
                        </div>
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
                    <p style="color: var(--gray-light); margin-bottom: 1.5rem;">
                        Silence structuré. Code incarné. Le sens, sous la surface.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
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
                        <li style="color: var(--gray-light);">Email : contact@peletech-nexus.com</li>
                        <li style="color: var(--gray-light);">Réponse sous 24h</li>
                        <li><a href="contact.php">Formulaire de contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p style="color: var(--gray);">&copy; 2026 PêlêTech Nexus. Tous droits réservés.</p>
                <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray-light);">
                    Marque fondée et pilotée par Pêlê Deb NASSAM
                </p>
            </div>
        </div>
    </footer>

    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="js/main.js"></script>
</body>

</html>